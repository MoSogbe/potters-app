<?php

    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Log;

    if (!function_exists('generate_token')) {
        function generate_token()
        {
            try {
                $headers = [
                    'Content-Type' => 'application/json',
                ];
                $payload = array(
                    'txtpay_api_id' => env('SEVOPAY_API_ID'),
                    'txtpay_api_key' => env('SEVOPAY_API_KEY'),
                );
                $response = Http::withHeaders($headers)->post(env('SEVOPAY_BASE_URL').env('SEVOPAY_API_ACCOUNT_ID').'/token',
                    $payload);

                return $response['data']['token'];

            } catch (Throwable $throwable) {
                Log::warning($throwable->getMessage(),
                    ['file' => $throwable->getFile(), 'line' => $throwable->getLine()]);
            }
        }
    }

    if (!function_exists('debit_client')) {
        function debit_client(
            $msisdn,
            $amount,
            $network,
            $description,
            $client_name,
            $transaction_id = null,
            $callback = null
        ) {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.generate_token(),
            ];

            $payload = array(
                "recipient" => $msisdn,
                "amount" => env('TEST_PAY') === true ? 0.2 : $amount,
                "channel" => $network,
                "description" => $description,
                "nickname" => $client_name,
                "primary-callback" => $callback === null ? route('data.sync') : $callback,
                "reference" => $transaction_id === null ? gen_12_digit(random_int(100000000,
                    999999999)) : $transaction_id,
            );

            // log_JSON_file($payload, 'PAYMENT PAYLOAD');

            try {
                $response = Http::withHeaders($headers)->post(env('SEVOPAY_BASE_URL').env('SEVOPAY_API_ACCOUNT_ID').'/payment-app/receive-money',
                    $payload);
                //log_JSON_file($response->body(), 'PAY-G');
                return $response->body();
            } catch (Throwable $throwable) {
                Log::warning($throwable->getMessage(),
                    ['file' => $throwable->getFile(), 'line' => $throwable->getLine()]);
                return $throwable->getMessage();
            }
        }
    }

    if (!function_exists('check_payment_status')) {
        function check_payment_status(
            $transaction_id
        ) {
            $headers = [
                'Content-Type' => 'application/json',
                'reference' => $transaction_id,
                'Authorization' => 'Bearer '.generate_token(),
            ];

            try {
                $response = Http::withHeaders($headers)->get(env('SEVOPAY_BASE_URL').env('SEVOPAY_API_ACCOUNT_ID').'/payment-app/receive-money/status')->body();
                // log_JSON_file($response,'CHECK PAYME');
                return $response;
            } catch (Throwable $throwable) {
                Log::warning($throwable->getMessage(),
                    ['file' => $throwable->getFile(), 'line' => $throwable->getLine()]);
                return $throwable->getMessage();
            }
        }
    }

    if (!function_exists('gen_12_digit')) {
        function gen_12_digit($key)
        {
            return str_pad($key, 12, "0", STR_PAD_LEFT);
        }
    }

    function encrypt_decrypt($string, $private_key, $secret_key, $action = 'encrypt')
    {
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $private_key);
        $iv = substr(hash('sha256', $secret_key), 0, 16); // sha256 is hash_hmac_algo
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else {
            if ($action == 'decrypt') {
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
        }
        return $output;
    }

    function generate_transaction_id(): int
    {
        return mt_rand(100000, 999999) + mt_rand(100000, 999999);
    }

    function  disburse_airtime($msisdn, $amount, $network)
    {
        try {
            $payload = [
                "accountNumber" => '233'.substr($msisdn, -9),
                "amount" => $amount,
                "carrier" => $network,
                "loop_size" => 1,
            ];
            $headers = [
                'access-id' => 'sInR5cCI6IkpXVCJ9_=',
                'Content-Type' => 'application/json',
            ];

            $resp = Http::withHeaders($headers)
                ->post('https://sevotransact.com/api/v1/send-airtime', $payload)
                ->body();

            $transact = json_decode($resp, true);

            //log_JSON_file($transact, 'air');

            return $transact[0];

        } catch (Throwable $throwable) {
            log_slack(['INDOMIE SUCCESS', raw_throwable($throwable)],
                'https://hooks.slack.com/services/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');
            return false;
        }
    }

    function disburse_airtime_guzz($msisdn, $amount, $network)
    {
        try {
            $payload = [
                "accountNumber" => '233'.substr($msisdn, -9),
                "amount" => $amount,
                "carrier" => $network,
                "loop_size" => 1,
            ];
            $headers = [
                'access-id' => 'sInR5cCI6IkpXVCJ9_=',
                'Content-Type' => 'application/json',
            ];

            $resp = guzz('https://sevotransact.com/api/v1/send-airtime', json_encode($payload), $headers);

            //$resp1 = Http::withHeaders($headers)->post('https://sevotransact.com/api/v1/send-airtime', $payload)->body();

            $transact = json_decode($resp, true);

            //log_JSON_file($transact, 'air');

            return $transact[0];

        } catch (Throwable $throwable) {
            log_slack(['INDOMIE SUCCESS', raw_throwable($throwable)],
                'https://hooks.slack.com/services/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');
            return false;
        }
    }

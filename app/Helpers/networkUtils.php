<?php

    use App\Models\Carrier;
    use App\Models\contactUpload;
    use App\Models\EnrichedMobileNumber;
    use App\Models\Network;
    use GuzzleHttp\Client;
    use Illuminate\Support\Facades\DB;

    function get_domain($url)
    {
        $result = parse_url($url);
        if (isset($result['scheme'])) {
            return $result['host'];
        }

        return $result['path'];
    }

    function store_in_cookie($name, $value)
    {
        // print_r($_COOKIE);
        setcookie($name, $value, time() + 60 * 60 * 24 * 7);
    }

    function get_network_from_id($name)
    {
        return Network::where('display_name', $name)->value('code');
    }

    function guzz($url, $payload, $header = [])
    {
        $client = new Client();

        $response = $client->post($url, [
            'debug' => false,
            'body' => $payload,
            'headers' => $header,
        ]);

        $body = $response->getBody();
        log_JSON_file($body, 'aiR');
        return $body;

    }

    function guzz_v1($url, $payload, $header = [])
    {
        $client = new Client();

        $response = $client->post($url, [
            'debug' => false,
            'body' => $payload,
        ]);

        $body = $response->getBody();
        log_JSON_file($body, 'slackfdg');
        return json_decode((string) $body);

    }

    function networkSearchSend($phone, $airtime, $stored_network = null)
    {
        $networks = network::where('code', '!=', $stored_network)->get();

        foreach ($networks as $count => $network) {
            $disbursed = disburse_airtime($phone, $airtime, $network->code);
            if ($disbursed['status'] === 'OK') {
                $msg = "Congratulations you have won airtime of GHS $airtime for patronizing the indomie brand.";

                send_sms_by_url('', $phone, $msg, 'Indomie_GH');

                log_slack(['INDOMIE SUCCESS', $msg],
                    'https://hooks.slack.com/services/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');

                return true;
            }

            if (($count + 1) === count($networks) && $disbursed['status'] !== 'OK') {
                $updateContact = DB::table('contact_uploads')->where('phone', '=', $phone)
                    ->update([
                        'status' => 'undisbursed',
                    ]);
                if ($updateContact) {
                    return false;
                }

            }
        }
    }

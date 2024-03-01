<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Jobs\DisburseAndSendSMSJB;
    use App\Models\CodeRedemption;
    use App\Models\PromoCode;
    use App\Models\PromoRedemption;
    use Illuminate\Http\Request;

    class RedeemController extends Controller
    {
        public function redeem(Request $request)
        {

            try {
                $available = PromoCode::where('code', $request->code)->where('status', 'new')->first();
                if ($available) {
                    $payload = new \stdClass();
                    $payload->code_id = $available->id;
                    $payload->mobile_number = $request->msisdn;
                    $payload->network = $request->network;
                    $this->updateRedeems($payload);

                    $dis_data = new \stdClass();
                    $dis_data->msisdn = $request->msisdn;
                    $dis_data->network = $request->network;

                    DisburseAndSendSMSJB::dispatch($dis_data);

                    return response()->json(
                        [
                            'success' => true,
                            'message' => 'Your code was successfully redeemed',
                        ]
                    );
                }
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Unable to complete process. Make sure your redemption code is  valid',
                    ]
                );

            } catch (\Throwable $throwable) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => $throwable->getMessage(),
                    ]
                );
            }

        }

        private function updateRedeems($payload)
        {

            $data = new PromoRedemption();
            $data->code_id = $payload->code_id;
            $data->mobile_number = $payload->mobile_number;
            $data->network = $payload->network;
            $data->airtime_allotted = env('AIRTIME');
            $data->amount_donated = env('DONATION');
            $data->status = 'success';
            $data->save();

            $redeem_code = PromoCode::where('id', $payload->code_id)->first();
            $redeem_code->status = 'used';
            $redeem_code->save();

        }
    }

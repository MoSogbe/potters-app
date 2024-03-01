<?php

    use GuzzleHttp\Client;

    function send_sms_by_url($msgid, $numto, $msgtext, $from, $dlrmask = 31)
    {
        $smsc = env('SMSC');

        $sendsmsurl = 'http://62.129.149.188:13013/cgi-bin/sendsms?'.
            'username='.env('NEW_KANNEL_USERNAME').'&password='.env('NEW_KANNEL_PASSWORD').
            '&from='.$from.'&to='.$numto.'&dlr-mask='.$dlrmask.'&text='.$msgtext.'&smsc='.$smsc;

        try {
            $response = \Illuminate\Support\Facades\Http::get($sendsmsurl)->body() ;
            $resp = explode(':', $response);
            return $resp[1];

        } catch (Throwable $th) {
            return array('error' => $th->getMessage());
        }
    }



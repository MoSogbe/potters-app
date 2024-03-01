<?php

    use App\Models\PromoRedemption;
    use App\Models\contactUpload;
    use App\Models\RunSchedule;
    use Carbon\Carbon;
    use App\Models\bundle_account;
    use Illuminate\Support\Facades\DB;

    function generate_code($length_of_string)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result),
            0, $length_of_string);
    }

    function generate_nums($length_of_string)
    {
        $str_result = '0123456789';
        return substr(str_shuffle($str_result),
            0, $length_of_string);
    }

    function get_data_1()
    {
        //$dayofweek = date('w', strtotime($date));
        return json_encode([10, 230, 130, 140, 270, 140, 583]);
    }

    function get_days_of_week()
    {

        $today = date('l', strtotime(contactUpload::whereDate('created_at', today())->value('created_at')));
        $yesterday = date('l',
            strtotime(contactUpload::whereDate('created_at', today()->subDays(1))->value('created_at')));
        $_2_days_ago = date('l',
            strtotime(contactUpload::whereDate('created_at', today()->subDays(2))->value('created_at')));
        $_3_days_ago = date('l',
            strtotime(contactUpload::whereDate('created_at', today()->subDays(3))->value('created_at')));
        $_4_days_ago = date('l',
            strtotime(contactUpload::whereDate('created_at', today()->subDays(4))->value('created_at')));
        $_5_days_ago = date('l',
            strtotime(contactUpload::whereDate('created_at', today()->subDays(5))->value('created_at')));
        $_6_days_ago = date('l',
            strtotime(contactUpload::whereDate('created_at', today()->subDays(6))->value('created_at')));

        return [$today, $yesterday, $_2_days_ago, $_3_days_ago, $_4_days_ago, $_5_days_ago, $_6_days_ago];
    }

    function get_daily_redeem_count()
    {
        $promo_redeems = contactUpload::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();

        $today_redeems = contactUpload::whereDate('created_at', today())->count();
        $yesterday_redeems = contactUpload::whereDate('created_at', today()->subDays(1))->count();
        $redeems_2_days_ago = contactUpload::whereDate('created_at', today()->subDays(2))->count();
        $redeems_3_days_ago = contactUpload::whereDate('created_at', today()->subDays(3))->count();
        $redeems_4_days_ago = contactUpload::whereDate('created_at', today()->subDays(4))->count();
        $redeems_5_days_ago = contactUpload::whereDate('created_at', today()->subDays(5))->count();
        $redeems_6_days_ago = contactUpload::whereDate('created_at', today()->subDays(6))->count();

        return json_encode([
            $today_redeems, $yesterday_redeems, $redeems_2_days_ago, $redeems_3_days_ago, $redeems_4_days_ago,
            $redeems_5_days_ago, $redeems_6_days_ago,
        ]);
    }

    function get_total_donations()
    {
        $promo_redeems = contactUpload::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();

        $today_donated = contactUpload::whereDate('created_at', today())->sum('airtime_amount');
        $yesterday_donated = contactUpload::whereDate('created_at', today()->subDays(1))->sum('airtime_amount');
        $donated_2_days_ago = contactUpload::whereDate('created_at', today()->subDays(2))->sum('airtime_amount');

        $donated_3_days_ago = contactUpload::whereDate('created_at', today()->subDays(3))->sum('airtime_amount');
        $donated_4_days_ago = contactUpload::whereDate('created_at', today()->subDays(4))->sum('airtime_amount');
        $donated_5_days_ago = contactUpload::whereDate('created_at', today()->subDays(5))->sum('airtime_amount');
        $donated_6_days_ago = contactUpload::whereDate('created_at', today()->subDays(6))->sum('airtime_amount');

        return json_encode([
            $today_donated, $yesterday_donated, $donated_2_days_ago, $donated_3_days_ago, $donated_4_days_ago,
            $donated_5_days_ago, $donated_6_days_ago,
        ]);

    }

    function get_total_airtime()
    {
        $promo_airtime = contactUpload::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();

        $today_airtime = contactUpload::whereDate('created_at', today())->sum('airtime_amount');
        $yesterday_airtime = contactUpload::whereDate('created_at', today()->subDays(1))->sum('airtime_amount');
        $airtime_2_days_ago = contactUpload::whereDate('created_at', today()->subDays(2))->sum('airtime_amount');

        $airtime_3_days_ago = contactUpload::whereDate('created_at', today()->subDays(3))->sum('airtime_amount');
        $airtime_4_days_ago = contactUpload::whereDate('created_at', today()->subDays(4))->sum('airtime_amount');
        $airtime_5_days_ago = contactUpload::whereDate('created_at', today()->subDays(5))->sum('airtime_amount');
        $airtime_6_days_ago = contactUpload::whereDate('created_at', today()->subDays(6))->sum('airtime_amount');

        return json_encode([
            $today_airtime, $yesterday_airtime, $airtime_2_days_ago, $airtime_3_days_ago, $airtime_4_days_ago,
            $airtime_5_days_ago, $airtime_6_days_ago,
        ]);

    }

    function get_this_week_redeems()
    {
        $yesterday = Carbon::now()->subDays(-2);
        $one_week_ago = Carbon::now()->subWeeks();

        return contactUpload::where('created_at', '>=', $one_week_ago)
            ->where('created_at', '<=', $yesterday)
            ->get();
    }

    function get_last_week_redeems()
    {
        $two_weeks_ago = Carbon::now()->subWeeks(2);
        $one_week_ago = Carbon::now()->subWeeks();

        return contactUpload::where('created_at', '>=', $two_weeks_ago)
            ->where('created_at', '<=', $one_week_ago)
            ->get();
    }

    function total_this_week_donation_sum()
    {
        return contactUpload::whereBetween('created_at',
            [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('airtime_amount');
    }

    function total_this_week_airtime_sum()
    {
        return contactUpload::whereBetween('created_at',
            [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('airtime_amount');
    }

    function total_last_week_donation_sum()
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);

      return contactUpload::whereBetween('created_at', [$start_week, $end_week])->sum('airtime_amount');
    }

    function total_last_week_airtime_sum()
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);

        return contactUpload::whereBetween('created_at', [$start_week, $end_week])->sum('airtime_amount');
    }

    function get_last_month_redeems()
    {
        $yesterday = Carbon::now()->subDays();
        $one_month_ago = Carbon::now()->subMonth();

        return contactUpload::where('created_at', '>=', $one_month_ago)
            ->where('created_at', '<=', $yesterday)
            ->get();
    }

    function loadSchedule($payload){
        if(RunSchedule::value('last_record_id') < count($payload)){
            RunSchedule::truncate();
            $data = new RunSchedule();
            $data->last_record_id = json_encode($payload);
            $data->encountered_record = TRUE;
            $data->save();
        }
    }

    function checkBalance($amount){
        $balance = bundle_account::first();
        if(floatval($balance->balance) > 0){
        $balance->balance = (floatval($balance->balance) - floatval($amount)) ;
        $balance->save();
        }
    }

    function schedule_status()
    {
        return bundle_account::first()->encountered_record;
    }

    function excelValidator($phone)
    {
           $validPhone = substr($phone, -9);
           
    }

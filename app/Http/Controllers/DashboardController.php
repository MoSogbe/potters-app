<?php

    namespace App\Http\Controllers;

    use App\Charts\RedeemChart;
    use App\Models\Product;
    use App\Models\User;
    use App\Models\ExcelUploadLog;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Yajra\DataTables\Facades\DataTables;

    class DashboardController extends Controller
    {
        public function index()
        {

            $product_count = Product::count();
            $user_count = User::count();
            $uploads = ExcelUploadLog::count();
            $file_upload = ExcelUploadLog::get();

            return view('pages.dashboard.index', compact('product_count','user_count','uploads','file_upload'));
        }

        public function uploadProduct()
        {
            return view('pages.dashboard.upload-contact');
        }


        public function listProducts()
        {
            $codes = Product::get();
            return view('pages.dashboard.view-products', compact('codes'));
        }

       
       

       
    }


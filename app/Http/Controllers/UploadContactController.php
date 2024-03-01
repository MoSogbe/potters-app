<?php

namespace App\Http\Controllers;
    use App\Charts\RedeemChart;
use App\Jobs\ProcessProduct;
use App\Models\Product;
use App\Models\ExcelUploadLog;
    use App\Models\Uploads;
    use App\Models\ErrorLog;
    use App\Models\PromoRedemption;
    use Illuminate\Support\Facades\DB;
    use Yajra\DataTables\Facades\DataTables;
   use Illuminate\Http\Request;
   use Excel;
   use Auth;
   use Validator;
   use App\Imports\ProductImportClass;

class UploadContactController extends Controller
{

    public function moveContactFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlx,xlsx,csv|max:2048',
        ]);

        $fileName = date('YmdHis').'.'.$request->file->extension(); 
        $file = Auth::user()->id.'-'.$fileName; 
        $path=$request->file->move(public_path('uploads/draft'), $file);
        $upload = new ExcelUploadLog();
        $upload->file_name = $file;
        $upload->status = 'in progress';
        $upload->uploaded_by = Auth::user()->id;
        $upload->save();
        ProcessProduct::dispatch($file);
        return redirect()->back()->with('success', 'File Uploading. Should be done in few minutes.');

    }


    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        $fileName = date('YmdHis').'.'.$request->file->extension(); 
        $file = Auth::user()->id.'-'.$fileName; 
        $path=$request->file->move(public_path('uploads/draft'), $file);
        $upload = new ExcelUploadLog();
        $upload->file_name = $file;
        $upload->status = 'in-progress';
        $upload->uploaded_by = Auth::user()->id;
        $upload->save();
        ProcessProduct::dispatch($file);
        return redirect()->back()->with('success', 'File Uploading. Should be done in few minutes.');
 
        // // Get the uploaded file
        // $file = $request->file('file');
 
        // // Process the Excel file
        // Excel::import(new ProductImportClass, $file);
 
        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }


    public function importContact(Request $request) 
    {
     $validator  = Validator::make($request->all(),[
         'file' => 'required|max:5000|mimes:xlsx,xls,csv'
     ]);

       if($validator->passes()) {
           $dataTime = date('Ymd_His');
           $file = $request->file('file');
           $fileName  = $dataTime. '-' .$file->getClientOriginalName();
           $savePath = public_path('uploads/draft/');
           $file->move($savePath,$fileName);
           $excel  = Importer::make('Excel');
           $excel->load($savePath.$fileName);
           $collection = $excel->getCollection();

           $arr = [];
           foreach($collection as $val=>$col){
               if($val > 0){
                $new_data = new contactUpload();
                    $new_data->name = $col[0];
                    $new_data->phone = $col[1];
                    $new_data->erp_outlet_id = $col[2];
                    $new_data->airtime_amount = $col[3];
                    $new_data->network = $col[4];
                    $new_data->save();
               }
               
           }
          
        return redirect()->back()->with(['success'=>'File Uploading. Should be done in few minutes.']);
       }else{
        return redirect()->back()
        ->with(['errors'=>$validator->errors()->all()]);
       }
      
    }
}

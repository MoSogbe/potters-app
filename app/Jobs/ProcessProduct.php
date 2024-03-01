<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use DirectoryIterator;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ExcelUploadLog;
use App\Models\ContactUploadErrorLogs;
use Excel;
use Auth;
use Validator;
use Importer;
use File;
use App\Imports\ProductImportClass;

class ProcessProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       
        $dir = new DirectoryIterator(data_path(public_path()));
        
        $is_initiated = ExcelUploadLog::where('file_name', $this->file)->first();

        $actual_file = data_path(public_path()).$is_initiated->file_name;
         // Process the Excel file
        $importfile =  Excel::import(new ProductImportClass, $actual_file);
        if($importfile){
            $is_initiated->status = 'success';
            $is_initiated->save();
        }else{
            $is_initiated->status = 'failed';
            $is_initiated->save();
        }
       
           
       

    }
        
        
         
        
        

}
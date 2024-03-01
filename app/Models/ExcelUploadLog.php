<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelUploadLog extends Model
{
    use HasFactory;
    protected $table = 'excel_upload_logs';

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}

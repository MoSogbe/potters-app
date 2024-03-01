<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Product;
class ProductImportClass implements ToModel, WithStartRow
{
    public function startRow(): int
        {
            return 2;
        }
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        if (!isset($row[0])) {
            return null;
        }
        
        // Define how to create a model from the Excel row data
        return new Product([
            'name' => $row[0],
            'description' => $row[1],
            'price' => $row[2],
            'quantity' => $row[3],
            
        ]);
    }
}

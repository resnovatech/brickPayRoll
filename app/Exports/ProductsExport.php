<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ProductsExport implements FromCollection,WithHeadings
{

    public function headings(): array {
        return [
            "product_name","cat_name","sub_cat_name","price","quantity",
            "sku","des","expire_date","discount_type","discount_amount"
        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select("product_name","cat_name","sub_cat_name","price","quantity",
        "sku","des","expire_date","discount_type","discount_amount")->get();
    }
}

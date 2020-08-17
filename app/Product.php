<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='tbl_employee';
    protected $filable = [
        "product_name", "sku", "description", "price", "quantity", "sales"
    ];
}
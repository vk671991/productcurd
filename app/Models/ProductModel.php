<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = "product_models";
    protected $fillable = ['Product_Title','Product_Description','Product_Price','Product_Image_Path','Product_Category','Product_Status','created_time','modified_time'];
}

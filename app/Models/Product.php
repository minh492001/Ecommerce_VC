<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    static public function getRecord()
    {
        return Product::select('product.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'product.created_by')
            ->orderBy('product.id', 'DESC')
            ->paginate(10);
    }
}

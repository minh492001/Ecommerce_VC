<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brand';

    static public function getRecord()
    {
        return self::select('brand.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'brand.created_by')
            ->orderBy('brand.id', 'desc')
            ->paginate(10);
    }

}

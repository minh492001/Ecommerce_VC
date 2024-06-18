<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'color';

    static public function getRecord()
    {
        return self::select('color.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'color.created_by')
            ->orderBy('color.id', 'desc')
            ->paginate(10);
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';

    static public function getRecord()
    {
        return Category::select('category.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'category.created_by')
            ->orderBy('category.id', 'desc')
            ->paginate(10);
    }

    static public function getSingle($id)
    {
        return Category::find($id);
    }

    static public function getSingleSlug($slug)
    {
        return Category::where('slug', '=', $slug)
            ->where('category.status', '=', 0)
            ->first();
    }

    static public function getRecordActive()
    {
        return Category::select('category.*')
            ->join('users', 'users.id', '=', 'category.created_by')
            ->where('category.status', '=', 0)
            ->orderBy('category.name', 'asc')
            ->paginate(10);
    }

    static public function getRecordMenu()
    {
        return Category::select('category.*')
            ->join('users', 'users.id', '=', 'category.created_by')
            ->where('category.status', '=', 0)
            ->get();
    }

    public function getSubCategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id')
            ->where('sub_category.status', '=', 0);
    }
}

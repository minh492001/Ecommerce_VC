<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Color::getRecord();
        $data['header_title'] = 'Color';
        return view('admin.color.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add Color';
        return view('admin.color.add', $data);
    }

    public function insert(Request $request)
    {
        $color = new Color;
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->created_by = Auth::user()->id;
        $color->save();

        return redirect('admin/color/list')->with('success', 'Color added successfully !');
    }

    public function edit($id)
    {
        $data['getRecord'] = Color::getSingle($id);
        $data['header_title'] = 'Edit Color';
        return view('admin.color.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $color = Color::getSingle($id);
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->save();

        return redirect('admin/color/list')->with('success', 'Color updated successfully !');
    }

    public function delete($id)
    {
        $color = Color::getSingle($id);
        $color->delete();
        return redirect()->back()->with('success', 'Color deleted successfully !');
    }
}

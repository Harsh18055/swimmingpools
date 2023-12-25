<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Cimage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DataTables;
use File;
class CategoryController extends Controller
{
    public function list()
    {
        return view('admin.category.list');
    }

    public function getdatatable(Request $request)
    {

        $About = Category::select('*');
        
        $dataTable = Datatables::of($About)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($data) {
                        $html = '<a href="' . route('admin.category.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                                    <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                <a href="' . route('admin.category.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
                                    <i class="fa fa-trash"></i>
                                </a>';
                        return $html;
                    })                    
                    ->editColumn('id', function ($data) {
                        static $index = 1;
                        return $index++;
                    })
                    ->rawColumns(['actions']);
     
        
        return $dataTable->make();
        // return response()->json($dataTable, 200);
    }

    //Edit And Add:
    public function manage_about(Request $request, $id = "")
    {
        if ($id > 0) {
            $About = Category::find($id);
            $result['c_name'] = $About->c_name;
            $result['Cimages'] = Cimage::where('c_id',$id)->get();
            $result['id'] = $About->id;
        } else {
            $result['c_name'] = '';
            $result['id'] = '';
        }

         $result['cimage'] = Cimage::get();
        return view('admin.category.manage_category', $result);
    }

     public function manage_process(Request $request)
{
    $validator = Validator::make($request->all(), [
        'c_name' => 'required',
        
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    $message = "";
    // $Category = ($request->post('id') > 0) ? Category::find($request->post('id')) : new Category;
        // return $Category;
    $id = $request->input('id');
    if ($id > 0) {
        $Category = Category::find($id);
    } else {
        $Category = new Category;
    }

    
    // return $Category->id;
    
    $Category->c_name = $request->post('c_name');
    $Category->save();
    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $file) {
            if ($file->isValid()) {
                $name = uniqid() . '.' . $file->getClientOriginalExtension();
                $upload_path = 'admin/assets/media/categoryimages';

                $file->move($upload_path, $name);

                $Cimage = new Cimage;
                $Cimage->c_id =  $Category->id;
                $Cimage->image =  $name;
                $Cimage->save();
            }
        }
    }
    $message = $Category->wasRecentlyCreated ? "New Category Uploaded!" : "Category Updated!";

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
}

    public function delete_category_image(Request $request, $id = "",)
{
    $Cimages = Cimage::find($id);
    $image_path = "admin/assets/media/categoryimages".$Cimages->image;

        if(File::exists($image_path)) {
        File::delete($image_path);
        }
        $Cimages = Cimage::find($id)->delete();

    return redirect()->back()->with('success', 'Product image(s) deleted successfully');
}
    //Delete
    public function delete($id)
    {
        $Filter = Category::findOrFail($id);
        $Filter->delete();
        $message = 'About Us delete successfully!';
        return redirect('admin/category')->with('delete', $message );
    }
}




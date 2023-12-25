<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cimage;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use DataTables;


class ImgesController extends Controller
{
    public function list()
    {
        return view('admin.categoryimage.list');
    }

    public function getdatatable(Request $request)
    {

        $About['cimage'] = Cimage::join('category' , 'cimage.c_id' , '=' , 'category.id')
        ->select('cimage.*','category.c_name as category_name')
        ->get();
        
        $dataTable = Datatables::of($About['cimage'])
                    ->addIndexColumn()
                    ->addColumn('actions', function ($data) {
                        $html = '<a href="' . route('admin.categoryimages.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                                    <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                <a href="' . route('admin.categoryimages.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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
    public function manage_images(Request $request, $id = "")
    {
        if ($id > 0) {
            $About = Cimage::find($id);
            $result['images'] = $About->images;
            $result['id'] = $About->id;
            $result['c_id'] = $About->c_id;
        } else {
            $result['c_id'] = '';
            $result['images'] = '';
            $result['id'] = '';
        }
        $result['category'] = Category::get();

        return view('admin.categoryimage.manage_categoryimage', $result);
    }

     public function manage_process(Request $request)
{
    $validator = Validator::make($request->all(), [
        'c_id' => 'required' ,   
        'images' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    $message = "";
    $about = ($request->post('id') > 0) ? Cimage::find($request->post('id')) : new Cimage;

   $uploadAndDelete = function ($fileInput, $uploadPath, $folder) use ($about, $request) {
    if ($request->hasfile($fileInput)) {
        $oldImages = json_decode($about->{$fileInput}, true) ?? [];

        // Delete old images if they exist
        foreach ($oldImages as $oldImage) {
            $oldImagePath = $folder . '/' . $oldImage;
            if (file_exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }

        $newImages = [];

        // Upload new images
        foreach ($request->file($fileInput) as $file) {
            $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $name);
            $newImages[] = $name;
        }

        $about->{$fileInput} = json_encode($newImages);
    }
};


    // Upload and delete for each image
    
    $uploadAndDelete('images', 'admin/assets/media/categoryimages', 'admin/assets/media/categoryimages');
    $about->c_id = $request->input('c_id');
    $about->save();

    $message = $about->wasRecentlyCreated ? "New Category Images Uploaded!" : "Category Images Updated!";

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
}




    //Delete
    public function delete($id)
    {
        $Filter = Cimage::findOrFail($id);
        $Filter->delete();
        $message = 'About Us delete successfully!';
        return redirect('admin/categoryimages')->with('delete', $message );
    }
}

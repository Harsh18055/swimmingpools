<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use DataTables;

class AboutController extends Controller
{
    public function list()
    {
        return view('admin.slider.list');
    }

    public function getdatatable(Request $request)
    {

        $About = About::select('*');
        
        $dataTable = Datatables::of($About)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($data) {
                        $html = '<a href="' . route('admin.slider.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                                    <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                <a href="' . route('admin.slider.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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
            $About = About::find($id);
            $result['image'] = $About->image;
            $result['heading'] = $About->heading;
            $result['text'] = $About->text;
            $result['btntext'] = $About->btntext;
            $result['link'] = $About->link;
            $result['id'] = $About->id;
        } else {
            $result['image'] = '';
            $result['heading'] = '';
            $result['text'] = '';
            $result['btntext'] = '';
            $result['link'] = '';
            $result['id'] = '';
        }
        return view('admin.slider.manage_about', $result);
    }

     public function manage_process(Request $request)
{
    $validator = Validator::make($request->all(), [
        
        'heading' => 'required',
        'text' => 'required',
        'btntext' => 'required',
        'link' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    $message = "";
    $about = ($request->post('id') > 0) ? About::find($request->post('id')) : new About;

    // Function to handle file upload and deletion
    $uploadAndDelete = function ($fileInput, $uploadPath, $folder) use ($about, $request) {
        if ($request->hasfile($fileInput)) {
            $oldProfile = $folder . '/' . $about->{$fileInput};

            if ($about->id && file_exists($oldProfile)) {
                File::delete($oldProfile);
            }

            $file = $request->file($fileInput);
            $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $name);

            $about->{$fileInput} = $name;
        }
    };

    // Upload and delete for each image
    $uploadAndDelete('image', 'admin/assets/media/about', 'admin/assets/media/about');

    $about->heading = $request->post('heading');
    $about->text = $request->post('text');
    $about->btntext = $request->post('btntext');
    $about->link = $request->post('link');
    $about->save();

    $message = $about->wasRecentlyCreated ? "New About Us Uploaded!" : "About Us Updated!";

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
}


    //Delete
    public function delete($id)
    {
        $Filter = About::findOrFail($id);
        $Filter->delete();
        $message = 'About Us delete successfully!';
        return redirect('admin/slider')->with('delete', $message );
    }
}

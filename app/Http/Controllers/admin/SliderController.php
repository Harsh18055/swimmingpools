<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use DataTables;

class SliderController extends Controller
{
     public function list()
    {
        return view('admin.about.list');
    }

    public function getdatatable(Request $request)
    {

        $About = Slider::select('*');
        
        $dataTable = Datatables::of($About)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($data) {
                        $html = '<div style="text-align:center;"> 
                        <a href="' . route('admin.about.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <div>';
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
            $About = Slider::find($id);
            $result['image'] = $About->image;
            $result['heading'] = $About->heading;
            $result['text'] = $About->text;
            $result['id'] = $About->id;
        } else {
            $result['image'] = '';
            $result['heading'] = '';
            $result['text'] = '';
            $result['id'] = '';
        }
        return view('admin.about.manage_about', $result);
    }

     public function manage_process(Request $request)
{
    $validator = Validator::make($request->all(), [
       
        'heading' => 'required',
        'text' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    $message = "";
    $about = ($request->post('id') > 0) ? Slider::find($request->post('id')) : new Slider;

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
    $uploadAndDelete('image', 'admin/assets/media/slider', 'admin/assets/media/slider');

    $about->heading = $request->post('heading');
    $about->text = $request->post('text');
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
        $Filter = Slider::findOrFail($id);
        $Filter->delete();
        $message = 'About Us delete successfully!';
        return redirect('admin/about')->with('delete', $message );
    }
}

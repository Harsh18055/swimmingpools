<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use DataTables;

class TestimonialController extends Controller
{
     public function list()
    {
        return view('admin.testimonial.list');
    }

    public function getdatatable(Request $request)
    {

        $About = Testimonial::select('*');
        
        $dataTable = Datatables::of($About)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($data) {
                       $html = '<a href="' . route('admin.testimonial.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                                    <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                <a href="' . route('admin.testimonial.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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
    public function manage_testimonial(Request $request, $id = "")
    {
        if ($id > 0) {
            $About = Testimonial::find($id);
            $result['desperation'] = $About->desperation;
            $result['profile'] = $About->profile;
            $result['heading'] = $About->heading;
            $result['review'] = $About->review;
            $result['id'] = $About->id;
        } else {
            $result['desperation'] = '';
            $result['profile'] = '';
            $result['heading'] = '';
            $result['review'] = '';
            $result['id'] = '';
        }
        return view('admin.testimonial.manage_testimonial', $result);
    }

     public function manage_process(Request $request)
{
    $validator = Validator::make($request->all(), [
        'desperation' => 'required',
        'heading' => 'required',
        'review' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    $message = "";
    $about = ($request->post('id') > 0) ? Testimonial::find($request->post('id')) : new Testimonial;

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
    $uploadAndDelete('profile', 'admin/assets/media/testimonial', 'admin/assets/media/testimonial');

    $about->desperation = $request->post('desperation');
    $about->heading = $request->post('heading');
    $about->review = $request->post('review');
    $about->save();

    $message = $about->wasRecentlyCreated ? "New Testimonial Uploaded!" : "Testimonial Updated!";

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
}


    //Delete
    public function delete($id)
    {
        $Filter = Testimonial::findOrFail($id);
        $Filter->delete();
        $message = 'Testimonial Delete Successfully!';
        return redirect('admin/testimonial')->with('delete', $message );
    }
}

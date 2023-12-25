<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use DataTables;

class FooterController extends Controller
{
    public function list()
    {
        return view('admin.footer.list');
    }

    public function getdatatable(Request $request)
    {

        $About = footer::select('*');
        
        $dataTable = Datatables::of($About)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($data) {
                        $html = '<div style="text-align:center;">
                        <a href="' . route('admin.footer.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary " data-bs-toggle="tooltip" title="Edit foam">
                                 <i class="fa fa-edit"></i>
                                </a>
                        </div>';
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
    public function manage_footer(Request $request, $id = "")
    {
        if ($id > 0) {
            $About = Footer::find($id);
            $result['logo'] = $About->logo;
            $result['desperation'] = $About->desperation;
            $result['location'] = $About->location;
            $result['phone'] = $About->phone;
            $result['email'] = $About->email;
            $result['heading'] = $About->heading;
            $result['text'] = $About->text;
            $result['id'] = $About->id;
        } else {
            $result['logo'] = '';
            $result['desperation'] = '' ;
            $result['location'] = '';
            $result['phone'] = '';
            $result['email'] = '';
            $result['heading'] = '';
            $result['text'] = '';
            $result['id'] = '';
        }
        return view('admin.footer.manage_footer', $result);
    }

     public function manage_process(Request $request)
{
    $validator = Validator::make($request->all(), [
        
        'desperation' => 'required',
        'location' => 'required',
        'phone' => 'required',
        'email' => 'required',
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
    $about = ($request->post('id') > 0) ? Footer::find($request->post('id')) : new Footer;

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
    $uploadAndDelete('logo', 'admin/assets/media/footer', 'admin/assets/media/footer');

     $about->desperation = $request->post('desperation');
    $about->location = $request->post('location');
    $about->phone = $request->post('phone');
     $about->email = $request->post('email');
    $about->heading = $request->post('heading');
    $about->text = $request->post('text');
    $about->save();

    $message = $about->wasRecentlyCreated ? "New Footer Uploaded!" : "Footer Updated!";

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
}


    //Delete
    public function delete($id)
    {
        $Filter = Footer::findOrFail($id);
        $Filter->delete();
        $message = 'Footer Delete Successfully!';
        return redirect('admin/footer')->with('delete', $message );
    }
}

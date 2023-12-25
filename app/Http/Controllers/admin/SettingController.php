<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DataTables;
use File;

class SettingController extends Controller
{
     public function list()
    {
        return view('admin.setting.list');
    }

    public function getdatatable(Request $request)
    {

        $About = Setting::select('*');
        
        $dataTable = Datatables::of($About)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($data) {
                        $html = '<div style="text-align:center;">
                        <a href="' . route('admin.setting.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
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
    public function manage_setting(Request $request, $id = "")
    {
        if ($id > 0) {
            $About = Setting::find($id);
            $result['logo'] = $About->logo;
            $result['id'] = $About->id;
        } else {
            $result['logo'] = '';
            $result['id'] = '';
        }
        return view('admin.setting.manage_setting', $result);
    }

     public function manage_process(Request $request)
{
    $validator = Validator::make($request->all(), [
        'logo' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    $message = "";
    $about = ($request->post('id') > 0) ? Setting::find($request->post('id')) : new Setting;

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
    $uploadAndDelete('logo', 'admin/assets/media/setting', 'admin/assets/media/setting');

    $about->save();

    $message = $about->wasRecentlyCreated ? "Setting Uploaded!" : "Setting Updated!";

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
}
}

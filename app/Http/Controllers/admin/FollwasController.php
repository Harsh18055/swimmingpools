<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use DataTables;

class FollwasController extends Controller
{
    public function list()
    {
        return view('admin.followas.list');
    }

    public function getdatatable(Request $request)
    {

        $About = Footers::select('*');
        
        $dataTable = Datatables::of($About)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($data) {
                        $html = '<div style="text-align:center;">
                        <a href="' . route('admin.followas.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
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
    public function manage_followas(Request $request, $id = "")
    {
        if ($id > 0) {
            $About = Footers::find($id);
            $result['facebook'] = $About->facebook;
            $result['intagram'] = $About->intagram;
            $result['linkdin'] = $About->linkdin;
            $result['twitter'] = $About->twitter;
            $result['id'] = $About->id;
        } else {
            $result['facebook'] = '';
            $result['intagram'] = '';
            $result['linkdin'] = '';
            $result['twitter'] = '';
            $result['id'] = '';
        }
        return view('admin.followas.manage_followas', $result);
    }

     public function manage_process(Request $request)
{
    $validator = Validator::make($request->all(), [
        'facebook' => 'required',
        'intagram' => 'required',
        'linkdin' => 'required',
        'twitter' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    $message = "";
    $about = ($request->post('id') > 0) ? Footers::find($request->post('id')) : new Footers;


    $about->facebook = $request->post('facebook');
    $about->intagram = $request->post('intagram');
    $about->linkdin = $request->post('linkdin');
    $about->twitter = $request->post('twitter');
    $about->save();

    $message = $about->wasRecentlyCreated ? "New Follow AS Uploaded!" : "Follow Us Updated!";

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
}


    //Delete
    public function delete($id)
    {
        $Filter = Footers::findOrFail($id);
        $Filter->delete();
        $message = 'Follow Us delete successfully!';
        return redirect('admin/followas')->with('delete', $message );
    }
}

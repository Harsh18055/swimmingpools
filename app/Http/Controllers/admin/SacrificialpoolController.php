<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Sacrificialpool;
use DataTables;



class SacrificialpoolController extends Controller
{
    //User
    public function list(){
        return view('admin.sacrificialpool.list');
    }

    public function getdatatable(Request $request)
    {

        $Sacrificialpool = Sacrificialpool::select('*');
        
        $dataTable = Datatables::of($Sacrificialpool)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($data) {
                        $html = '<a href="' . route('admin.sacrificialpool.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                                    <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                <a href="' . route('admin.sacrificialpool.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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

    public function manage_sacrificial(Request $request, $id = "")
    {
        if ($id > 0) {
            $result['sacrificial'] = Sacrificialpool::find($id);
        } else {
            $result['sacrificial'] = '';
        }
    
        return view('admin.sacrificialpool.manage_sacrificialpool', $result);
    }

    public function delete($id)
    {
        $sacrificial = Sacrificialpool::findOrFail($id);
        $sacrificial->delete();
        $message = 'Sacrificial delete successfully!';
           return redirect('admin/sacrificialpool')->with('delete', $message );
    }

    public function store(Request $request)
{

    // return $request->all();
    $validator = Validator::make($request->all(), [
        'modelname' => 'required',
        'includes' => 'required',
        'price' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    $id = $request->input('id');

    if ($id > 0) {
        $sacrificial = Sacrificialpool::find($id);
        $message = 'Sacrificial updated successfully!';
    } else {
        $sacrificial = new Sacrificialpool;
        $message = 'Sacrificial created successfully!';
    }

    $sacrificial->modelname = $request->input('modelname');
    $sacrificial->includes = $request->input('includes');
    $sacrificial->price = $request->input('price');
    $sacrificial->save();

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
}
}

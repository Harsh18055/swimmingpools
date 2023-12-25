<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterVolume;
use App\Models\Inlets;
use App\Models\admin\Sacrificialpool;
use Illuminate\Support\Facades\Validator;
use DataTables;


class InletsController extends Controller
{
    public function list(){
       
        return view('admin.inlets.list');
    }

    public function getdatatable(Request $request)
    {
        $result['inlets'] = Inlets::join('water_volume', 'inlets.watervolume_id', '=', 'water_volume.id')
        ->select('inlets.*', 'water_volume.name as water_volume_name') // Select the columns you need from both tables
        ->get();
    
        $dataTable = Datatables::of($result['inlets'])
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                $html = '<a href="' . route('admin.inlets.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                            <i class="fa fa-edit"></i>
                        </a>&nbsp;
                        <a href="' . route('admin.inlets.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
                            <i class="fa fa-trash"></i>
                        </a>';
                return $html;
            })
            ->editColumn('id', function ($data) {
                static $index = 1;
                return $index++;
            })
            ->rawColumns(['actions'])
            ->make(true); // Use true to enable JSON response
    
        return $dataTable;
        // return response()->json($dataTable, 200);
    }

    public function manage_inlet(Request $request, $id = "")
    {
        if ($id > 0) {
            $Inlets = Inlets::find($id);
            $result['name'] = $Inlets->name;
            $result['price'] = $Inlets->price;
            $result['id'] = $Inlets->id;
            $result['watervolume_id'] = $Inlets->watervolume_id;
        } else {
            $result['watervolume_id'] = '';
            $result['name'] = '';
            $result['price'] = '';
            $result['id'] = '';
        }
        $result['watervolume'] = WaterVolume::get();
        return view('admin.inlets.manage_inlets', $result);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'watervolume_id' => 'required',
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
            $Inlets = Inlets::find($id);
            $message = 'Inlets updated successfully!';
        } else {
            $Inlets = new Inlets;
            $message = 'Inlets created successfully!';
        }

        $Inlets->name = $request->input('name');
        $Inlets->price = $request->input('price');
        $Inlets->watervolume_id = $request->input('watervolume_id');
        $Inlets->save();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        $Inlets = Inlets::findOrFail($id);
        $Inlets->delete();
        $message = 'Inlets delete successfully!';
           return redirect('admin/inlets')->with('delete', $message );
    }
}

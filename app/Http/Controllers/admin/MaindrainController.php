<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterVolume;
use App\Models\Maindrain;
use App\Models\admin\Sacrificialpool;
use Illuminate\Support\Facades\Validator;
use DataTables;


class MaindrainController extends Controller
{
    public function list(){
       
        return view('admin.maindrain.list');
    }

    public function getdatatable(Request $request)
{
    $result['maindrain'] = Maindrain::join('water_volume', 'maindrains.watervolume_id', '=', 'water_volume.id')
            ->select('maindrains.*', 'water_volume.name as water_volume_name') // Select the columns you need from both tables
            ->get();

    $dataTable = Datatables::of($result['maindrain'])
        ->addIndexColumn()
        ->addColumn('actions', function ($data) {
            $html = '<a href="' . route('admin.maindrain.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                        <i class="fa fa-edit"></i>
                    </a>&nbsp;
                    <a href="' . route('admin.maindrain.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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


    public function manage_maindrain(Request $request, $id = "")
    {
        if ($id > 0) {
            $Maindrain = Maindrain::find($id);
            $result['name'] = $Maindrain->name;
            $result['price'] = $Maindrain->price;
            $result['id'] = $Maindrain->id;
            $result['watervolume_id'] = $Maindrain->watervolume_id;
        } else {
            $result['watervolume_id'] = '';
            $result['name'] = '';
            $result['price'] = '';
            $result['id'] = '';
        }
        $result['watervolume'] = WaterVolume::get();
        return view('admin.maindrain.manage_maindrain', $result);
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
            $Maindrain = Maindrain::find($id);
            $message = 'Maindrain updated successfully!';
        } else {
            $Maindrain = new Maindrain;
            $message = 'Maindrain created successfully!';
        }

        $Maindrain->name = $request->input('name');
        $Maindrain->price = $request->input('price');
        $Maindrain->watervolume_id = $request->input('watervolume_id');
        $Maindrain->save();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        $Maindrain = Maindrain::findOrFail($id);
        $Maindrain->delete();
        $message = 'Maindrain delete successfully!';
           return redirect('admin/maindrain')->with('delete', $message );
    }
}

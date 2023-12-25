<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterVolume;
use App\Models\Pump;
use App\Models\admin\Sacrificialpool;
use Illuminate\Support\Facades\Validator;
use DataTables;


class PumpController extends Controller
{
    public function list(){
        
        return view('admin.pump.list');
    }

    public function getdatatable(Request $request)
{
    $result['pump'] = Pump::join('water_volume', 'pump.watervolume_id', '=', 'water_volume.id')
            ->select('pump.*', 'water_volume.name as water_volume_name') // Select the columns you need from both tables
            ->get();
    $dataTable = Datatables::of($result['pump'])
        ->addIndexColumn()
        ->addColumn('actions', function ($data) {
            $html = '<a href="' . route('admin.pump.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                        <i class="fa fa-edit"></i>
                    </a>&nbsp;
                    <a href="' . route('admin.pump.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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

    public function manage_pump(Request $request, $id = "")
    {
        if ($id > 0) {
            $Pump = Pump::find($id);
            $result['name'] = $Pump->name;
            $result['price'] = $Pump->price;
            $result['id'] = $Pump->id;
            $result['watervolume_id'] = $Pump->watervolume_id;
        } else {
            $result['watervolume_id'] = '';
            $result['name'] = '';
            $result['price'] = '';
            $result['id'] = '';
        }
        $result['watervolume'] = WaterVolume::get();
        return view('admin.pump.manage_pump', $result);
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
            $Pump = Pump::find($id);
            $message = 'Pump updated successfully!';
        } else {
            $Pump = new Pump;
            $message = 'Pump created successfully!';
        }

        $Pump->name = $request->input('name');
        $Pump->price = $request->input('price');
        $Pump->watervolume_id = $request->input('watervolume_id');
        $Pump->save();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        $Pump = Pump::findOrFail($id);
        $Pump->delete();
        $message = 'Pump delete successfully!';
           return redirect('admin/pump')->with('delete', $message );
    }
}

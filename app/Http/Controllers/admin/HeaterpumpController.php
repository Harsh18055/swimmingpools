<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterVolume;
use App\Models\Heaterpump;
use App\Models\admin\Sacrificialpool;
use Illuminate\Support\Facades\Validator;
use DataTables;


class HeaterpumpController extends Controller
{
    public function list(){
        
        return view('admin.heaterpump.list');
    }

    public function getdatatable(Request $request)
{
    $result['heaterpump'] = Heaterpump::join('water_volume', 'heaterpumps.watervolume_id', '=', 'water_volume.id')
            ->select('heaterpumps.*', 'water_volume.name as water_volume_name') // Select the columns you need from both tables
            ->get();

    $dataTable = Datatables::of($result['heaterpump'])
        ->addIndexColumn()
        ->addColumn('actions', function ($data) {
            $html = '<a href="' . route('admin.heaterpump.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                        <i class="fa fa-edit"></i>
                    </a>&nbsp;
                    <a href="' . route('admin.heaterpump.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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

    public function manage_heaterpump(Request $request, $id = "")
    {
        if ($id > 0) {
            $Heaterpump = Heaterpump::find($id);
            $result['name'] = $Heaterpump->name;
            $result['price'] = $Heaterpump->price;
            $result['id'] = $Heaterpump->id;
            $result['watervolume_id'] = $Heaterpump->watervolume_id;
        } else {
            $result['watervolume_id'] = '';
            $result['name'] = '';
            $result['price'] = '';
            $result['id'] = '';
        }
        $result['watervolume'] = WaterVolume::get();
        return view('admin.heaterpump.manage_heaterpump', $result);
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
            $Heaterpump = Heaterpump::find($id);
            $message = 'Heaterpump updated successfully!';
        } else {
            $Heaterpump = new Heaterpump;
            $message = 'Heaterpump created successfully!';
        }

        $Heaterpump->name = $request->input('name');
        $Heaterpump->price = $request->input('price');
        $Heaterpump->watervolume_id = $request->input('watervolume_id');
        $Heaterpump->save();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        $Heaterpump = Heaterpump::findOrFail($id);
        $Heaterpump->delete();
        $message = 'Heaterpump delete successfully!';
           return redirect('admin/heaterpump')->with('delete', $message );
    }
}

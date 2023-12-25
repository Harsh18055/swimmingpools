<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterVolume;
use App\Models\Light;
use App\Models\admin\Sacrificialpool;
use Illuminate\Support\Facades\Validator;
use DataTables;


class LightController extends Controller
{
    public function list(){
       
        return view('admin.light.list');
    }

    public function getdatatable(Request $request)
    {
        $result['light'] = Light::join('water_volume', 'lights.watervolume_id', '=', 'water_volume.id')
            ->select('lights.*', 'water_volume.name as water_volume_name') // Select the columns you need from both tables
            ->get();
    
        $dataTable = Datatables::of($result['light'])
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                $html = '<a href="' . route('admin.light.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                            <i class="fa fa-edit"></i>
                        </a>&nbsp;
                        <a href="' . route('admin.light.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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

    public function manage_light(Request $request, $id = "")
    {
        if ($id > 0) {
            $Light = Light::find($id);
            $result['name'] = $Light->name;
            $result['price'] = $Light->price;
            $result['id'] = $Light->id;
            $result['watervolume_id'] = $Light->watervolume_id;
        } else {
            $result['watervolume_id'] = '';
            $result['name'] = '';
            $result['price'] = '';
            $result['id'] = '';
        }
        $result['watervolume'] = WaterVolume::get();
        return view('admin.light.manage_light', $result);
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
            $Light = Light::find($id);
            $message = 'Light updated successfully!';
        } else {
            $Light = new Light;
            $message = 'Light created successfully!';
        }

        $Light->name = $request->input('name');
        $Light->price = $request->input('price');
        $Light->watervolume_id = $request->input('watervolume_id');
        $Light->save();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        $Light = Light::findOrFail($id);
        $Light->delete();
        $message = 'Light delete successfully!';
           return redirect('admin/light')->with('delete', $message );
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterVolume;
use App\Models\Ozone;
use App\Models\admin\Sacrificialpool;
use Illuminate\Support\Facades\Validator;
use DataTables;


class OzoneController extends Controller
{
    public function list(){
       
        return view('admin.ozone.list');
    }

    public function getdatatable(Request $request)
{
    $result['ozone'] = Ozone::join('water_volume', 'ozones.watervolume_id', '=', 'water_volume.id')
    ->select('ozones.*', 'water_volume.name as water_volume_name') // Select the columns you need from both tables
    ->get();

    $dataTable = Datatables::of($result['ozone'])
        ->addIndexColumn()
        ->addColumn('actions', function ($data) {
            $html = '<a href="' . route('admin.ozone.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                        <i class="fa fa-edit"></i>
                    </a>&nbsp;
                    <a href="' . route('admin.ozone.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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

    public function manage_Ozone(Request $request, $id = "")
    {
        if ($id > 0) {
            $Ozone = Ozone::find($id);
            $result['name'] = $Ozone->name;
            $result['price'] = $Ozone->price;
            $result['id'] = $Ozone->id;
            $result['watervolume_id'] = $Ozone->watervolume_id;
        } else {
            $result['watervolume_id'] = '';
            $result['name'] = '';
            $result['price'] = '';
            $result['id'] = '';
        }
        $result['watervolume'] = WaterVolume::get();
        return view('admin.ozone.manage_ozone', $result);
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
            $Ozone = Ozone::find($id);
            $message = 'Ozone updated successfully!';
        } else {
            $Ozone = new Ozone;
            $message = 'Ozone created successfully!';
        }

        $Ozone->name = $request->input('name');
        $Ozone->price = $request->input('price');
        $Ozone->watervolume_id = $request->input('watervolume_id');
        $Ozone->save();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        $Ozone = Ozone::findOrFail($id);
        $Ozone->delete();
        $message = 'Ozone delete successfully!';
           return redirect('admin/ozone')->with('delete', $message );
    }
}

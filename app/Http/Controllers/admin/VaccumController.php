<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterVolume;
use App\Models\Vaccum;
use App\Models\admin\Sacrificialpool;
use Illuminate\Support\Facades\Validator;
use DataTables;


class VaccumController extends Controller
{
    public function list(){
        
        return view('admin.vaccums.list');
    }

    public function getdatatable(Request $request)
{
    $result['vaccum'] = Vaccum::join('water_volume', 'vaccums.watervolume_id', '=', 'water_volume.id')
    ->select('vaccums.*', 'water_volume.name as water_volume_name') // Select the columns you need from both tables
    ->get();
    $dataTable = Datatables::of($result['vaccum'])
        ->addIndexColumn()
        ->addColumn('actions', function ($data) {
            $html = '<a href="' . route('admin.vaccum.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                        <i class="fa fa-edit"></i>
                    </a>&nbsp;
                    <a href="' . route('admin.vaccum.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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

    public function manage_vaccum(Request $request, $id = "")
    {
        if ($id > 0) {
            $Vaccum = Vaccum::find($id);
            $result['name'] = $Vaccum->name;
            $result['price'] = $Vaccum->price;
            $result['id'] = $Vaccum->id;
            $result['watervolume_id'] = $Vaccum->watervolume_id;
        } else {
            $result['watervolume_id'] = '';
            $result['name'] = '';
            $result['price'] = '';
            $result['id'] = '';
        }
        $result['watervolume'] = WaterVolume::get();
        return view('admin.vaccums.manage_vaccums', $result);
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
            $Vaccum = Vaccum::find($id);
            $message = 'Vaccum updated successfully!';
        } else {
            $Vaccum = new Vaccum;
            $message = 'Vaccum created successfully!';
        }

        $Vaccum->name = $request->input('name');
        $Vaccum->price = $request->input('price');
        $Vaccum->watervolume_id = $request->input('watervolume_id');
        $Vaccum->save();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        $Vaccum = Vaccum::findOrFail($id);
        $Vaccum->delete();
        $message = 'Vaccum delete successfully!';
           return redirect('admin/vaccum')->with('delete', $message );
    }
}

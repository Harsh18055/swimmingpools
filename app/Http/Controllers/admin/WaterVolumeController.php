<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterVolume;
use App\Models\admin\Sacrificialpool;
use Illuminate\Support\Facades\Validator;
use DataTables;


class WaterVolumeController extends Controller
{
    public function list(){
        $result['watervolume'] = WaterVolume::all();
        return view('admin.watervolume.list', $result);
    }

    public function getdatatable(Request $request)
    {

        $WaterVolume = WaterVolume::select('*');
        
        $dataTable = Datatables::of($WaterVolume)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($data) {
                        $html = '<a href="' . route('admin.watervolume.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                                    <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                <a href="' . route('admin.watervolume.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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

    public function manage_watervolume(Request $request, $id = "")
    {
        if ($id > 0) {
            $watervolume = WaterVolume::find($id);
            $result['name'] = $watervolume->name;
            $result['id'] = $watervolume->id;
        } else {
            $result['watervolume'] = '';
            $result['name'] = '';
            $result['id'] = '';
        }
        return view('admin.watervolume.manage_watervolume', $result);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $id = $request->input('id');

        if ($id > 0) {
            $WaterVolume = WaterVolume::find($id);
            $message = 'WaterVolume updated successfully!';
        } else {
            $WaterVolume = new WaterVolume;
            $message = 'WaterVolume created successfully!';
        }

        $WaterVolume->name = $request->input('name');
        $WaterVolume->save();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        $WaterVolume = WaterVolume::findOrFail($id);
        $WaterVolume->delete();
        $message = 'WaterVolume delete successfully!';
           return redirect('admin/watervolume')->with('delete', $message );
    }
}

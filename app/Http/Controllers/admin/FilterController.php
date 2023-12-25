<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterVolume;
use App\Models\Filter;
use App\Models\admin\Sacrificialpool;
use Illuminate\Support\Facades\Validator;
use DataTables;


class FilterController extends Controller
{
    public function list(){
        
        return view('admin.filter.list');
    }

    public function getdatatable(Request $request)
{
    $result['filter'] = Filter::join('water_volume', 'filter.watervolume_id', '=', 'water_volume.id')
        ->select('filter.*', 'water_volume.name as water_volume_name')
        ->get(); // Make sure to get the data using get() or first() to fetch the results

    $dataTable = Datatables::of($result['filter'])
        ->addIndexColumn()
        ->addColumn('actions', function ($data) {
            $html = '<a href="' . route('admin.filter.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                        <i class="fa fa-edit"></i>
                    </a>&nbsp;
                    <a href="' . route('admin.filter.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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


    public function manage_filter(Request $request, $id = "")
    {
        if ($id > 0) {
            $Filter = Filter::find($id);
            $result['name'] = $Filter->name;
            $result['price'] = $Filter->price;
            $result['id'] = $Filter->id;
            $result['watervolume_id'] = $Filter->watervolume_id;
        } else {
            $result['watervolume_id'] = '';
            $result['name'] = '';
            $result['price'] = '';
            $result['id'] = '';
        }
        $result['watervolume'] = WaterVolume::get();
        return view('admin.filter.manage_filter', $result);
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
            $Filter = Filter::find($id);
            $message = 'Filter updated successfully!';
        } else {
            $Filter = new Filter;
            $message = 'Filter created successfully!';
        }

        $Filter->name = $request->input('name');
        $Filter->price = $request->input('price');
        $Filter->watervolume_id = $request->input('watervolume_id');
        $Filter->save();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        $Filter = Filter::findOrFail($id);
        $Filter->delete();
        $message = 'Filter delete successfully!';
           return redirect('admin/filter')->with('delete', $message );
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Femail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use DataTables;

class EmailController extends Controller
{
    public function list()
    {
        return view('admin.email.list');
    }

    public function getdatatable(Request $request)
    {

        $About = Femail::select('*');
        
        $dataTable = Datatables::of($About)
                    ->addIndexColumn()
                                       
                    ->editColumn('id', function ($data) {
                        static $index = 1;
                        return $index++;
                    })
                    ->rawColumns(['actions']);
     
        
        return $dataTable->make();
        // return response()->json($dataTable, 200);
    }

}

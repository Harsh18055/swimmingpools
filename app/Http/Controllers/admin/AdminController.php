<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\Validator;



class AdminController extends Controller
{
    public function index(Request $request){
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
        return view('admin.login');
    }

    public function create(Request $request){

        $model = new User();
        $model->name = 'admin';
        $model->email = 'admin@admin.com';
        $model->user_type = '1';
        $model->password = hash::make('admin');
        $model->save();
        
    }

    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $result=User::where(['email'=>$email])->first();

        if($result){
            if(Hash::check($request->post('password'),$result->password)){
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$result->id);
                // $request->session()->put('NAME',$result->name);
                $request->session()->put('USER_TYPE',$result->user_type);
                return redirect('admin/dashboard');
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect()->back();
            }
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect()->back();
        }
    }

    public function dashboard(){

        return view('admin.dashboard');
    }

    //User
    public function list(){
        
        return view('admin.register_user.list');
    }

    public function getdatatable(Request $request)
    {
        $result['user'] = User::where('user_type', 1)->get();
    
        $dataTable = Datatables::of($result['user'])
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                $html = '<a href="' . route('admin.user.user_edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                            <i class="fa fa-edit"></i>
                        </a>&nbsp;
                        <a href="' . route('admin.user.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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

    public function manage_user(Request $request, $id = "")
    {
        if ($id > 0) {
            $result['user'] = User::find($id);
        } else {
            $result['user'] = '';
        }
    
        return view('admin.register_user.manage_user', $result);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $message = 'User delete successfully!';
           return redirect('admin/registeruser')->with('delete', $message );
    }

    public function store(Request $request)
{

    // return $request->all();
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'address' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'quotestatus' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    $id = $request->input('id');

    if ($id > 0) {
        $user = User::find($id);
        $message = 'User updated successfully!';
    } else {
        $user = new User;
        $message = 'User created successfully!';
    }

    $user->name = $request->input('name');
    $user->password = hash::make($request->input('password'));
    $user->address = $request->input('address');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');
    $user->user_type = $request->input('user_type');
    $user->quotestatus = $request->input('quotestatus');
    $user->save();

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
}

        //manager 
public function listmanager(){
    
    return view('admin.register_manager.list');
}

public function getdatatablemanager(Request $request)
    {
        $result['user'] = User::where('user_type', 2)->get();
    
        $dataTable = Datatables::of($result['user'])
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                $html = '<a href="' . route('admin.manager.manager_edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                            <i class="fa fa-edit"></i>
                        </a>&nbsp;
                        <a href="' . route('admin.manager.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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


public function manage_manager(Request $request, $id = "")
{
    if ($id > 0) {
        $result['user'] = User::find($id);
    } else {
        $result['user'] = '';
    }

    return view('admin.register_manager.manage_manager', $result);
}

public function deletemanager($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    $message = 'User delete successfully!';
       return redirect('admin/registermanager')->with('delete', $message );
}

public function storelistmanager(Request $request)
{

// return $request->all();
$validator = Validator::make($request->all(), [
    'name' => 'required',
    'address' => 'required',
    'email' => 'required',
    'phone' => 'required',
    'quotestatus' => 'required',
]);

if ($validator->fails()) {
    return response()->json([
        'success' => false,
        'message' => $validator->errors()->first(),
    ]);
}

$id = $request->input('id');

if ($id > 0) {
    $user = User::find($id);
    $message = 'User updated successfully!';
} else {
    $user = new User;
    $message = 'User created successfully!';
}

$user->name = $request->input('name');
$user->password = hash::make($request->input('password'));
$user->address = $request->input('address');
$user->email = $request->input('email');
$user->phone = $request->input('phone');
$user->user_type = $request->input('user_type');
$user->quotestatus = $request->input('quotestatus');
$user->save();

return response()->json([
    'success' => true,
    'message' => $message,
]);
}

    //staff 
public function liststaff(){
    
    return view('admin.register_staffs.list');
}

public function getdatatablestaff(Request $request)
    {
        $result['user'] = User::where('user_type', 3)->get();
    
        $dataTable = Datatables::of($result['user'])
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                $html = '<a href="' . route('admin.staff.staff_edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                            <i class="fa fa-edit"></i>
                        </a>&nbsp;
                        <a href="' . route('admin.staff.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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

public function manage_staff(Request $request, $id = "")
{
    if ($id > 0) {
        $result['user'] = User::find($id);
    } else {
        $result['user'] = '';
    }

    return view('admin.register_staffs.manage_staffs', $result);
}

public function deletestaff($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    $message = 'User delete successfully!';
       return redirect('admin/registerstaff')->with('delete', $message );
}

public function storestaff(Request $request)
{

// return $request->all();
$validator = Validator::make($request->all(), [
    'name' => 'required',
    'address' => 'required',
    'email' => 'required',
    'phone' => 'required',
    'quotestatus' => 'required',
]);

if ($validator->fails()) {
    return response()->json([
        'success' => false,
        'message' => $validator->errors()->first(),
    ]);
}

$id = $request->input('id');

if ($id > 0) {
    $user = User::find($id);
    $message = 'User updated successfully!';
} else {
    $user = new User;
    $message = 'User created successfully!';
}

$user->name = $request->input('name');
$user->password = hash::make($request->input('password'));
$user->address = $request->input('address');
$user->email = $request->input('email');
$user->phone = $request->input('phone');
$user->user_type = $request->input('user_type');
$user->quotestatus = $request->input('quotestatus');
$user->save();

return response()->json([
    'success' => true,
    'message' => $message,
]);
}

}

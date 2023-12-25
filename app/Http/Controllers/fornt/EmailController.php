<?php

namespace App\Http\Controllers\fornt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Femail;

class EmailController extends Controller
{
    
    public function manage_process(Request $request)
    {

        $id = $request->input('id');

        if ($id > 0) {
            $Email = Femail::find($id);
            $message = 'Inlets updated successfully!';
        } else {
            $Email = new Femail;
            $message = 'Inlets created successfully!';
        }

        $Email->email = $request->post('email');
        $Email->save();

        $message = $Email->wasRecentlyCreated ? "Email Add Successfully!" : "Email Add Successfully!";

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
    }

}

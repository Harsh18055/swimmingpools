<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use DataTables;

class BlogController extends Controller
{
     public function list()
    {
        return view('admin.blog.list');
    }

    public function getdatatable(Request $request)
    {

        $About = Blog::select('*');
        
        $dataTable = Datatables::of($About)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($data) {
                       $html = '<a href="' . route('admin.blog.edit', [$data->id]) . '" type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit foam">
                                    <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                <a href="' . route('admin.blog.delete', [$data->id]) . '" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Category" onclick="return confirm(\'Are you sure you want to delete this item?\');">
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

    //Edit And Add:
    public function manage_blog(Request $request, $id = "")
    {
        if ($id > 0) {
            $About = Blog::find($id);
            $result['image'] = $About->image;
            $result['heading'] = $About->heading;
            $result['text'] = $About->text;
            $result['id'] = $About->id;
        } else {
            $result['image'] = '';
            $result['heading'] = '';
            $result['text'] = '';
            $result['id'] = '';
        }
        return view('admin.blog.manage_blog', $result);
    }

     public function manage_process(Request $request)
{
    $validator = Validator::make($request->all(), [
      
        'heading' => 'required',
        'text' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    $message = "";
    $about = ($request->post('id') > 0) ? Blog::find($request->post('id')) : new Blog;

    // Function to handle file upload and deletion
    $uploadAndDelete = function ($fileInput, $uploadPath, $folder) use ($about, $request) {
        if ($request->hasfile($fileInput)) {
            $oldProfile = $folder . '/' . $about->{$fileInput};

            if ($about->id && file_exists($oldProfile)) {
                File::delete($oldProfile);
            }

            $file = $request->file($fileInput);
            $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $name);

            $about->{$fileInput} = $name;
        }
    };

    // Upload and delete for each image
    $uploadAndDelete('image', 'admin/assets/media/blog', 'admin/assets/media/blog');

    $about->heading = $request->post('heading');
    $about->text = $request->post('text');
    $about->save();

    $message = $about->wasRecentlyCreated ? "New Blog Uploaded!" : "Blog Updated!";

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
}


    //Delete
    public function delete($id)
    {
        $Filter = Blog::findOrFail($id);
        $Filter->delete();
        $message = 'About Us delete successfully!';
        return redirect('admin/blog')->with('delete', $message );
    }

    //CK Editor:
    public function uploader(Request $request)
    {
            if ($request->hasFile('upload')) {
                $file=$request->file("upload");
                $fileName=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $img=\Image::make($file);
                $filePath = public_path('admin/assets/media/blogs/' . $fileName);
                $img->save($filePath, 30);
        
                $url = asset('admin/assets/media/blogs/' . $fileName);
                return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
            }
            
        }
}

<?php

namespace App\Http\Controllers\fornt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Slider;
use App\Models\Footer;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Category;
use App\Models\Cimage;
use App\Models\Footers;
use App\Models\Setting;
use App\Models\Sacrificialpools;
use App\Models\WaterVolume;
use App\Models\Filter;
use App\Models\Pump;
use App\Models\Light;
use App\Models\Inlets;
use App\Models\Maindrain;
use App\Models\Vaccum;
use App\Models\Heaterpump;
use App\Models\Ozone;


class SliderController extends Controller
{

     public function view()
    {
        $result['about'] = About::all();
        $result['slider'] = Slider::all();
        $result['footer'] = Footer::all();
        $result['blog'] = Blog::all();
        $result['testimonial'] = Testimonial::all();
         $result['cimage'] = Cimage::join('category' , 'cimage.c_id' , '=' , 'category.id')
        ->select('cimage.*','category.c_name as category_name')
        ->get();
        $result['data'] = Footers::all();
        $result['setting'] = Setting::all();
        return view('fornt/home', $result);
    }

    public function index($id)
    {
         $result['footer'] = Footer::all();
         $result['data'] = Footers::all();
         $result['setting'] = Setting::all();
        $blog = Blog::find($id);
        return view('fornt/blog_details' , $result , ['blog' => $blog]);
    }
    
    public function about($id)
    {
        $result['footer'] = Footer::all();
         $result['data'] = Footers::all();
         $result['setting'] = Setting::all();
        $about = Slider::find($id);
        return view('fornt/about_details' , $result , ['about' => $about] );
    }

    public function quotation()
    {
        $result['setting'] = Setting::all();
        $result['footer'] = Footer::all();
        $result['data'] = Footers::all();
        $result['filter']=Filter::all();
        $result['watervolume']=WaterVolume::all();
        $result['pump']=Pump::all();
        $result['light']=Light::all();
        $result['inlets']=Inlets::all();
        $result['maindrain']=Maindrain::all();
        $result['vaccum']=Vaccum::all();
        $result['heaterpump']=Heaterpump::all();
        $result['ozone']=Ozone::all();
        return view('fornt/quotation' , $result);
    }

    public function getFilteredData($id)
    {
        $filteredData = Filter::where('watervolume_id', $id)->get();
        return response()->json($filteredData);
    }
    
    public function getPumpData($id)
    {
        $pumpData = Pump::where('watervolume_id', $id)->get();
        return response()->json($pumpData);
    }
    public function getLightData($id)
    {
        $lightData = Light::where('watervolume_id', $id)->get();
        return response()->json($lightData);
    }

    public function getInletData($id)
    {
        $inletData = Inlets::where('watervolume_id', $id)->get();
        return response()->json($inletData);
    }

    public function getMainDrainData($id)
    {
        $mainDrainData = Maindrain::where('watervolume_id', $id)->get();
        return response()->json($mainDrainData);
    }

    public function getVacuumData($id)
    {
        $vacuumData = Vaccum::where('watervolume_id', $id)->get();
        return response()->json($vacuumData);
    }

    public function getHeaterPumpData($id)
    {
        $heaterPumpData = Heaterpump::where('watervolume_id', $id)->get();
        return response()->json($heaterPumpData);
    }

    public function getOzoneData($id)
    {
        $ozoneData = Ozone::where('watervolume_id', $id)->get();
        return response()->json($ozoneData);
    }
   
    public function calculateTotalPrice(Request $request)
    {
        // Assuming your request contains selected options for each dropdown
        $selectedOptions = $request->all();

        $totalPrice = 0;

        // Loop through selected options and calculate the total price
        foreach ($selectedOptions as $dropdownName => $selectedOption) {
            $totalPrice += YourModel::find($selectedOption)->price;
        }

        return response()->json(['totalPrice' => $totalPrice]);
    }
}


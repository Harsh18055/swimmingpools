<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\SacrificialpoolController;
use App\Http\Controllers\admin\WaterVolumeController;
use App\Http\Controllers\admin\FilterController;
use App\Http\Controllers\admin\PumpController;
use App\Http\Controllers\admin\LightController;
use App\Http\Controllers\admin\InletsController;
use App\Http\Controllers\admin\MaindrainController;
use App\Http\Controllers\admin\VaccumController;
use App\Http\Controllers\admin\HeaterpumpController;
use App\Http\Controllers\admin\OzoneController;
use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ImgesController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\FooterController;
use App\Http\Controllers\admin\FollwasController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\EmailController;

Route::group(['middleware' => ['admin'], 'as' => 'admin.'], function () {

    Route::get('/login', [AdminController::class,'index']);
    Route::get('/create', [AdminController::class,'create']);
    Route::post('/auth', [AdminController::class,'auth'])->name('auth');

    Route::group(['middleware' => 'admin_auth'], function () {
        Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');

        //user
        Route::get('/registeruser', [AdminController::class,'list'])->name('user.list');
        Route::get('/registeruser/getdatatable', [AdminController::class,'getdatatable'])->name('user.getdatatable');
        Route::get('/registeruser/add', [AdminController::class,'manage_user'])->name('user.manage_user');
        Route::get('/registeruser/edit/{id}', [AdminController::class,'manage_user'])->name('user.user_edit');
        Route::get('/registeruser/delete/{id}', [AdminController::class,'delete'])->name('user.delete');
        Route::post('/registeruser', [AdminController::class,'store'])->name('user.user_store');

        //manager
        Route::get('/registermanager', [AdminController::class,'listmanager'])->name('manager.list');
        Route::get('/registermanager/getdatatablemanager', [AdminController::class,'getdatatablemanager'])->name('manager.getdatatablemanager');
        Route::get('/registermanager/add', [AdminController::class,'manage_manager'])->name('manager.manage_manager');
        Route::get('/registermanager/edit/{id}', [AdminController::class,'manage_manager'])->name('manager.manager_edit');
        Route::get('/registermanager/delete/{id}', [AdminController::class,'deletemanager'])->name('manager.delete');
        Route::post('/registermanager', [AdminController::class,'storelistmanager'])->name('manager.manager_store');

        //staffs
        Route::get('/registerstaff', [AdminController::class,'liststaff'])->name('staff.list');
        Route::get('/registerstaff/getdatatablestaff', [AdminController::class,'getdatatablestaff'])->name('staff.getdatatablestaff');
        Route::get('/registerstaff/add', [AdminController::class,'manage_staff'])->name('staff.manage_staff');
        Route::get('/registerstaff/edit/{id}', [AdminController::class,'manage_staff'])->name('staff.staff_edit');
        Route::get('/registerstaff/delete/{id}', [AdminController::class,'deletestaff'])->name('staff.delete');
        Route::post('/registerstaff', [AdminController::class,'storestaff'])->name('staff.staff_store');

        //Sacrificialpool
        Route::get('/sacrificialpool', [SacrificialpoolController::class,'list'])->name('sacrificialpool.list');
        Route::get('/getdatatable', [SacrificialpoolController::class,'getdatatable'])->name('sacrificialpool.getdatatable');
        Route::get('/sacrificialpool/add', [SacrificialpoolController::class,'manage_sacrificial'])->name('sacrificialpool.manage_sacrificialpool');
        Route::get('/sacrificialpool/edit/{id}', [SacrificialpoolController::class,'manage_sacrificial'])->name('sacrificialpool.edit');
        Route::get('/sacrificialpool/delete/{id}', [SacrificialpoolController::class,'delete'])->name('sacrificialpool.delete');
        Route::post('/sacrificialpool', [SacrificialpoolController::class,'store'])->name('sacrificialpool.store');

        //water_volume
        Route::get('/watervolume', [WaterVolumeController::class,'list'])->name('watervolume.list');
        Route::get('/watervolume/getdatatable', [WaterVolumeController::class,'getdatatable'])->name('watervolume.getdatatable');
        Route::get('/watervolume/add', [WaterVolumeController::class,'manage_watervolume'])->name('watervolume.add');
        Route::get('/watervolume/edit/{id}', [WaterVolumeController::class,'manage_watervolume'])->name('watervolume.edit');
        Route::get('/watervolume/delete/{id}', [WaterVolumeController::class,'delete'])->name('watervolume.delete');
        Route::post('/watervolume', [WaterVolumeController::class,'store'])->name('watervolume.store');

        //filter
        Route::get('/filter', [FilterController::class,'list'])->name('filter.list');
        Route::get('/filter/getdatatable', [FilterController::class,'getdatatable'])->name('filter.getdatatable');
        Route::get('/filter/add', [FilterController::class,'manage_filter'])->name('filter.add');
        Route::get('/filter/edit/{id}', [FilterController::class,'manage_filter'])->name('filter.edit');
        Route::get('/filter/delete/{id}', [FilterController::class,'delete'])->name('filter.delete');
        Route::post('/filter', [FilterController::class,'store'])->name('filter.store');

        //pump
        Route::get('/pump', [PumpController::class,'list'])->name('pump.list');
        Route::get('/pump/getdatatable', [PumpController::class,'getdatatable'])->name('pump.getdatatable');
        Route::get('/pump/add', [PumpController::class,'manage_pump'])->name('pump.add');
        Route::get('/pump/edit/{id}', [PumpController::class,'manage_pump'])->name('pump.edit');
        Route::get('/pump/delete/{id}', [PumpController::class,'delete'])->name('pump.delete');
        Route::post('/pump', [PumpController::class,'store'])->name('pump.store');

        //Light
        Route::get('/light', [LightController::class,'list'])->name('light.list');
        Route::get('/light/getdatatable', [LightController::class,'getdatatable'])->name('light.getdata');
        Route::get('/light/add', [LightController::class,'manage_light'])->name('light.add');
        Route::get('/light/edit/{id}', [LightController::class,'manage_light'])->name('light.edit');
        Route::get('/light/delete/{id}', [LightController::class,'delete'])->name('light.delete');
        Route::post('/light', [LightController::class,'store'])->name('light.store');

        //Inlets
        Route::get('/inlets', [InletsController::class,'list'])->name('inlets.list');
        Route::get('/inlets/getdatatable', [InletsController::class,'getdatatable'])->name('inlets.getdatatable');
        Route::get('/inlets/add', [InletsController::class,'manage_inlet'])->name('inlets.add');
        Route::get('/inlets/edit/{id}', [InletsController::class,'manage_inlet'])->name('inlets.edit');
        Route::get('/inlets/delete/{id}', [InletsController::class,'delete'])->name('inlets.delete');
        Route::post('/inlets', [InletsController::class,'store'])->name('inlets.store');

        //Maindrain
        Route::get('/maindrain', [MaindrainController::class,'list'])->name('maindrain.list');
        Route::get('/maindrain/getdatatable', [MaindrainController::class,'getdatatable'])->name('maindrain.getdatatable');
        Route::get('/maindrain/add', [MaindrainController::class,'manage_maindrain'])->name('maindrain.add');
        Route::get('/maindrain/edit/{id}', [MaindrainController::class,'manage_maindrain'])->name('maindrain.edit');
        Route::get('/maindrain/delete/{id}', [MaindrainController::class,'delete'])->name('maindrain.delete');
        Route::post('/maindrain', [MaindrainController::class,'store'])->name('maindrain.store');

        //Vaccum
        Route::get('/vaccum', [VaccumController::class,'list'])->name('vaccum.list');
        Route::get('/vaccum/getdatatable', [VaccumController::class,'getdatatable'])->name('vaccum.getdatatable');
        Route::get('/vaccum/add', [VaccumController::class,'manage_vaccum'])->name('vaccum.add');
        Route::get('/vaccum/edit/{id}', [VaccumController::class,'manage_vaccum'])->name('vaccum.edit');
        Route::get('/vaccum/delete/{id}', [VaccumController::class,'delete'])->name('vaccum.delete');
        Route::post('/vaccum', [VaccumController::class,'store'])->name('vaccum.store');

        //Heaterpump
        Route::get('/heaterpump', [HeaterpumpController::class,'list'])->name('heaterpump.list');
        Route::get('/heaterpump/getdatatable', [HeaterpumpController::class,'getdatatable'])->name('heaterpump.getdatatable');
        Route::get('/heaterpump/add', [HeaterpumpController::class,'manage_heaterpump'])->name('heaterpump.add');
        Route::get('/heaterpump/edit/{id}', [HeaterpumpController::class,'manage_heaterpump'])->name('heaterpump.edit');
        Route::get('/heaterpump/delete/{id}', [HeaterpumpController::class,'delete'])->name('heaterpump.delete');
        Route::post('/heaterpump', [HeaterpumpController::class,'store'])->name('heaterpump.store');

        //Ozone
        Route::get('/ozone', [OzoneController::class,'list'])->name('ozone.list');
        Route::get('/ozone/getdatatable', [OzoneController::class,'getdatatable'])->name('ozone.getdatatable');
        Route::get('/ozone/add', [OzoneController::class,'manage_ozone'])->name('ozone.add');
        Route::get('/ozone/edit/{id}', [OzoneController::class,'manage_ozone'])->name('ozone.edit');
        Route::get('/ozone/delete/{id}', [OzoneController::class,'delete'])->name('ozone.delete');
        Route::post('/ozone', [OzoneController::class,'store'])->name('ozone.store');

        //Slider
        Route::get('/slider',[AboutController::class,'list'])->name('slider.list');
        Route::get('/slider/getdatatable', [AboutController::class,'getdatatable'])->name('slider.getdatatable');
        Route::get('/slider/add', [AboutController::class,'manage_about'])->name('slider.add');
        Route::get('/slider/edit/{id}', [AboutController::class,'manage_about'])->name('slider.edit');
        Route::get('/slider/delete/{id}', [AboutController::class,'delete'])->name('slider.delete');
        Route::post('/slider', [AboutController::class,'manage_process'])->name('slider.manage_process');

        //About2
        Route::get('/about',[SliderController::class,'list'])->name('about.list');
        Route::get('/about/getdatatable', [SliderController::class,'getdatatable'])->name('about.getdatatable');
        Route::get('/about/add', [SliderController::class,'manage_about'])->name('about.add');
        Route::get('/about/edit/{id}', [SliderController::class,'manage_about'])->name('about.edit');
        Route::get('/about/delete/{id}', [SliderController::class,'delete'])->name('about.delete');
        Route::post('/about', [SliderController::class,'manage_process'])->name('about.manage_process');

        //Category
        Route::get('/category',[CategoryController::class,'list'])->name('category.list');
        Route::get('/category/getdatatable', [CategoryController::class,'getdatatable'])->name('category.getdatatable');
        Route::get('/category/add', [CategoryController::class,'manage_about'])->name('category.add');
        Route::get('/category/edit/{id}', [CategoryController::class,'manage_about'])->name('category.edit');
        Route::get('/category/delete/{id}', [CategoryController::class,'delete'])->name('category.delete');
        Route::post('/category', [CategoryController::class,'manage_process'])->name('category.manage_process');
        Route::get('/category/delete/image/{id}',[CategoryController::class,'delete_category_image'])->name('category.image.delete');





        //Category Images
        Route::get('/categoryimages',[ImgesController::class,'list'])->name('categoryimages.list');
        Route::get('/categoryimages/getdatatable', [ImgesController::class,'getdatatable'])->name('categoryimages.getdatatable');
        Route::get('/categoryimages/add', [ImgesController::class,'manage_images'])->name('categoryimages.add');
        Route::get('/categoryimages/edit/{id}', [ImgesController::class,'manage_images'])->name('categoryimages.edit');
        Route::get('/categoryimages/delete/{id}', [ImgesController::class,'delete'])->name('categoryimages.delete');
        Route::post('/categoryimages', [ImgesController::class,'manage_process'])->name('categoryimages.manage_process');

        //Blog
        Route::get('/blog',[BlogController::class,'list'])->name('blog.list');
        Route::get('/blog/getdatatable', [BlogController::class,'getdatatable'])->name('blog.getdatatable');
        Route::get('/blog/add', [BlogController::class,'manage_blog'])->name('blog.add');
        Route::get('/blog/edit/{id}', [BlogController::class,'manage_blog'])->name('blog.edit');
        Route::get('/blog/delete/{id}', [BlogController::class,'delete'])->name('blog.delete');
        Route::post('/blog', [BlogController::class,'manage_process'])->name('blog.manage_process');

        //testimonial
        Route::get('/testimonial',[TestimonialController::class,'list'])->name('testimonial.list');
        Route::get('/testimonial/getdatatable', [TestimonialController::class,'getdatatable'])->name('testimonial.getdatatable');
        Route::get('/testimonial/add', [TestimonialController::class,'manage_testimonial'])->name('testimonial.add');
        Route::get('/testimonial/edit/{id}', [TestimonialController::class,'manage_testimonial'])->name('testimonial.edit');
        Route::get('/testimonial/delete/{id}', [TestimonialController::class,'delete'])->name('testimonial.delete');
        Route::post('/testimonial', [TestimonialController::class,'manage_process'])->name('testimonial.manage_process');

        //Footer
        Route::get('/footer',[FooterController::class,'list'])->name('footer.list');
        Route::get('/footer/getdatatable', [FooterController::class,'getdatatable'])->name('footer.getdatatable');
        Route::get('/footer/add', [FooterController::class,'manage_footer'])->name('footer.add');
        Route::get('/footer/edit/{id}', [FooterController::class,'manage_footer'])->name('footer.edit');
        Route::get('/footer/delete/{id}', [FooterController::class,'delete'])->name('footer.delete');
        Route::post('/footer', [FooterController::class,'manage_process'])->name('footer.manage_process');

        //Fllow Us:
        Route::get('/followas',[FollwasController::class,'list'])->name('followas.list');
        Route::get('/followas/getdatatable', [FollwasController::class,'getdatatable'])->name('followas.getdatatable');
        Route::get('/followas/add', [FollwasController::class,'manage_followas'])->name('followas.add');
        Route::get('/followas/edit/{id}', [FollwasController::class,'manage_followas'])->name('followas.edit');
        Route::get('/followas/delete/{id}', [FollwasController::class,'delete'])->name('followas.delete');
        Route::post('/followas', [FollwasController::class,'manage_process'])->name('followas.manage_process');

        //CK Editor:
        Route::post('admin/uploader/',[BlogController::class,'uploader'])->name('ckeditor.upload');

        //Setting:-
         Route::get('/setting',[SettingController::class,'list'])->name('setting.list');
        Route::get('/setting/getdatatable', [SettingController::class,'getdatatable'])->name('setting.getdatatable');
        Route::get('/setting/add', [SettingController::class,'manage_setting'])->name('setting.add');
        Route::get('/setting/edit/{id}', [SettingController::class,'manage_setting'])->name('setting.edit');
        Route::get('/setting/delete/{id}', [SettingController::class,'delete'])->name('setting.delete');
        Route::post('/setting', [SettingController::class,'manage_process'])->name('setting.manage_process');

        //Email:-
        Route::get('/email',[EmailController::class,'list'])->name('email.list');
        Route::get('/email/getdatatable', [EmailController::class,'getdatatable'])->name('email.getdatatable');
     
    });
});

Route::get('/logout', function () {
    session()->forget('ADMIN_LOGIN');
    session()->flash('error', 'Logout sucessfully');
    return redirect('/admin/login');
})->name('logout');

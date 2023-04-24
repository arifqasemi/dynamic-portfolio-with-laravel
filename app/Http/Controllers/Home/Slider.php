<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Image;

class Slider extends Controller
{
    //
    public function HomeFrontend(){
        return view('frontend.index');
    }// end mehtod

    public function HomeSliderMethod(){
        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all',compact('homeslide'));
        }


    public function UpdateSlider(Request $request){

        $slide_id = $request->id;

        if ($request->file('home_slide')) {
            $image = $request->file('home_slide');
            // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalName();  // 3434343443.jpg
            $filename = $image->getClientOriginalName();

            // Image::make($image)->resize(636,852)->save('upload/home_slide/'.$name_gen);
            $save_url = 'upload/home_slide/'.$filename;

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $save_url,

            ]); 
            // $filename = $image->getClientOriginalName();

            $image->move(public_path('upload/home_slide'),$save_url);

            $notification = array(
            'message' => 'Home Slide Updated with Image Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } else{

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,  

            ]); 
            $notification = array(
            'message' => 'Home Slide Updated without Image Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } // end Else

        } // End Method 
}

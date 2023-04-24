<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\about;
use App\Models\multImage;
use Illuminate\Support\Carbon;

use Image;

class aboutController extends Controller
{
    //

    protected $guarded = [];




    public function aboutPage(){
        $aboutpage = About::find(1);
        return view('admin.about_page.about_page_all',compact('aboutpage'));  
      }


      public function updateAbout(Request $request){
        
        $about_id = $request->id;

        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg
            $filename = $image->getClientOriginalName();

            // Image::make($image)->resize(523,605)->save('upload/home_about/'.$name_gen);
            $save_url = 'upload/home_about/'.$filename;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,

            ]); 
            $image->move(public_path('upload/home_about'),$save_url);

            $notification = array(
            'message' => 'About Page Updated with Image Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } else{

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,

            ]); 
            $notification = array(
            'message' => 'About Page Updated without Image Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } // end Else
      }


      public function about(){
        $aboutpage = About::find(1);
        return view('frontend.about_page',compact('aboutpage'));  
          }




          public function AboutMultiImage(){

            return view('admin.about_page.multimage');
    
    
         }// End Method 



         public function StoreMultiImage(Request $request){

            $image = $request->file('multi_image');
    
            foreach ($image as $multi_image) {
                $filename = $multi_image->getClientOriginalName();

            //    $name_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();  // 3434343443.jpg
    
                // Image::make($multi_image)->resize(220,220)->save('upload/multi/'.$name_gen);
                $save_url = 'upload/multi/'.$filename;
    
                multImage::insert([
    
                    'multi_image' => $save_url,
                    'created_at' => Carbon::now()
    
                ]); 
                $multi_image->move(public_path('upload/multi'),$save_url);

                 } // End of the froeach

    
                $notification = array(
                'message' => 'Multi Image Inserted Successfully', 
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
    
    
         }// End Method 




         public function AllMultiImage(){

            $allMultiImage = multImage::all();
            return view('admin.about_page.all_multiimage',compact('allMultiImage'));
    
         }// End Method 


         
     public function EditMultiImage($id){

        $multiImage = multImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image',compact('multiImage'));

     }// End Method 




     public function UpdateMultiImage(Request $request){

        $multi_image_id = $request->id;

     if ($request->file('multi_image')) {
         $image = $request->file('multi_image');
         $filename = $image->getClientOriginalName();

        //  Image::make($image)->resize(220,220)->save('upload/multi/'.$name_gen);
         $save_url = 'upload/multi/'.$filename;

         multImage::findOrFail($multi_image_id)->update([

             'multi_image' => $save_url,

         ]); 
         $image->move(public_path('upload/multi'),$save_url);

         $notification = array(
         'message' => 'Multi Image Updated Successfully', 
         'alert-type' => 'success'
     );

     return redirect()->route('about.allmultiImage')->with($notification);

     }

  }// End Method 




  public function DeleteMultiImage($id){

    $multi = multImage::findOrFail($id);
    $img = $multi->multi_image;
    unlink($img);

    multImage::findOrFail($id)->delete();

     $notification = array(
        'message' => 'Multi Image Deleted Successfully', 
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);



 }// End Method 
}

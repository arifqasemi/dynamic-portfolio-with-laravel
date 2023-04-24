<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\portfolio;
use Illuminate\Support\Carbon;

class portfolioController extends Controller
{
    //


    public function AllPortfolio(){

        $portfolio = portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all',compact('portfolio'));
    } // End Method



    public function AddPortfolio(){
        return view('admin.portfolio.portfolio_add');
    } // End Method


    public function StorePortfolio(Request $request){

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',

        ]
        // ,[

        //     'portfolio_name.required' => 'Portfolio Name is Required',
        //     'portfolio_title.required' => 'Portfolio Titile is Required',
        // ]
    );

        $image = $request->file('portfolio_image');
            // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg
            $filename = $image->getClientOriginalName();

            // Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_gen);
            $save_url = 'upload/portfolio/'.$filename;

            portfolio::insert([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,
                'created_at' => Carbon::now(),

            ]); 
            $image->move(public_path('upload/portfolio'),$save_url);

            $notification = array(
            'message' => 'Portfolio Inserted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolio')->with($notification);

    }// End Method




    public function EditPortfolio($id){

        $portfolio = portfolio::findOrFail($id);
        return view('admin.portfolio.portfolio_edit',compact('portfolio'));
    }// End Method


    public function UpdatePortfolio(Request $request){

        $portfolio_id = $request->id;

        if ($request->file('portfolio_image')) {
            $image = $request->file('portfolio_image');
            // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg
            $filename = $image->getClientOriginalName();

            // Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_gen);
            $save_url = 'upload/portfolio/'.$filename;

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,

            ]); 
            $image->move(public_path('upload/portfolio'),$save_url);

            $notification = array(
            'message' => 'Portfolio Updated with Image Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolio')->with($notification);

        } else{

            portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,


            ]); 
            $notification = array(
            'message' => 'Portfolio Updated without Image Successfully', 
            'alert-type' => 'success'
        );

       return redirect()->route('all.portfolio')->with($notification);

        } // end Else

     } // End Method 



     
     public function DeletePortfolio($id){

        $portfolio = portfolio::findOrFail($id);
        $img = $portfolio->portfolio_image;
        unlink($img);

        portfolio::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Portfolio Image Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);       

     }// End Method 



     public function PortfolioDetails($id){

        $portfolio = portfolio::findOrFail($id);
        return view('frontend.portfolio_details',compact('portfolio'));
     }// End Method 



     
     public function HomePortfolio(){

        $portfolio = Portfolio::latest()->get();
        return view('frontend.portfolio_page',compact('portfolio'));
       } // End Method 

     
}

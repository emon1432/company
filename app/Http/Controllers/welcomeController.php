<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class welcomeController extends Controller
{
    //

    public function homeSlider(){
        $sliders = HomeSlider::latest()->paginate(3);
        return view('admin.homeSlider.sliderList',compact('sliders'));

    }

    public function addSlider(Request $request){
        $validated = $request->validate(
            [
                'slider_title' => 'required',
                'slider_description' => 'required',
                'slider_image' => 'required',
                'slider_image.*' => 'mimes:jpeg,jpg,png',
            ],
            [
                'slider_title.required' => 'Please Enter a Title',
            ]
        );
        $slider_image = $request->file('slider_image');
        $name_gen = hexdec(uniqid());
        $image_ext = strtolower($slider_image->getClientOriginalExtension());
        $image_name = $name_gen . '.' . $image_ext;
        $location = 'images/slider/';
        $final_image_name = $location . $image_name;
        $slider_image->move($location, $image_name);

        HomeSlider::insert([
            'title' => $request->slider_title,
            'description' => $request->slider_description,
            'image' => $final_image_name,
            'created_at' => Carbon::now()
        ]);


        return Redirect()->back()->with('success', 'Slider Inserted Successfully');
    }


    public function editSlider($id)
    {
        $sliders = HomeSlider::find($id);
        return view('admin.homeSlider.editSlider', compact('sliders'));
    }

    public function updateSlider(Request $request,$id){
        $validated = $request->validate(
            [
                'slider_title' => 'required',
                'slider_description' => 'required',
            ],
            [
                'slider_title.required' => 'Please Enter a Title',
            ]
        );

        $slider_image = $request->file('slider_image');


        if ($slider_image) {
            $old_image = $request->old_image;
            unlink($old_image);
            $name_gen = hexdec(uniqid());
            $image_ext = strtolower($slider_image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $image_ext;
            $location = 'images/slider/';
            $final_image_name = $location . $image_name;
            $slider_image->move($location, $image_name);

            HomeSlider::find($id)->update([
                'title' => $request->slider_title,
                'description' => $request->slider_description,
                'image' => $final_image_name,
            ]);
        } else {
            HomeSlider::find($id)->update([
                'title' => $request->slider_title,
                'description' => $request->slider_description,
            ]);
        }
        return Redirect()->back()->with('success', 'Slider Updated Successfully');
    }

    public function deleteSlider($id){

        $image = HomeSlider::find($id);
        $old_image = $image->image;
        unlink($old_image);

        HomeSlider::find($id)->delete();
        return Redirect()->back()->with('success', 'Slider Deleted Successfully');

    }

}

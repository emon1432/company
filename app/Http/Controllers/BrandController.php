<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allBrand()
    {
        $brands = Brand::all();
        return view('admin.brand.brandList', compact('brands'));
    }

    public function addBrand(Request $request)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|unique:brands|max:50',
                'brand_image' => 'required',
                'brand_image.*' => 'mimes:jpeg,jpg,png',
            ],
            [
                'brand_name.required' => 'Please Enter a Brand Name',
                'brand_name.max' => 'Category less than 50 chars',
            ]
        );
        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $image_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen . '.' . $image_ext;
        $location = 'images/brand/';
        $final_image_name = $location . $image_name;
        $brand_image->move($location, $image_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $final_image_name,
            'created_at' => Carbon::now()
        ]);


        return Redirect()->back()->with('success', 'Brand Inserted Successfull');
    }

    public function editBrand($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.editBrand', compact('brands'));
    }

    public function updateBrand(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|max:50',
                'brand_image.*' => 'mimes:jpeg,jpg,png',
            ],
            [
                'brand_name.required' => 'Please Enter a Brand Name',
                'brand_name.max' => 'Category less than 50 chars',
            ]
        );

        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $old_image = $request->old_image;
            unlink($old_image);
            $name_gen = hexdec(uniqid());
            $image_ext = strtolower($brand_image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $image_ext;
            $location = 'images/brand/';
            $final_image_name = $location . $image_name;
            $brand_image->move($location, $image_name);

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $final_image_name,
            ]);
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
            ]);
        }
        return Redirect()->back()->with('success', 'Brand Updated Successfully');
    }

    public function deleteBrand($id){

        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted Successfully');

    }
}

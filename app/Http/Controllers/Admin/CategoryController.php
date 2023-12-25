<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category (){
        return view('admin.addcategory');
    }

    public function create(Request $request){

        $validator = validator::make($request->all(),[
            'Category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|unique:categories',
        ]);

        if ($validator->passes()) {

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);

            // Insert data into the database
            $category = new Category();
            $category->name = $request->input('Category');
            $category->slug = $request->input('slug');
            $category->image = $imageName;
            $category->status = $request->input('status');
            $category->save();

            return response()->json([
                'status' => true,
                'message' => 'Category added successfully',
            ]);
        }else{

            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);

        }

    }


    public function categorylist(){
        return view('admin.listcategory');
    }

}

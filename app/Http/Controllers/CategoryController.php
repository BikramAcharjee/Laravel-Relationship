<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SuperCategory;
use App\Models\SubCategory;
use App\Models\ChildCategory;

class CategoryController extends Controller
{
    public function FetchSupCategory(Request $request) {
        $supCategory = SuperCategory::all();
        return view("welcome",["supCategory"=>$supCategory]);
    }

    public function CreateSuperCategory(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string',
        ]);
        $slug = strtolower(str_replace(" ","-",trim($request->name)));
        $request['image_path'] = $this->UploadImage($request->file('image'));
        $request['slug'] = $slug;
        SuperCategory::create($request->all());
        return response()->json(["message"=>"Super category Created !"],201);
    }

    public function CreateSubCategory(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string',
            "super_category" => "required"
        ]);
        $slug = strtolower(str_replace(" ","-",trim($request->name)));
        $request['image_path'] = $this->UploadImage($request->file('image'));
        $request['slug'] = $slug;
        SubCategory::create($request->all());
        return response()->json(["message"=>"Sub category created !"],201);
    }
    public function CreateItem(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string',
            "sub_category" => "required"
        ]);
        $slug = strtolower(str_replace(" ","-",trim($request->name)));
        $request['image_path'] = $this->UploadImage($request->file('image'));
        $request['slug'] = $slug;
        $childdata = ChildCategory::create($request->all());
        return response()->json(["message"=>"Products created !"],201);
    }

    public function FetchById($id) {
        $_supdata = SuperCategory::find($id);
        return response()->json(["message"=> count($_supdata->sub_category)." Data found","child"=>$_supdata->sub_category],200);
    }

    public function GetProducts() {
        $superCat = SuperCategory::with("sub_category")->get();
        for($i = 0; $i < count($superCat); $i++) {
            for($j = 0; $j < count($superCat[$i]->sub_category); $j++) {
                $superCat[$i]->sub_category[$j]["child_category"] = $superCat[$i]->sub_category[$j]->child_category;
            }
        }
        return response()->json($superCat,200);
    }

    protected function UploadImage($image) {
        $name = time().'.'.$image->getClientOriginalExtension();
        //save the image
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);
        return $destinationPath."/".$name;
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CategoryRequest;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create',compact('category','parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

//        $request->validate(Category::rules());

        $request->merge([
            'slug' =>Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);

        $category = Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('success','Category created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $category = Category::findOrfail($id);

        $parents = Category::where('id','<>',$id)
            ->where(function ($query) use ($id){
                $query->whereNull('parent_id')
                    ->orwhere('parent_id','<>',$id);

            })->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {

//        $clean_code = $request->validate(Category::rules($id),[
//            'required' => 'this field (:attribute) is required',
//            'name.unique'   => 'this name is already exists!'
//        ]);

        $category = Category::findOrfail($id);

        $old_image = $category->image;

        $data = $request->except('image');


           $new_image = $this->uploadImage($request);
           if($new_image){
               $data['image'] = $new_image;
           }

        $category->update($data);

        if ($old_image && $new_image){
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('dashboard.categories.index')->with('success','Category update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
        if ($category->image ){
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('dashboard.categories.index')->with('success','Category delete');
    }

    public function uploadImage(Request $request){
        if (!$request->hasFile('image')){
            return ;
        }
        $file =$request->file('image');
        $path = $file->store('uploads',[
            'disk' => 'public'
        ]);
        return $path;
    }

}

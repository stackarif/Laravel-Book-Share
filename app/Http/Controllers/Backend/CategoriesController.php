<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $parent_categories = Category::where('parent_id', null)->get();
        return view('backend.pages.categories.index', compact('categories','parent_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'slug' => 'nullable|unique:categories',
            'description' => 'nullable',
        ]);

        $categories= new Category();
        $categories->name = $request->name;
        if(empty($request->slug)){
            $categories->slug = Str::slug($request->name);

        }else{
            $categories->slug = $request->slug;
        }
        $categories->parent_id = $request->parent_id;
        $categories->description = $request->description;
        $categories->save();
        session()->flash('success', 'Category has been created !!');
        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categories= Category::find($id);

        $request->validate([
            'name' => 'required|max:50',
            // 'slug' => 'nullable|unique:categories,slug'.$categories->id,
            'description' => 'nullable',
        ]);

        $categories->name = $request->name;
        if(empty($request->slug)){
            $categories->slug = Str::slug($request->name);

        }else{
            $categories->slug = $request->slug;
        }
        $categories->parent_id = $request->parent_id;
        $categories->description = $request->description;
        $categories->save();
        session()->flash('success', 'Category has been created !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete all child categories
        $child_categories = Category::where('parent_id', $id)->get();
        foreach ($child_categories as $child) {
        
            $child->delete();
            
        }

        $categories= Category::find($id);
        $categories->delete();
        session()->flash('success', 'Categories has been deleted !!');

        return back();
    }
}

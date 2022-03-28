<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Materials_category;
use Illuminate\Support\Facades\DB;

class MaterialsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/Materials/Categories', [
            'categories' => Materials_category::all(),
            'categories_count' => Materials_category::get()->count(),
        ]);
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
        
        $this->validate($request, [
            'name' => ['required', 'min:3', 'unique:materials_categories'],
            'description' => ['required', 'min:8', 'max:255'],
        ]);
        
        Materials_category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materials_category  $materials_category
     * @return \Illuminate\Http\Response
     */
    public function show(Materials_category $materials_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materials_category  $materials_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Materials_category $materials_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materials_category  $materials_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materials_category $materials_category)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:8', 'max:255'],
        ]);

        $the_cat = DB::table('materials_categories')->select('*')->where('id', $request->id)->first();

        $all_mats = DB::table('materials_lists')->select('*')->where('category', $the_cat->name)->get();

        DB::table('materials_categories')->where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        foreach($all_mats as $mat){
            DB::table('materials_lists')
            ->where('name', $mat->name)
            ->update([
                'category' => $request->name,
            ]);
        }
      
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materials_category  $materials_category
     * @return \Illuminate\Http\Response
     */
    public function deleteMatCat(Request $request, Materials_category $materials_category)
    {
        DB::table('materials_categories')->where('name', $request->query('name'))->delete();

        $all_mat = DB::table('materials_lists')->where('category', $request->query('name'))->get();

        foreach($all_mat as $mat){
            
            DB::table('materials_lists')->where('name', $mat->name)->delete();
            $all_manage_mat = DB::table('materials_manages')->where('name', $mat->name)->get();

            foreach($all_manage_mat as $manage_mat){
                DB::table('materials_manages')->where('name', $manage_mat->name)->delete();
            }

        }
        return back(); 
    }
}

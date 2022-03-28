<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Material;
use App\Models\Materials_list;
use App\Models\Materials_manage;
use Illuminate\Http\Request;
use App\Models\Materials_category;
use Illuminate\Support\Facades\DB;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        return Inertia::render('User/Materials/Index', [
            'materials' => Materials_list::all(),
            'materials_count' => Materials_list::get()->count(),
            'categories' => Materials_category::all(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {       
        return Inertia::render('User/Materials/Manage', [
            'materials' => Materials_manage::all(),
            'materials_count' => Materials_manage::get()->count(),
            'materials_lists' => Materials_list::where('on_use', null)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials_lists = Materials_list::where('on_use', null)->get();
        return view('Materials.create', compact('materials_lists'));
    }
        
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addMat(Request $request)
    {
              
        $this->validate($request, [
            'material' => ['required', 'min:3',],
            'quantity' => ['required'],
        ]);
        
        Materials_manage::create([
            'name' => $request->material,
            'quantity' => $request->quantity,
        ]);

        DB::table('materials_lists')
        ->where('name', $request->material)
        ->update([
            'on_use' => '1',
        ]);

        return back();

    }
            
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateMat(Request $request)
    {
              
        $this->validate($request, [
            'material' => ['required', 'min:3',],
            'addQuantity' => ['required'],
        ]);

        $theMat = Materials_manage::where('name', $request->material)->orderByDesc('created_at')->first();
        $quantity_added = $theMat->quantity + $request->addQuantity;

        DB::table('materials_manages')
        ->where('name', $request->material)
        ->update([
            'quantity' => $quantity_added,
            'updated_at' => now(),
        ]);
 
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function dropMat(Request $request, Materials_manage $material)
    {
        DB::table('materials_manages')->where('name', $request->query('name'))->delete();

        DB::table('materials_lists')
            ->where('name', $request->query('name'))
            ->update([
                'on_use' => null,
            ]);
        return back();
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
            'name' => ['required', 'min:3', 'unique:materials_lists'],
            'category' => ['required', 'min:3',],
            'description' => ['required', 'min:8', 'max:255'],
        ]);
        
        Materials_list::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
        ]);
              
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {   
        $this->validate($request, [
            'name' => ['required', 'min:3'],
            // 'category' => ['required', 'min:3',],
            'description' => ['required', 'min:8', 'max:255'],
        ]);
        $the_mat = DB::table('materials_lists')->select('*')->where('id', $request->id)->first();
        
        DB::table('materials_lists')->where('id', $request->id)->update([
            'name' => $request->name,
            // 'category' => $request->category,
            'description' => $request->description,
        ]);
        
        DB::table('materials_manages')
        ->where('name', $the_mat->name)
        ->update([
            'name' => $request->name,
        ]);
 
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material 
     * @return \Illuminate\Http\Response
     */
    public function deleteMat(Request $request, Material $material)
    {
        
        DB::table('materials_lists')->where('name', $request->query('name'))->delete();

        $all_manage = DB::table('materials_manages')->where('name', $request->query('name'))->get();
        foreach($all_manage as $manage){
            DB::table('materials_manages')->where('name', $manage->name)->delete();
        }
        return back();
    }
}

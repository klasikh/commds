<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Request_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Request_typeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::find(1);
        // dd($user->name);
        return Inertia::render('Admin/Request_types/Index', [
            'request_types' => Request_type::get(),
            'request_types_count' => Request_type::all()->count(),
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
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $this->validate($request,[
                'title' => ['required', 'min:3', 'max:35', 'unique:request_types'],
                'description' => ['required', 'min:10', 'max:255']
            ]);
            Request_type::create([
                'title' => $request->title,
                'description' => $request->description,
                'guard_name' => 'web',
            ]);
            return back();
        }
        return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request_type  $request_type
     * @return \Illuminate\Http\Response
     */
    public function show(Request_type $request_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request_type  $request_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Request_type $request_type)
    {
        //
    }

   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Request_type  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Request_type $request_type)
    {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $this->validate($request,[
                'title' => ['required', 'max:35'],
                'description' => ['required','max:255']
            ]);
            $request_type->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return back();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request_type  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request_type $requestType)
    {
        $requestType->delete();
        return back();
    }
}

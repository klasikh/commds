<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function __construct() {
        $this->middleware(['role:super-admin|admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Department $id)
    {
        $the_dep = Department::find($id);
        // $services = Service::all();
        // $services_count = Service::all()->count();
        // $departments = Department::all();
        return Inertia::render('Admin/Services/Index', [

            'services' => Service::all(),
            'services_count' => Service::all()->count(),
            'departments' => Department::all(),
            'the_dep' => $the_dep,
        ]);
        // return view('admin.services', compact('services', 'services_count','departments', 'the_dep'));
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

            // dd($request);
            $this->validate($request,[
                'name' => ['required', 'min:3', 'max:35', 'unique:services'],
                'description' => ['required', 'min:10', 'max:255'],
                'department' => ['required'],
            ]);
            // dd($request->department['id');
            Service::create([
                'name' => $request->name,
                'description' => $request->description,
                'department' => $request->department['name'],
            ]);
            return back();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $this->validate($request,[
                'name' => ['required', 'max:25'],
                'description' => ['required','max:255'],
            ]);
            $depart = $request->department;
            if($depart){
                $service->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'department' => $request->department['name'],
                ]);
                return back();
            // } 
            // else if($depart != []){
            //     $service->update([
            //         'name' => $request->name,
            //         'description' => $request->description,
            //         'department' => $request->department,
            //     ]);
            //     return back();
            }else {
                $service->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
                return back();
            }
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return back();
    }
}

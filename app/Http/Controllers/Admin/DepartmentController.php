<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;

class DepartmentController extends Controller
{

    public function __construct() {
        $this->middleware(['role:super-admin|admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::find(1);
        // dd($user->name);
        return Inertia::render('Admin/Departments/Index', [
            'departments' => Department::orderByDesc('id')->get(),
            'departments_count' => Department::all()->count(),
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
                'name' => ['required', 'min:3', 'max:35', 'unique:departments'],
                'description' => ['required', 'min:10', 'max:255']
            ]);
            Department::create([
                'name' => $request->name,
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
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Department $department)
    {
        $depName = $department->name;
        // $department = Department::where('id', $id)->with('services')->first();
        $services = Service::where('department', $depName)->get();
        $services_count = Service::where('department', $depName)->get()->count();
        // dd($department->id);
        return Inertia::render('Admin/Departments/Show', [
            'department' => $department,
            'services' => $services,
            'services_count' => $services_count,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $this->validate($request,[
                'name' => ['required', 'max:35'],
                'description' => ['required','max:255']
            ]);
            $department->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return back();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return back();
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware(['role:super-admin|admin|moderator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::where('is_admin', 1)->orderByDesc('id')->get();
        // $role = Role::where('id',2)->first();
        // $user->syncRoles($role);

        return Inertia::render('Admin/Admins/Index', [
            'admins' => User::where('is_admin', 1)->where('is_super', null)->orderByDesc('id')->get(),
            'roles' => Role::orderByDesc('id')->limit(2)->get(),
            'admins_count' => User::where('is_admin', 1)->where('is_super', null)->orderByDesc('id')->get()->count(),
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
            $this->validate($request, [
                'name' => ['required', 'max:30'],
                'surname' => ['required', 'max:50'],
                'email' => ['required','string', 'email', 'max:55', 'unique:users'],
            ]);
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'is_admin' => 1,
                'password' => Hash::make('pass0000'),
            ]);
            $role = Role::where('id',2)->first();
            $user->syncRoles($role);
            return back();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $this->validate($request, [
                'name' => ['required', 'max:30'],
                'surname' => ['required', 'max:50'],
                'email' => ['required','string', 'email', 'max:55'],
            ]);
            if($request->roles[0] === null){
                return back()->withErrors(['roles' => 'Le champ rôle est requis']);
            }
            if($request->roles[0]['id'] != 5) {
                $adminRole = Role::where('id', $request->roles[0]['id'])->first();
                $user->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'email' => $request->email,
                    'is_admin' => 1,
                ]);
                $user->syncRoles($adminRole);
                return back();
            }else {
                $userRole = Role::where('id', 5)->first();
                $user->update(['is_admin' => 0]);
                $user->syncRoles($userRole);
                return back();
            }

            return back();

        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $user->delete();
            return back();
        }
        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Grade;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActionMarkdownMail;
use App\Mail\AccountMarkdownMail;

class UserController extends Controller
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
        return Inertia::render('Admin/Users/Index', [
            'users' => User::where('is_admin', 0)->orderByDesc('id')->get(),
            'users_count' => User::where('is_admin', 0)->orderByDesc('id')->count(),
            'services' => Service::orderByDesc('id')->get(),
            'roles' => Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Users/Create', [
            'services' => Service::all(),
            'grades' => Grade::all(),
        ]);
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
                'name' => ['required', 'min:3', 'max:50'],
                'surname' => ['required', 'min:3', 'max:50'],
                'sex' => ['required', 'min:1', 'max:1'],
                'phone_number' => ['required', 'min:8', 'max:16'],
                'email' => ['required','string', 'email', 'max:50', 'unique:users'],
                'service_id' => ['required'],
                'grade_id' => ['required'],
            ]);
            // if(!$request->grade_id){
            //     return back()->withErrors(['grade_id' => 'Le champ rôle est requis']);
            // }

            $pass = uniqid(1);
            $reqNum = '';
                
            $content = "Bonjour Mrs/Mr $request->surame " . " $request->name, un compte vient de vous être créé sur notre plateforme de digitalisation des commandes. Voici vos coordonnées: 
                Email : $request->email 
                Mot de passe : $pass ";
            $subject = "Coordonnées de votre compte";
            Mail::to($request->email)->send(new AccountMarkdownMail('super@admin.com', $request->name, $request->surname, $subject, $content));

            $service_id = $request->service_id['id'];
            $grade_id = $request->grade_id['id'];
            $takeU = User::whereRaw("(service_id = $service_id and grade_id = $grade_id) and grade_id != 6 and is_admin = 0")->get()->count();
            
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'sex' => $request->sex,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'service_id' => $request->service_id['id'],
                'grade_id' => $request->grade_id['id'],
                'password' => Hash::make($pass),
                'is_admin' => 0,
            ]);
            $role = Role::where('id',5)->first();
            $user->syncRoles($role);

            return Inertia::render('Admin/Users/Index', [
                'users' => User::where('is_admin', 0)->get(),
                'users_count' => User::where('is_admin', 0)->count(),
                'services' => Service::all(),
                'roles' => Role::all(),
            ]);

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
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
            'services' => Service::all(),
            'grades' => Grade::all(),
        ]);
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
                'name' => ['required', 'max:50'],
                'surname' => ['required', 'min:3', 'max:50'],
                'sex' => ['required', 'min:1', 'max:1'],
                'phone_number' => ['required', 'min:8', 'max:16'],
                'email' => ['required','string', 'email', 'max:50'],
                'service_id' => ['required'],
                'grade_id' => ['required'],
            ]);
            // dd($request);
            // $adminRole = Role::where('id', $request->roles[0]['id'])->first();
            if($request->service_id == [] && $request->grade_id != []){
                $user->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'sex' => $request->sex,
                    'phone_number' => $request->phone_number,
                    'email' => $request->email,
                    'service_id' => $request->service_id['id'],
                    'grade_id' => $request->grade_id,
                ]);
                // $user->syncRoles($adminRole);
                return Inertia::render('Admin/Users/Index', [
                    'users' => User::where('is_admin', 0)->orderByDesc('created_at')->get(),
                    'users_count' => User::where('is_admin', 0)->count(),
                    'services' => Service::all(),
                    'grades' => Grade::all(),
                    'roles' => Role::all(),
                ]);
            }else if($request->service_id != [] && $request->grade_id == []){
                $user->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'sex' => $request->sex,
                    'phone_number' => $request->phone_number,
                    'email' => $request->email,
                    'service_id' => $request->service_id,
                    'grade_id' => $request->grade_id['id'],
                ]);
                // $user->syncRoles($adminRole);
                return Inertia::render('Admin/Users/Index', [
                    'users' => User::where('is_admin', 0)->orderByDesc('created_at')->get(),
                    'users_count' => User::where('is_admin', 0)->count(),
                    'services' => Service::all(),
                    'grades' => Grade::all(),
                    'roles' => Role::all(),
                ]);
            }else if($request->service_id == [] && $request->grade_id == []){
                $user->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'sex' => $request->sex,
                    'phone_number' => $request->phone_number,
                    'email' => $request->email,
                    'service_id' => $request->service_id['id'],
                    'grade_id' => $request->grade_id['id'],
                ]);
                // $user->syncRoles($adminRole);
                return Inertia::render('Admin/Users/Index', [
                    'users' => User::where('is_admin', 0)->orderByDesc('created_at')->get(),
                    'users_count' => User::where('is_admin', 0)->count(),
                    'services' => Service::all(),
                    'grades' => Grade::all(),
                    'roles' => Role::all(),
                ]);
            }else if($request->service_id != [] && $request->grade_id != []){
                $user->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'sex' => $request->sex,
                    'phone_number' => $request->phone_number,
                    'email' => $request->email,
                    'service_id' => $request->service_id,
                    'grade_id' => $request->grade_id,
                ]);
                // $user->syncRoles($adminRole);
                return Inertia::render('Admin/Users/Index', [
                    'users' => User::where('is_admin', 0)->orderByDesc('created_at')->get(),
                    'users_count' => User::where('is_admin', 0)->count(),
                    'services' => Service::all(),
                    'grades' => Grade::all(),
                    'roles' => Role::all(),
                ]);
            }
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

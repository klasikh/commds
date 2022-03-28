<?php

namespace App\Http\Controllers\User;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Request as RequestData;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasAnyRole(['user'])) {

            $user = auth()->user();
            $user_service = auth()->user()->service_id;

            if($user->grade_id === 5 || $user->grade_id === 4 || $user->grade_id === 3){
                if($user->grade_id === 5){
                    $received = RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('token', '!=', null)
                                                ->get()->count();
                    $traited = RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count();
                }
                if($user->grade_id === 4){
                    $received = RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count();
                    $traited = RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count();
                }
                if($user->grade_id === 3){
                    $received = RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count();
                    $traited = RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count();
                }
                if($user->grade_id === 2){
                    $received = RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('estimated_amount', '<', 70000000)
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count();
                    $traited = RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('estimated_amount', '<', 70000000)
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count();
                }
                if($user->grade_id === 7){
                    $received = RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count();
                    $traited = RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('wh_chief_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count();
                }


                return Inertia::render('User/Dashboard', [
                    'notSent' => RequestData::whereBelongsTo($user)
                                        ->where('status', '0')
                                        ->where('sent_or', '0')
                                        ->where('token', 'null')
                                        ->get()->count(),

                    'sent' => RequestData::whereBelongsTo($user)
                                                ->whereRaw("status = 1 or status = 2 or status = 3 or status = 4 or status = 5 or status = 6 or status = 7 or status = 8")
                                                ->where('sent_or', '1')
                                                ->where('token', '!=', 'null')
                                                ->get()->count(),

                    'finalized' => RequestData::whereBelongsTo($user)
                                                ->where('status', '9')
                                                ->where('token', '!=', 'null')
                                                ->where('sent_or', '1')
                                                ->get()->count(),
                    'received' => $received,
                    'traited' => $traited,
                    
                    ]);
                }
            }
                
                $user = auth()->user();
                $user_service = auth()->user()->service_id;

                return Inertia::render('User/Dashboard', [
                    'notSent' => RequestData::whereBelongsTo($user)
                                        ->where('status', '0')
                                        ->where('sent_or', '0')
                                        ->where('token', null)
                                        ->get()->count(),

                    'sent' => RequestData::whereBelongsTo($user)
                                                ->whereRaw("status = 1 or status = 2 or status = 3 or status = 4 or status = 5 or status = 6 or status = 7 or status = 8")
                                                ->where('sent_or', '1')
                                                ->where('token', '!=', null)
                                                ->get()->count(),

                    'finalized' => RequestData::whereBelongsTo($user)
                                                ->where('status', '9')
                                                ->where('token', '!=', null)
                                                ->where('sent_or', '1')
                                                ->get()->count(),
                    
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\ActionbackMarkdownMail;
use App\Mail\ActionMarkdownMail;
use App\Mail\BackPointMarkdownMail;
use PDO;
use DateTime;
use DateInterval;
use PDOException;
use App\Models\Memo;
use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use App\Mail\TestMail;
use App\Models\Message;
use App\Models\Service;
use Barryvdh\DomPDF\PDF;
use App\Models\signature;
use Illuminate\Support\Str;
use App\Mail\CmMarkdownMail;
use App\Models\Request_type;
use Illuminate\Http\Request;
use App\Models\Mat_transfert;
use App\Models\Reject_motion;
use App\Models\Trans_Mention;
use App\Mail\SbeeMarkdownMail;
use App\Mail\TestMarkdownMail;
use App\Models\Request_Category;
use App\Mail\WhChiefMarkdownMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Cache\Store;
use App\Models\Request as RequestData;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RequestController;

class RequestController extends Controller
{
    public function __construct() {
        $this->middleware(['role:super-admin|admin|moderator|user']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return Inertia::render('User/Requests/Index', [
            // 'requests' => RequestData::with('user_id', $user_id)->get(),
            'requests' => RequestData::whereBelongsTo($user)->orderByDesc('id')->get(),
            'requests_count' => RequestData::whereBelongsTo($user)->orderByDesc('id')->get()->count(),
        ]);
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notSent()
    {
        $user = auth()->user();

        $the_requests = RequestData::whereBelongsTo($user)
                                ->where('status', '0')
                                ->where('sent_or', '0')
                                ->where('on_treat', null)
                                ->get()->count();
        // dd($the_requests);
        return Inertia::render('User/Requests/NotSent', [
            // 'requests' => RequestData::with('user_id', $user_id)->get(),
            'requests' => RequestData::whereBelongsTo($user)
                                        ->where('status', '0')
                                        ->where('sent_or', '0')
                                        ->where('on_treat', null)
                                        ->where('token', null)
                                        ->orderByDesc('id')
                                        ->get(),
            'requests_count' => RequestData::whereBelongsTo($user)
                                            ->where('status', '0')
                                            ->where('sent_or', '0')
                                            ->where('on_treat', null)
                                            ->where('token', null)
                                            ->get()->count(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sent()
    {
        $user = auth()->user();
        $user_service = auth()->user()->service_id;

        return Inertia::render('User/Requests/Sent', [
            // 'requests' => RequestData::with('user_id', $user_id)->get(),
            'the_service' => Service::where('id', $user_service),
            'requests' => RequestData::whereBelongsTo($user)
                                        ->where('status', '!=', '0')
                                        ->where('sent_or', '1')
                                        ->where('on_treat', null)
                                        ->where('token', '!=', null)
                                        ->orderByDesc('id')
                                        ->get(),
            'requests_count' => RequestData::whereBelongsTo($user)
                                            ->where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('on_treat', null)
                                            ->where('token', '!=', null)
                                            ->get()->count(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function received()
    {
        $user = auth()->user();
        $user_service = auth()->user()->service_id;
        // $reqId = RequestData::all()->id;

        if($user->grade_id === 5){

            return Inertia::render('User/Requests/Received', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                    
                'requests_count' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('token', '!=', null)
                                            ->get()->count(),
            ]);
        }

        if($user->grade_id === 4){

            return Inertia::render('User/Requests/Received', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }

        if($user->grade_id === 3){

            return Inertia::render('User/Requests/Received', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }

        if($user->grade_id === 2){

            return Inertia::render('User/Requests/Received', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('estimated_amount', '<', 70000000)
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('estimated_amount', '<', 70000000)
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }
        if($user->grade_id === 7){

            return Inertia::render('User/Requests/Received', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }
        if($user->grade_id === 8){

            return Inertia::render('User/Requests/Received', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('wh_chief_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('wh_chief_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }
         if($user->grade_id === 9){

            return Inertia::render('User/Requests/Received', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('wh_chief_approval', '!=', null)
                                            ->where('cm_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('wh_chief_approval', '!=', null)
                                                ->where('cm_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }
        if($user->grade_id === 10){

            return Inertia::render('User/Requests/Received', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('wh_chief_approval', '!=', null)
                                            ->where('cm_approval', '!=', null)
                                            ->where('taker_sign', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('wh_chief_approval', '!=', null)
                                                ->where('cm_approval', '!=', null)
                                                ->where('taker_sign', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function traited()
    {
        $user = auth()->user();
        $user_service = auth()->user()->service_id;
        // $reqId = RequestData::all()->id;

        if($user->grade_id === 5){

            return Inertia::render('User/Requests/Traited', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->orderByDesc('id')
                                                ->get()->count(),
            ]);
        }

        if($user->grade_id === 4){

            return Inertia::render('User/Requests/Traited', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->orderByDesc('id')
                                                ->get()->count(),
            ]);
        }

        if($user->grade_id === 3){

            return Inertia::render('User/Requests/Traited', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }
        if($user->grade_id === 2){

            return Inertia::render('User/Requests/Traited', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('estimated_amount', '<', 70000000)
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('estimated_amount', '<', 70000000)
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }
        if($user->grade_id === 7){

            return Inertia::render('User/Requests/Traited', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('wh_chief_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('wh_chief_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }
        if($user->grade_id === 8){

            return Inertia::render('User/Requests/Traited', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('wh_chief_approval', '!=', null)
                                            ->where('cm_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('wh_chief_approval', '!=', null)
                                                ->where('cm_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }
        if($user->grade_id === 9){

            return Inertia::render('User/Requests/Traited', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('wh_chief_approval', '!=', null)
                                            ->where('cm_approval', '!=', null)
                                            ->where('taker_sign', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('wh_chief_approval', '!=', null)
                                                ->where('cm_approval', '!=', null)
                                                ->where('taker_sign', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }
        if($user->grade_id === 10){

            return Inertia::render('User/Requests/Traited', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('wh_chief_approval', '!=', null)
                                            ->where('cm_approval', '!=', null)
                                            ->where('taker_sign', '!=', null)
                                            ->where('prmp_approval', '!=', null)
                                            ->where('token', '!=', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '1')
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', '!=', null)
                                                ->where('wh_chief_approval', '!=', null)
                                                ->where('cm_approval', '!=', null)
                                                ->where('taker_sign', '!=', null)
                                                ->where('prmp_approval', '!=', null)
                                                ->where('token', '!=', null)
                                                ->get()->count(),
            ]);
        }
    }


      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function onProcess()
    {
        $user = auth()->user();
        $user_service = auth()->user()->service_id;
        // $reqId = RequestData::all()->id;
        if($user->grade_id !== 5 && $user->grade_id !== 4 && $user->grade_id !== 3 && $user->grade_id !== 2 && $user->grade_id !== 1){
    
            return Inertia::render('User/Requests/onProcess', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                'the_service' => Service::where('id', $user_service),
                'requests' => RequestData::whereBelongsTo($user)
                                            ->where('status', '!=', '0')
                                            ->where('sent_or', '0')
                                            ->where('token', null)
                                            ->where('on_treat', '1')
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::whereBelongsTo($user)
                                                ->where('status', '!=', '0')
                                                ->where('sent_or', '0')
                                                ->where('token', null)
                                                ->where('on_treat', '1')
                                                ->orderByDesc('id')
                                                ->get()->count(),
            ]);
        }
        if($user->grade_id === 5){

            return Inertia::render('User/Requests/onProcess', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '0')
                                            ->where('on_treat', '1')
                                            ->where('token', null)
                                            ->where('sH_approval', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '0')
                                                ->where('on_treat', '1')
                                                ->where('token', null)
                                                ->where('sH_approval', null)
                                                ->orderByDesc('id')
                                                ->get()->count(),
            ]);
        }

        if($user->grade_id === 4){

            return Inertia::render('User/Requests/onProcess', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '0')
                                            ->where('token', null)
                                            ->where('on_treat', '1')
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '0')
                                                ->where('on_treat', '1')
                                                ->where('token', null)
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', null)
                                                ->orderByDesc('id')
                                                ->get()->count(),
            ]);
        }

        if($user->grade_id === 3){

            return Inertia::render('User/Requests/onProcess', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '0')
                                            ->where('on_treat', '1')
                                            ->where('token', null)
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '0')
                                                ->where('on_treat', '1')
                                                ->where('token', null)
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', null)
                                                ->orderByDesc('id')
                                                ->get()->count(),
            ]);
        }
        
        if($user->grade_id === 2){

            return Inertia::render('User/Requests/onProcess', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '0')
                                            ->where('on_treat', '1')
                                            ->where('token', null)
                                            ->where('estimated_amount', '<', 70000000)
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '0')
                                                ->where('on_treat', '1')
                                                ->where('token', null)
                                                ->where('estimated_amount', '<', 70000000)
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval', null)
                                                ->orderByDesc('id')
                                                ->get()->count(),
            ]);
        }
         
        if($user->grade_id === 7){

            return Inertia::render('User/Requests/onProcess', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '0')
                                            ->where('on_treat', '1')
                                            ->where('token', null)
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('wh_chief_approval', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '0')
                                                ->where('on_treat', '1')
                                                ->where('token', null)
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval','!=', null)
                                                ->where('wh_chief_approval', null)
                                                ->orderByDesc('id')
                                                ->get()->count(),
            ]);
        } 
        if($user->grade_id === 8){

            return Inertia::render('User/Requests/onProcess', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '0')
                                            ->where('on_treat', '1')
                                            ->where('token', null)
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('wh_chief_approval','!=', null)
                                            ->where('cm_approval', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '0')
                                                ->where('on_treat', '1')
                                                ->where('token', null)
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval','!=', null)
                                                ->where('wh_chief_approval','!=', null)
                                                ->where('cm_approval', null)
                                                ->orderByDesc('id')
                                                ->get()->count(),
            ]);
        }
        if($user->grade_id === 9){

            return Inertia::render('User/Requests/onProcess', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '0')
                                            ->where('on_treat', '1')
                                            ->where('token', null)
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('wh_chief_approval','!=', null)
                                            ->where('cm_approval','!=', null)
                                            ->where('taker_sign', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '0')
                                                ->where('on_treat', '1')
                                                ->where('token', null)
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval','!=', null)
                                                ->where('wh_chief_approval','!=', null)
                                                ->where('cm_approval','!=', null)
                                                ->where('taker_sign', null)
                                                ->orderByDesc('id')
                                                ->get()->count(),
            ]);
        }
        if($user->grade_id === 10){

            return Inertia::render('User/Requests/onProcess', [
                // 'requests' => RequestData::with('user_id', $user_id)->get(),
                // 'request_type' => Request_type::where('id', $reqId),
                'requests' => RequestData::where('status', '!=', '0')
                                            ->where('sent_or', '0')
                                            ->where('on_treat', '1')
                                            ->where('token', null)
                                            ->where('sH_approval', '!=', null)
                                            ->where('rA_approval', '!=', null)
                                            ->where('dPal_approval', '!=', null)
                                            ->where('cDL_approval', '!=', null)
                                            ->where('wh_chief_approval','!=', null)
                                            ->where('cm_approval','!=', null)
                                            ->where('taker_sign','!=', null)
                                            ->where('prmp_approval', null)
                                            ->orderByDesc('id')
                                            ->get(),
                'requests_count' => RequestData::where('status', '!=', '0')
                                                ->where('sent_or', '0')
                                                ->where('on_treat', '1')
                                                ->where('token', null)
                                                ->where('sH_approval', '!=', null)
                                                ->where('rA_approval', '!=', null)
                                                ->where('dPal_approval', '!=', null)
                                                ->where('cDL_approval','!=', null)
                                                ->where('wh_chief_approval','!=', null)
                                                ->where('cm_approval','!=', null)
                                                ->where('taker_sign','!=', null)
                                                ->where('prmp_approval', null)
                                                ->orderByDesc('id')
                                                ->get()->count(),
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function finalized()
    {
        $user = auth()->user();

        return Inertia::render('User/Requests/Finalized', [
            // 'requests' => RequestData::with('user_id', $user_id)->get(),
            'requests' => RequestData::whereBelongsTo($user)
                                        ->where('status', '9')
                                        // ->where('sent_or', '1')
                                        // ->where('token', '!=', null)
                                        ->orderByDesc('id')
                                        ->get(),
            'requests_count' => RequestData::whereBelongsTo($user)
                                            ->where('status', '9')
                                            // ->where('sent_or', '1')
                                            // ->where('token', '!=', null)
                                            ->orderByDesc('id')
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
        $today_date = date('Y-m-d');


        $request_number = 'DA/0';
        $thelastId = RequestData::select('*')->orderByDesc('id')->first();
        if($thelastId){
            $last = $thelastId->id + 1;
        }else{
            $last = 1;
        }
        $request_number .= $last . '/' . date('Y');

        // $request_number2 = 'DA/0';
        // $thelastId = RequestData::orderByDesc('created_at')->limit(1)->count();
        // $request_number2 .= $thelastId + 1 . '/' . date('Y');

        $reference = 'PRC-' . date('d') . date('m') . date('y') . '-DT' . $last;

        return Inertia::render('User/Requests/Create', [
            'today_date' => $today_date,
            'request_types' => Request_type::all(),
            'request_categories' => Request_Category::all(),
            'trans_mentions' => Trans_Mention::all(),
            'request_number' => $request_number,
            // 'request_number2' => $request_number2,
            'reference' => $reference
            // 'roles_count' => Role::all()->count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, RequestData $obj)
    {

        if (auth()->user()->hasAnyRole(['super-admin', 'admin', 'user'])) {

            $user = auth()->user();

            $user_id = auth()->user()->id;
            $user_service_id = auth()->user()->service_id;

            if($request->request_type_id['id'] === 1){

                $user_id = auth()->user()->id;

                $request_number = 'DT/0';
                $thelastId = RequestData::select('*')->orderByDesc('id')->first();
                if($thelastId){
                    $last = $thelastId->id + 1;
                }else{
                    $last = 1;
                }
                $request_number .= $last . '/' . date('Y');

                $reference = 'PRC-' . date('d') . date('m') . date('y') . '-DT' . $last;

                $this->validate($request, [
                    'request_type_id' => ['required', 'min:3'],
                    'request_number' => ['required', 'min:8', 'max:20', 'unique:requests'],
                    'title' => ['required', 'min:8', 'max:100'],
                    'reference' => ['required', 'min:3', 'max:22', 'unique:requests'],
                    'request_category_id' => ['required'],
                    'trans_mention_id' => ['required'],
                    'asked_works' => ['required', 'min:12'],
                    'estimated_amount' => ['required', 'min:5', 'max:10'],
                    'pw_date' => ['required'],
                ]);
                
                RequestData::create([
                    'request_type_id' => $request->request_type_id['id'],
                    'request_number' => $request_number,
                    'title' => $request->title,
                    'reference' => $reference,
                    'request_category_id' => $request->request_category_id['name'],
                    'trans_mention_id' => $request->trans_mention_id['name'],
                    'asked_works' => $request->asked_works,
                    'estimated_amount' => $request->estimated_amount,
                    'pw_date' => $request->pw_date,
                    'user_id' => $user_id,
                    'user_service_id' => $user_service_id,
                    'status' => '0',
                ]);


            }else if($request->request_type_id['id'] === 2 || $request->request_type_id['id'] === 3){

                $user_id = auth()->user()->id;

                $request_number = 'DA/0';
                $thelastId = RequestData::select('*')->orderByDesc('id')->first();
                if($thelastId){
                    $last = $thelastId->id + 1;
                }else{
                    $last = 1;
                }
                $request_number .= $last . '/' . date('Y');

                $reference = 'PRC-' . date('d') . date('m') . date('y') . '-DA' . $last + 1;

                $this->validate($request, [
                    'request_type_id' => ['required', 'min:3'],
                    'request_number' => ['required', 'min:8', 'max:20', 'unique:requests'],
                    'title' => ['required', 'min:8', 'max:100'],
                    'reference' => ['required', 'min:3', 'max:22', 'unique:requests'],
                    'request_category_id' => ['required'],
                    'trans_mention_id' => ['required'],
                    'description' => ['required', 'min:12'],
                    'estimated_amount' => ['required', 'min:5', 'max:10'],
                    'pw_date' => ['required'],
                ]);

                RequestData::create([
                    'request_type_id' => $request->request_type_id['id'],
                    'request_number' => $request_number,
                    'title' => $request->title,
                    'reference' => $reference,
                    'request_category_id' => $request->request_category_id['name'],
                    'trans_mention_id' => $request->trans_mention_id['name'],
                    'description' => $request->description,
                    'estimated_amount' => $request->estimated_amount,
                    'pw_date' => $request->pw_date,
                    'user_id' => $user_id,
                    'user_service_id' => $user_service_id,
                    'status' => '0',
                ]);
            }

            return Inertia::render('User/Requests/NotSent', [
                'requests' => RequestData::whereBelongsTo($user)
                ->where('status', '0')
                ->where('sent_or', '0')
                ->orderByDesc('id')
                ->get(),
                'requests_count' => RequestData::whereBelongsTo($user)
                    ->where('status', '0')
                    ->where('sent_or', '0')
                    ->orderByDesc('id')
                    ->get()->count(),
            ]); 
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(RequestData $request)
    {
        $user = auth()->user();
        $user_service = auth()->user()->service_id;
        // $user_service = Service::where('id', $service_id);
        $pw_date = date('d-m-Y', strtotime($request->pw_date));
        $all_array1 = explode('-', $request->trans_mention_id);
        $all_array2 = explode('-', $request->request_category_id);

        for($i=0; $i<count($all_array2); $i++){
            $each_req_cat = Request_Category::select('*')->where('id', $all_array2[$i])->first();
            // echo $each_req_cat . ' <br>';
        }
        for($i=0; $i<count($all_array1); $i++){
            $each_trans_mention = Trans_Mention::select('*')->where('id', $all_array1[$i])->first();
            // echo $each_req_cat . ' <br>';
        }
        // foreach($each_req_cat as $eas){
        // echo $all_array1;
        // dd('all');
        // }
        // dd($all_array2);
        $trans = Trans_Mention::where('id', $all_array1[0]);
        $this_service = Service::select('*')->where('id', $user_service)->first();
        $sH_id = $request->sH_id;
        $the_sH = User::select('*')->where('id', $sH_id)->first();
        // dd($the_sH->name);

        return Inertia::render('User/Requests/Show', [
            'user' => $user,
            'the_service' => $this_service,
            'request' => $request,
            'the_sH' => $the_sH,
            'pw_date' => $pw_date,
            'req_categories' => $all_array2,
            'trans_mentions' => $all_array1,
            'cDL_reject_motion' => Reject_motion::whereRaw("request_id = $request->id and user_grade = 2")->orderBydesc('id')->limit(1)->get(),
            'dPal_reject_motion' => Reject_motion::whereRaw("request_id = $request->id and user_grade = 3")->orderBydesc('id')->limit(1)->get(),
            'rA_reject_motion' => Reject_motion::whereRaw("request_id = $request->id and user_grade = 4")->orderBydesc('id')->limit(1)->get(),
            'sH_reject_motion' => Reject_motion::whereRaw("request_id = $request->id and user_grade = 5")->orderBydesc('id')->limit(1)->get(),
            // 'roles_count' => Role::all()->count(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestData $request)
    {
        $user = auth()->user();

        return Inertia::render('User/Requests/Edit', [
            'user' => $user,
            'request' => $request,
            'request_types' => Request_type::all(),
            'request_categories' => Request_Category::all(),
            'trans_mentions' => Trans_Mention::all(),
            // 'roles_count' => Role::all()->count(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function backup(Request $request ,RequestData $req)
    {
        $user = auth()->user();
        // dd($request);
        $request_id = $request->query('id');
        $the_request = RequestData::select('*')->where('id', $request_id)->first();
        
        return view('Requests.backup', compact('request_id','the_request', 'user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendBackupTo(Request $request ,RequestData $req)
    {
        $user = auth()->user();
        $user_id = $user->id;
        
        if (auth()->user()->hasAnyRole(['user'])) {

            $reqId = $request->id;
            $approvDate = now();
            $reqNum = $request->request_number;
            $reqRef = $request->reference;
            // dd($request);

            if($request->user_grade == 7){
                            
                // $request->validate([
                //     'file' => 'required|mimes:jpg,jpeg,png,csv,txt,pdf,docx|max:2048'
                // ]);

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'wh_backup' => '1',
                ]);
                $fileUpload = new RequestData;
                
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

                $this_user = User::select('*')->where('grade_id', 2)->first();
                $theBackPoint = $request->wHBackPoint;
                
                // dd($theBackPoint);
                Mail::to($this_user->email)->send(new WhChiefMarkdownMail($user->email, $theBackPoint, $file_path));

                return redirect()->action([RequestController::class, 'traited']);
                
            }
            else if($user->grade_id == 8){
                    
                // $request->validate([
                //     'file' => 'required|mimes:jpg,jpeg,png,csv,txt,pdf, docx|max:2048'
                // ]);

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'cm_id' => $user_id,
                    'status' => '7',
                    'cm_approval' => '1',
                ]); 
                $fileUpload = new RequestData;
                
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

                $this_user = User::select('*')->where('grade_id', 7)->first();
                $theBackPoint = $request->wHBackPoint;
                
                Mail::to($this_user->email)->send(new CmMarkdownMail($user->email, $theBackPoint, $file_path));
                
                $reqNum = $request->request_number;
                
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surname " . " $the_user->name, votre demande vient d'être tranférée par le Chef magasinier à l'approvisionneur.";
                $subject = "Transfert effectué par le chef magasinier";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));
            
                $this_user1 = User::select('*')->where('grade_id', 9)->first();
                $requestLink = 'http://127.0.0.1:8000/user/requests/'.$reqId;
                $subject2 = "Nouvelle demande reçue N: " . $reqNum;
                $content2 = "Nouvelle demande reçue de la part du chef magasinier. Veuillez cliquer sur le lien qui se trouve en bas pour accéder à la demande. Numéro de la demande: $reqNum   Référence: $reqRef";
                Mail::to($this_user1->email)->send(new ActionbackMarkdownMail($user->email, $subject2, $content2, $requestLink));

                return redirect()->action([RequestController::class, 'traited']);
                
            }
        }
    }

    public function sendRequest(Request $req, RequestData $request)
    {

        $user = auth()->user();
        $user_id = $user->id;
        $user_service = $user->service_id;
        if (auth()->user()->hasAnyRole(['user']) && $req->user_id == $user_id) {

            // FIRST SCRIPT OF SENDING REQUEST STEP
            $token = uniqid(rand(15, 25));
            $sent_at = now();

            $reqId = $req->id;
            DB::table('requests')
            ->where('id', $reqId)
            ->update([
                'status' => '1',
                'sent_or' => '1',
                'token' => $token,
            ]) ;

            $sH = User::whereRaw("service_id = $user_service and grade_id = 5")->orderByDesc('id')->limit(1)->get();
            $requestLink = 'http://127.0.0.1:8000/user/requests/'.$reqId;

            // SECOND SCRIPT, MEMO REGISTRATION

            // THRID SCRIPT, AUTOMATIC MESSAGE SENDING TO HS
            // $sH = User::where('grade_id', 5)->where('service_id', $user_service)->get();
            // $sH_id = $sH->id;
      

            foreach($sH as $rec){
                $content = "Bonjour monsieur/madame $rec->name $rec->surname, j'ai redigé une demande que je vous envoie afin que vous puissiez voir si j'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant " . $requestLink;

                // if($rec){
                    Message::create([
                        'sender_id' => $user_id,
                        'receiver_id' => $rec->id,
                        'content' => $content,
                    ]);
                // }
    
                // FOURTH SCRIPT, NOTIFICATION SENDING
                $author = $user->name. ' '. $user->surname;
                $receiver = $rec->name. ' '. $rec->surname;
                Memo::create([
                    'title' => $req->title,
                    'author_id' => $user_id,
                    'author' => $author,
                    'receiver_id' => $rec->id,
                    'receiver' =>  $receiver,
                    'request_id' => $req->id,
                ]);
                // FIFTH SCRIPT, MAIL SENDING
                Mail::to($rec->email)->send(new TestMarkdownMail($user->email, $user->name, $user->surname,$requestLink));
    
            }

        }

        return redirect()->action([RequestController::class, 'sent']);
        
    }

    
    public function sendAgain(Request $req, RequestData $request)
    {

        $user = auth()->user();
        $user_id = $user->id;
        $user_service = $user->service_id;
        if (auth()->user()->hasAnyRole(['user']) && $req->user_id == $user_id) {
            $token = uniqid(rand(15, 25));

            $reqId = $req->id;
            DB::table('requests')
            ->where('id', $reqId)
            ->update([
                'sent_or' => '1',
                'on_treat' => null,
                'token' => $token,
            ]) ;

        }

        return redirect()->action([RequestController::class, 'sent']);

    }
   /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeDelivery(Request $req, RequestData $request)
    {
        $user = auth()->user();
        // dd($req->query('id'));

        $today_date = date('Y-m-d');
        $deliv_number = 'DA/0';
        $thelastId = RequestData::select('*')->where('id', $req->query('id'))->orderByDesc('id')->first();
        if($thelastId){
            $last = $thelastId->id + 1;
        }else{
            $last = 1;
        }
        $deliv_number .= $last . '/' . date('Y');
        $descri = $req->query('id');

        // $reference = 'PRC-' . date('d') . date('m') . date('y') . '-DT' . $last;

        return Inertia::render('User/Requests/CreateDelivery', [
            'user' => $user,
            'today_date' => $today_date,
            'deliv_number' => $deliv_number,
            'descri' => $descri,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $user_service = $user->service_id;
        $request_id = $request->id;

        if (auth()->user()->hasAnyRole(['user'])) {

            $reqId = $request->id;
            $approvDate = now();
            $reqNum = $request->request_number;
            $reqRef = $request->reference;
            // dd($request);

            if($request->user_grade == 5){

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'sH_id' => $user_id,
                    'status' => '2',
                    'sH_approval' => '1',
                    'sH_approvalDate' => $approvDate,
                    'deliv_or' => null,
                ]);

                $reqNum = $request->request_number;

                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient d'être approuvée par le supérieur hiérarchique. Cela suit son cours désormais au niveau du référant approvisionnement.";
                $subject = "Approbation de demande par le supérieur hiérarchique";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));

                $this_user1 = User::select('*')->where('grade_id', 4)->first();
                $requestLink = 'http://127.0.0.1:8000/user/requests/'.$reqId;
                $subject2 = "Nouvelle demande reçue N: " . $reqNum ;
                $content2 = "Nouvelle demande reçue de la part du supérieur hiérarchique. Veuillez cliquer sur le lien qui se trouve en bas pour accéder à la demande. Numéro de la demande: $reqNum   Référence: $reqRef";
                Mail::to($this_user1->email)->send(new ActionbackMarkdownMail($user->email, $subject2, $content2, $requestLink));

                return redirect()->action([RequestController::class, 'traited']);

            }else if($request->user_grade == 4){

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'rA_id' => $user_id,
                    'status' => '3',
                    'rA_approval' => '1',
                    'rA_approvalDate' => $approvDate,
                    'deliv_or' => 1,
                ]);


                $this_user = User::select('*')->where('id', $request->user_id)->first();
                $requestLink = 'http://127.0.0.1:8000/user/requests/'.$reqId;
                $reqUser = $request->user_id;
                Mail::to("commandes@sbee.bj")->send(new SbeeMarkdownMail($this_user->email, $this_user->name, $this_user->surname, $reqUser, $requestLink));

                // SECOND MAIL SENT 

                $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient d'être approuvée par le référant approvisionnement. Cela suit son cours désormais au niveau du Directeur DPAL.";
                $subject = "Approbation de demande par le référant approvisionnement";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));
                
                $this_user1 = User::select('*')->where('grade_id', 3)->first();
                $requestLink = 'http://127.0.0.1:8000/user/requests/'.$reqId;
                $subject2 = "Nouvelle demande reçue N: " . $reqNum;
                $content2 = "Nouvelle demande reçue de la part du référant approvisionnement. Veuillez cliquer sur le lien qui se trouve en bas pour accéder à la demande. Numéro de la demande: $reqNum   Référence: $reqRef";
                Mail::to($this_user1->email)->send(new ActionbackMarkdownMail($user->email, $subject2, $content2, $requestLink));

                return redirect()->action([RequestController::class, 'traited']);

            }else if($request->user_grade == 3){

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'dPal_director_id' => $user_id,
                    'status' => '4',
                    'dPal_approval' => '1',
                    'dPal_approvalDate' => $approvDate,
                ]);

                $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient d'être approuvée par le DPAL. Cela suit son cours désormais au niveau du Directeur CDL.";
                $subject = "Approbation de demande par le DPAL";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));

                $this_user1 = User::select('*')->where('grade_id', 2)->first();
                $requestLink = 'http://127.0.0.1:8000/user/requests/'.$reqId;
                $subject2 = "Nouvelle demande reçue N: " . $reqNum;
                $content2 = "Nouvelle demande reçue de la part du DPAL. Veuillez cliquer sur le lien qui se trouve en bas pour accéder à la demande. Numéro de la demande: $reqNum   Référence: $reqRef";
                Mail::to($this_user1->email)->send(new ActionbackMarkdownMail($user->email, $subject2, $content2, $requestLink));
            
                return redirect()->action([RequestController::class, 'traited']);

            }else if($request->user_grade == 2){

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'cDL_id' => $user_id,
                    'status' => '5',
                    'cDL_approval' => '1',
                    'cDL_approvalDate' => $approvDate,
                ]);

                $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient d'être approuvée par le CDL. Cela suit son cours désormais au niveau du Chef entrepôt.";
                $subject = "Approbation de demande par le CDL";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));
                
                $this_user1 = User::select('*')->where('grade_id', 7)->first();
                $requestLink = 'http://127.0.0.1:8000/user/requests/'.$reqId;
                $subject2 = "Nouvelle demande reçue N: " . $reqNum;
                $content2 = "Nouvelle demande reçue de la part du CDL. Veuillez cliquer sur le lien qui se trouve en bas pour accéder à la demande. Numéro de la demande: $reqNum   Référence: $reqRef";
                Mail::to($this_user1->email)->send(new ActionbackMarkdownMail($user->email, $subject2, $content2, $requestLink));

                return redirect()->action([RequestController::class, 'traited']);
                
            }

        }

        return back();

    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transRequest(Request $request)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $user_service = $user->service_id;
        $request_id = $request->id;

        // Storage::disk('local')->put('avatars', 'Mon compte detest');
        // die();
        // dd($request);

        if (auth()->user()->hasAnyRole(['user'])) {

            $reqId = $request->id;
            $approvDate = now();
            $reqNum = $request->request_number;
            $reqRef = $request->reference;
            // dd($request);

            if($request->user_grade == 7){

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'wh_chief_id' => $user_id,
                    'status' => '6',
                    'wh_chief_approval' => '1',
                ]);
                
                $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient d'être tranférée par le Chef entrepôt au chef magasinier. Cela suit son cours désormais au niveau du Chef magasinier.";
                $subject = "Transfert de votre demande par le Chef entrepôt";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));

                $this_user1 = User::select('*')->where('grade_id', 8)->first();
                $requestLink = 'http://127.0.0.1:8000/user/requests/'.$reqId;
                $subject2 = "Nouvelle demande reçue N: " . $reqNum;
                $content2 = "Nouvelle demande reçue de la part du chef entrepôt. Veuillez cliquer sur le lien qui se trouve en bas pour accéder à la demande. Numéro de la demande: $reqNum   Référence: $reqRef";
                Mail::to($this_user1->email)->send(new ActionbackMarkdownMail($user->email, $subject2, $content2, $requestLink));

                return redirect()->action([RequestController::class, 'traited']);
                
            }else if($user->grade_id == 8){
                
                $request->validate([
                    'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
                ]);

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'cm_id' => $user_id,
                    'status' => '7',
                    'cm_approval' => '1',
                ]); 
                $fileUpload = new RequestData;
                
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

                $this_user = User::select('*')->where('grade_id', 7)->first();
                $theBackPoint = $request->wHBackPoint;
                
                Mail::to($this_user->email)->send(new CmMarkdownMail($user->email, $theBackPoint, $file_path));
                
                $reqNum = $request->request_number;
                
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surname " . " $the_user->name, votre demande vient d'être tranférée par le Chef magasinier à l'approvisionneur.";
                $subject = "Transfert effectué par le chef magasinier";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));
            
                $this_user1 = User::select('*')->where('grade_id', 9)->first();
                $requestLink = 'http://127.0.0.1:8000/user/requests/'.$reqId;
                $subject2 = "Nouvelle demande reçue N: " . $reqNum;
                $content2 = "Nouvelle demande reçue de la part du chef magasinier. Veuillez cliquer sur le lien qui se trouve en bas pour accéder à la demande. Numéro de la demande: $reqNum   Référence: $reqRef";
                Mail::to($this_user1->email)->send(new ActionbackMarkdownMail($user->email, $subject2, $content2, $requestLink));

                return redirect()->action([RequestController::class, 'traited']);
                
            }
            else if($request->user_grade == 9){
                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'taker_sign' => '1',
                    'status' => '8',
                    // 'cm_sign' => $request->taker_sign,
                ]);

                $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient d'être tranférée par l'approvisionneur' à la Personne Responsable des Marchés Publics.";
                $subject = "Transfert éffectué par l'approvisionneur";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));
            
                $this_user1 = User::select('*')->where('grade_id', 10)->first();
                $requestLink = 'http://127.0.0.1:8000/user/requests/'.$reqId;
                $subject2 = "Nouvelle demande reçue N: " . $reqNum;
                $content2 = "Nouvelle demande reçue de la part du l'approvisionneur. Veuillez cliquer sur le lien qui se trouve en bas pour accéder à la demande. Numéro de la demande: $reqNum   Référence: $reqRef";
                Mail::to($this_user1->email)->send(new ActionbackMarkdownMail($user->email, $subject2, $content2, $requestLink));

                return redirect()->action([RequestController::class, 'traited']);
                
            }
            else if($request->user_grade == 10){
                
                // dd($request->file);

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'command_number' => $request->command_number,
                    'sent_at' => now(),
                    'prmp_approval' => '1',
                    'status' => '9',
                ]);
                     
                $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient de connaitre son dernier chemin, elle est finalisée.";
                $subject = "Traitement de bon de commande par la PRMP";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));
                     
                // $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr le Directeur Général, voici les informations sur la demande. Numéro de la demande: " . $reqNum . "  Référence: " . $reqRef;
                $subject = "Information venant de la PRMP";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, "Directeur", "Général", $reqNum, $subject, $content));

                return redirect()->action([RequestController::class, 'traited']);
                
            }
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $user_service = $user->service_id;
        $request_id = $request->id;
            $this->validate($request, [
                'request_id' => ['required'],
                'description' => ['required', 'min:10', 'max:500'],
                'author_id' => ['required'],
                'user_grade' => ['required'],
        ]);
        // dd($request);

        if($request->cReject === true){

            Reject_motion::create([
                'request_id' => $request->request_id,
                'description' => $request->description,
                'cReject' => "1",
                'author_id' => $request->author_id,
                'user_grade' => $request->user_grade,
            ]);
        }else {

            Reject_motion::create([
                'request_id' => $request->request_id,
                'description' => $request->description,
                'cReject' => "0",
                'author_id' => $request->author_id,
                'user_grade' => $request->user_grade,
            ]);
        }
        $reqId = $request->id;
        $approvDate = now();
        // dd($request->user_grade);
        if($request->user_grade == 5){
            if($request->cReject === true){

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'sH_id' => $user_id,
                    'sH_approval' => '0',
                    'sent_or' => '1',
                    'status' => '2',
                    'sH_approvalDate' => $approvDate,
                ]);
                            
                $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient d'être rejetée par le supérieur hiérarchique. Veuillez consulter le suivi de votre demande pour voir le motif de ce rejet.";
                $subject = "Rejet par le supérieur hiérarchique";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));

            }else{
                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'sH_id' => $user_id,
                    'sH_approval' => null,
                    'on_treat' => '1',
                    'sent_or' => '0',
                    'token' => null,
                    'sH_approvalDate' => $approvDate,
                ]);
                
                $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient d'être rejetée par le supérieur hiérarchique. Veuillez consulter le suivi de votre demande pour voir le motif de ce rejet.";
                $subject = "Rejet par le supérieur hiérarchique";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));

            }
        }
        else if($request->user_grade == 4){

            if($request->cReject === true){

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'rA_id' => $user_id,
                    'rA_approval' => '0',
                    'sent_or' => '1',
                    'status' => '3',
                    'rA_approvalDate' => $approvDate,
                ]);

            }else{
                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'rA_id' => $user_id,
                    'rA_approval' => null,
                    'on_treat' => '1',
                    'sent_or' => '0',
                    'token' => null,
                    'rA_approvalDate' => $approvDate,
                ]);

                $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient d'être rejetée par le référant approvisionnement. Veuillez consulter le suivi de votre demande pour voir le motif de ce rejet.";
                $subject = "Rejet par le référant approvisionnement";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));

            }
            
        }else if($request->user_grade == 3){
            if($request->cReject === true){

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'dPal_director_id' => $user_id,
                    'dPal_approval' => '0',
                    'sent_or' => '1',
                    'status' => '4',
                    'dPal_approvalDate' => $approvDate,
                ]);
                
            }else{
                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'dPal_director_id' => $user_id,
                    'dPal_approval' => null,
                    'on_treat' => '1',
                    'sent_or' => '0',
                    'token' => null,
                    'dPal_approvalDate' => $approvDate,
                ]);
                
                $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient d'être rejetée par le DPAL. Veuillez consulter le suivi de votre demande pour voir le motif de ce rejet.";
                $subject = "Rejet par le DPAL";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));

            }

        }else if($request->user_grade == 2){
            if($request->cReject === true){

                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'cDL_id' => $user_id,
                    'cDL_approval' => '0',
                    'sent_or' => '1',
                    'status' => '5',
                    'cDL_approvalDate' => $approvDate,
                ]);
                
            }else{
                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'cDL_id' => $user_id,
                    'cDL_approval' => null,
                    'on_treat' => '1',
                    'sent_or' => '0',
                    'token' => null,
                    'cDL_approvalDate' => $approvDate,
                ]);
                
                $reqNum = $request->request_number;
            
                $the_user = User::select('*')->where('id', $request->user_id)->first();
                $content = "Bonjour Mr $the_user->surame " . " $the_user->name, votre demande vient d'être rejetée par le CDL. Veuillez consulter le suivi de votre demande pour voir le motif de ce rejet.";
                $subject = "Rejet par le CDL";
                Mail::to($the_user->email)->send(new ActionMarkdownMail($user->email, $the_user->name, $the_user->surname, $reqNum, $subject, $content));

            }

        }

        return redirect()->action([RequestController::class, 'traited']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestData $req)
    {

        if (auth()->user()->hasAnyRole(['super-admin', 'admin', 'user'])) {

            $user = auth()->user();

            $user_id = auth()->user()->id;
            $user_service_id = auth()->user()->service_id;
            $reqId = $request->id;

            if($request->request_type_id['id'] === 1){


                // dd($request_number);
                $this->validate($request, [
                    'request_type_id' => ['required', 'min:3'],
                    'title' => ['required', 'min:8', 'max:100'],
                    'asked_works' => ['required', 'min:12'],
                    'estimated_amount' => ['required', 'min:5', 'max:10'],
                    'request_category_id' => ['required'],
                    'trans_mention_id' => ['required'],
                    'pw_date' => ['required'],
                ]); 
                // $trans_array = $request->trans_mention_id;

                // dd($request);
                $reqId = $request->id;
                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'request_type_id' => $request->request_type_id['id'],
                    'title' => $request->title,
                    'asked_works' => $request->asked_works,
                    'estimated_amount' => $request->estimated_amount,
                    'request_category_id' => $request->request_category_id['name'],
                    'trans_mention_id' => $request->trans_mention_id['name'],
                    'pw_date' => $request->pw_date,
                ]);

                // dd('hjbk');


            }else if($request->request_type_id['id'] === 2 || $request->request_type_id['id'] === 3){
                
                $this->validate($request, [
                    'request_type_id' => ['required', 'min:3'],
                    'title' => ['required', 'min:8', 'max:100'],
                    'description' => ['required', 'min:12'],
                    'estimated_amount' => ['required', 'min:5', 'max:10'],
                    'request_category_id' => ['required'],
                    'trans_mention_id' => ['required'],
                    'pw_date' => ['required'],
                ]);

                // dd($request);
                $reqId = $request->id;
                DB::table('requests')
                ->where('id', $reqId)
                ->update([
                    'request_type_id' => $request->request_type_id['id'],
                    'title' => $request->title,
                    'description' => $request->description,
                    'estimated_amount' => $request->estimated_amount,
                    'request_category_id' => $request->request_category_id['name'],
                    'trans_mention_id' => $request->trans_mention_id['name'],
                    'pw_date' => $request->pw_date,
                ]);
                    
            }
        }
        return redirect('/user/requests/'. $reqId);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function undo(Request $request)
    {
        $reqId = $request->id;
        DB::table('requests')
        ->where('id', $reqId)
        ->update([
            'sent_or' => "0",
            'status' => "0",
            'on_treat' => null,
            'token' => null,
            'sH_approval' => null,
            'rA_approval' => null,
            'dPal_approval' => null,
            'cDL_approval' => null,
            'wh_chief_approval' => null,
            'cm_approval' => null,
            'taker_sign' => null,
            'prmp_approval' => null,
            'rA_treatment' => null,
            'wh_treatment' => null,
            'cm_treatment' => null,
            'prmp_treatment' => null,
            'sH_id' => null,
            'rA_id' => null,
            'sH_approvalDate' => null,
            'rA_approvalDate' => null,
            'dPal_director_id' => null,
            'dPal_approvalDate' => null,
            'cDL_id' => null,
            'cDL_approvalDate' => null,
            'wh_chief_id' => null,
            'wh_chief_sign' => null,
            'cm_id' => null,
            'cm_sign' => null,
            'chief_sign' => null,
            'department_sign' => null,
            'pw_date' => null,
            'final_process_date' => null,
        ]);

        $user = auth()->user();

        return redirect()->action([RequestController::class, 'notsent']);

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCommandN(Request $request, RequestData $req)
    {
        // dd($request);
        $user = auth()->user();
        $user_service = auth()->user()->service_id;
        $request_id = $request->id;
        
        $this->validate($request, [
            'command_number' => ['required', 'min:8', 'max:35', 'unique:requests'],
        ]);

        DB::table('requests')
        ->where('id', $request_id)
        ->update([
            'command_number' => $request->command_number,
            // 'pw_date' => $request->pw_date,
            'sent_at' => now(),
            'prmp_treatment' => '1',
            'status' => '9',
        ]);

        return redirect('/user/requests/'. $request_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $request->query('id');
        // dd($request->query('id'));
        
        return Inertia::render('User/Requests/Delete', [
            'request' => $request
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, RequestData $req)
    {
        $user = auth()->user();
        $reqId = $request->id;
        // dd($request->id  );
        RequestData::where('id', $reqId)->delete();
            
        return redirect()->action([RequestController::class, 'notsent']);

    }
}

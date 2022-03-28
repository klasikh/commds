<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Service;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Mat_transfert;
use App\Models\Materials_category;
use App\Models\Reject_motion;
use App\Models\Trans_Mention;
use App\Models\Request_Category;
use App\Models\Materials_list;
use App\Models\Materials_manage;
use Illuminate\Support\Facades\DB;
use App\Models\Request as RequestData;
use Illuminate\Support\Facades\Storage;

class Mat_transfertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Mat_transfert::create($request->all());
        $user = auth()->user();
        // dd($request->query('id'));

        $today_date = date('Y-m-d');
        $deliv_number = 'DA/0';
        $thelastId = RequestData::select('*')->where('id', $request->query('id'))->orderByDesc('id')->first();
        if($thelastId){
            $last = $thelastId->id + 1;
        }else{
            $last = 1;
        }
        $deliv_number .= $last . '/' . date('Y');
        $request_id = $request->query('id');
        
        $user_service = auth()->user()->service_id;
        // $user_service = Service::where('id', $service_id);
        $pw_date = date('d-m-Y', strtotime($request->pw_date));

        $all_array = explode('-', $request->trans_mention_id);

        $trans = Trans_Mention::where('id', $all_array[0]);
        $this_service = Service::select('*')->where('id', $user_service)->first();
        $the_request = RequestData::select('*')->where('id', $request_id)->first();
        $sH_id = $request->sH_id;
        $the_sH = User::select('*')->where('id', $sH_id)->first();

        $materials_categories = Materials_category::all();

        return view('Mat_transferts.create', compact('request_id','the_request', 'sH_id', 'materials_categories'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createDeliv(Request $request)
    {
        $user = auth()->user();
        $user_service = $user->service_id;
        $request_id = $request->request_id;

        $this_service = RequestData::select('*')->where('id', $request_id)->first();
        // dd($this_service->user_service_id);
        // if(preg_match("`^([a-z])$`",$request->unit)){
            if (auth()->user()->hasAnyRole(['user'])) {
                if($request_id != null){
                    $deliv_number = $request->deliv_number;
                    $sens = $request->sens;
                    
                    $saveMatDelivInfo = new Mat_transfert;
                    $saveMatDelivInfo->request_id = $request_id;
                    $saveMatDelivInfo->delivery_number = $deliv_number;
                    $saveMatDelivInfo->creation_date = now();
                    $saveMatDelivInfo->sens = $sens;
                    $saveMatDelivInfo->save();
    
                    $article_code = $request->article_code;
                    $title = $request->title;
                    $unit = $request->unit;
                    $qte = $request->qte;
    
                    if($title != null && $unit != null && $qte != null) {
                        if(count($title) >0 && count($unit) >0 && count($qte) >0){
                        $i = 0;
                        foreach ($title as $requ) {
                            $saveDelivInfo = new Material;
                            $saveDelivInfo->request_id = $request_id;
                            $saveDelivInfo->designation = $title[$i];
                            $saveDelivInfo->stock_count = $unit[$i];
                            $saveDelivInfo->asked_quantity = $qte[$i];
                            $saveDelivInfo->save();
                            $i++ ;
                        }
                        
                        }
                    }
    
                    DB::table('requests')
                    ->where('id', $request_id)
                    ->update([
                        'deliv_or' => 1,
                    ]);
                }
            }else{
                echo "Désolé, vous n'avez pas les droits pour générer un bordereau de matériel";
            }
        // }else{
        //     echo "Format d'unité invalide";
        // }
      
        return redirect('/user/requests/'. $request_id);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        echo "ekjvnerlkvm";
        die($request);
        $title = $request->title;
        return Inertia::render('User/Requests/Sent', [
            'user' => $user,
            'request' => $request,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mat_transfert  $mat_transfert
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Mat_transfert $delivery)
    {
        $user = auth()->user();
        $delivId = $request->id;
        $request = RequestData::select('*')->where('id', $delivId)->orderByDesc('id')->first();
        // dd($delivId);
        return Inertia::render('User/Mat_transferts/Show', [
            'user' => $user,
            'request' => $request,
            'delivery' => Mat_transfert::select('*')->where('request_id', $delivId)->orderByDesc('id')->first(),
            'materials' => Material::select('*')->where('request_id', $delivId)->orderByDesc('id')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mat_transfert  $mat_transfert
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Mat_transfert $mat_transfert)
    {
        $user = auth()->user();
        
        $delivId = $request->id;
        $reqId = $request->request_id;
        $req = RequestData::select('*')->where('id', $reqId)->orderByDesc('id')->first();

        $delivery = Mat_transfert::select('*')->where('id', $delivId)->orderByDesc('id')->first();
        $materials = Material::select('*')->where('request_id', $reqId)->orderByDesc('id')->get();
        // dd($request);
        
        // foreach($materials as $mater){
        // $all_materials = Materials_list::select('*')->where('name', $mater->designation)->orderByDesc('id')->get();
        $materials_categories = Materials_category::all();
        return view('Mat_transferts.edit', compact('user', 'req','delivery', 'materials', 'materials_categories' ));
        // }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mat_transfert  $mat_transfert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mat_transfert $mat_transfert)
    {
        $user = auth()->user();
        $user_service = $user->service_id;
        $request_id = $request->request_id;

        $this_service = RequestData::select('*')->where('id', $request_id)->first();
        
        if($request_id != null){
            $deliv_number = $request->deliv_number;
            $deliv_id = $request->deliv_id;
            $sens = $request->sens;
            $leaving_mag = $request->leaving_mag;
            $destination = $request->destination;
            $benef_mag = $request->benef_mag;
            $other_refs = $request->other_refs;
            $creation_date = now();
            
            if($request->sens !== null){
                DB::table('mat_transferts')
                ->where('id', $deliv_id)
                ->update([
                    'request_id' => $request_id,
                    'delivery_number' => $deliv_number,
                    'sens' => $sens,
                    'leaving_mag' => $leaving_mag,
                    'benef_mag' => $benef_mag,
                    'destination' => $destination,
                    'other_refs' => $other_refs,
                ]);
            }else if($request->sens === null && $request->user_grade == 7){
                
                DB::table('mat_transferts')
                ->where('id', $deliv_id)
                ->update([
                    'request_id' => $request_id,
                    'leaving_mag' => $leaving_mag,
                    'benef_mag' => $benef_mag,
                    'destination' => $destination,
                    'other_refs' => $other_refs,
                ]);
            }

            $matId = $request->mat_id;
            $article_code = $request->article_code;
            $title = $request->title;
            $unit = $request->unit;
            $qte = $request->qte;
            $deliv_qte = $request->deliv_qte;
            $observations = $request->observations;

            $other = $request->other;
            $article_codeo = $request->article_codeo;
            $titleo = $request->titleo;
            $unito = $request->unito;
            $qteo = $request->qteo;
            $deliv_qteo = $request->deliv_qteo;
            $observationso = $request->observationso;

            if($matId != null){
                if(count($matId) >0){
                    $i = 0;
                    foreach($matId as $req){
                        
                        $theMat = Material::select('*')->where('id', $matId)->orderByDesc('id')->first();
        
                        $theMoveMats = Material::select('*')->where('id', '!=', $req)->where('request_id', $request_id)->get();

                        // if(count($theMoveMats) >= 1){
                        //     echo $req;
                        //     dd('ikj');
                        //     foreach($theMoveMats as $link){
                        //         DB::table('materials')
                        //             ->where('id', $link->id)
                        //             ->delete();
                        //     }
                        // }
                       
                        if($article_code == null && $deliv_qte != null && $user->grade_id != 8){
                            
                            DB::table('materials')
                            ->where('id', $matId[$i])
                            ->update([
                                'designation' => $title[$i],
                                'stock_count' => $unit[$i],
                                'asked_quantity' => $qte[$i],
                            ]);
                            $i++;

                        }else if($article_code == null && $deliv_qte == null && $user->id == $request->request_author){

                            DB::table('materials')
                                ->where('id', $matId[$i])
                                ->update([
                                    'designation' => $title[$i],
                                    'stock_count' => $unit[$i],
                                    'asked_quantity' => $qte[$i],
                                ]);
                            $i++;
                            
                        }else if($article_code != null && $deliv_qte == null){
                            DB::table('materials')
                            ->where('id', $matId[$i])
                            ->update([
                                'article_code' => $article_code[$i],
                                'designation' => $title[$i],
                                // 'stock_count' => $unit[$i],
                                // 'asked_quantity' => $qte[$i],
                            ]);
                            $i++;
                        }else if($article_code != null && $deliv_qte != null){
                            DB::table('materials')
                            ->where('id', $matId[$i])
                            ->update([
                                // 'article_code' => $article_code[$i],
                                // 'designation' => $title[$i],
                                // 'stock_count' => $unit[$i],
                                // 'asked_quantity' => $qte[$i],
                                'delivery_quantity' => $deliv_qte[$i],
                                'observations' => $observations[$i],
                            ]);
                            $i++;
                        }
                        if($deliv_qte != null && $request->user_grade == 8){
                            // dd($matId);
                            DB::table('materials')
                            ->where('id', $matId[$i])
                            ->update([
                                'delivery_quantity' => $deliv_qte[$i],
                                'observations' => $observations[$i],
                            ]);

                            $theMat = Materials_manage::where('name', $request->title[$i])->orderByDesc('id')->first();

                            
                            // if($theMat[$i] != null){
                                $quantity_added[] = $theMat->quantity - $deliv_qte[$i];

                                DB::table('materials_manages')
                                ->where('name', $request->title[$i])
                                ->update([
                                    'quantity' => $quantity_added[$i],
                                    'updated_at' => now(),
                                ]);
                                $i++;
                            // }else{
                                
                            //     DB::table('materials_manages')
                            //     ->where('name', $request->title[$i])
                            //     ->update([
                            //         'quantity' => 0,
                            //         'updated_at' => now(),
                            //     ]);
                            //     $i++;
                            // }
                        }
                        // $i++;
                    }
                    $i++;
                }
            }
            if(isset($other)) {

                if($article_codeo == null){
                    if(count($titleo) >0 && count($unito) >0 && count($qteo) >0){
                        $i = 0;
                        foreach ($titleo as $requ) {
                            
                            $saveDelivInfo = new Material;
                            $saveDelivInfo->request_id = $request_id;
                            $saveDelivInfo->designation = $titleo[$i];
                            $saveDelivInfo->stock_count = $unito[$i];
                            $saveDelivInfo->asked_quantity = $qteo[$i];
                            $saveDelivInfo->save();
                            $i++ ;
                        }
                    }
                }else{
                    if(count($titleo) >0 && count($unito) >0 && count($qteo) >0){
                        $i = 0;
                        foreach ($titleo as $requ) {
                            
                            $saveDelivInfo = new Material;
                            $saveDelivInfo->request_id = $request_id;
                            $saveDelivInfo->article_code = $article_codeo[$i];
                            $saveDelivInfo->designation = $titleo[$i];
                            $saveDelivInfo->stock_count = $unito[$i];
                            $saveDelivInfo->asked_quantity = $qteo[$i];
                            // if($deliv_qteo != null){
                            //     $saveDelivInfo->delivery_quantity = $deliv_qteo[$i];
                            // }
                            // if($observationso != null){
                            //     $saveDelivInfo->observations = $observationso[$i];
                            // }
                            $saveDelivInfo->save();
                            $i++ ;
                        }
                    }
                }

            }

            if($user->grade_id == 4){
                DB::table('requests')
                ->where('id', $request_id)
                ->update([
                    'rA_treatment' => 1,
                ]);
            }
            if($user->grade_id == 7){
                DB::table('requests')
                ->where('id', $request_id)
                ->update([
                    'wh_treatment' => 1,
                ]);
            }
            if($user->grade_id == 8){
                DB::table('requests')
                ->where('id', $request_id)
                ->update([
                    'cm_treatment' => 1,
                ]);
            }
        }
      
        return redirect('/user/requests/'. $request_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mat_transfert  $mat_transfert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Mat_transfert $mat_transfert)
    {
        $request_id = $request->query('request_id');
        $id = $request->id;
        // dd($request);
        $allMats = Material::select('id')->where('request_id', $request_id)->delete();

        Mat_transfert::where('id', $id)->update([
            'delivery_number' => null,
            'sens' => null,
            'leaving_mag' => null,
            'benef_mag' => null,
            'destination' => null,
            'other_refs' => null,
        ]);
        return redirect('/user/requests/'.$request_id);
    }
}

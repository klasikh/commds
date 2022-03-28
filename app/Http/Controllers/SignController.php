<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\signature;
// use Image;                      //  this is composer require intervention/image
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class SignController extends Controller
{
    public function index()   // this to get all data in table
    {
        $books = signature::latest()->paginate(2);
       // return array_reverse($books);
       return response()->json($books);
 
    }

    public function openS()
    {
        return Inertia::render('User/Signs', [
        ]);
    }
    public function signe()     // this to get all data in table
    {
        $books = signature::all()->toArray();
        return array_reverse($books);
    }

    function insert_image(Request $request)  // this to insert new data
    {

        $image_file = $request->user_image;
        
        $form_data = array(
           'user_image' => $image_file
        );

        signature::create($form_data);

        return response()
        ->json(['status' => 'successs'], 200);
    
    }

    function fetch_image($image_id)   // this to get all data in table
    {
     $image = signature::findOrFail($image_id);   // to get all image we must convert data in table to image so 

     $image_file = Image::make($image->user_image);   // so make image and use  this is composer require intervention/image

     $response = Response::make($image_file->encode('jpeg'));  // this is to response our image in frontend

     $response->header('Content-Type', 'image/jpeg');

     return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addSign(Request $request)
    {
    //     if($request->user_grade == 5){
    //         $request->validate([
    //             'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
    //         ]);

    //         $fileUpload = new signature;

    //         if($request->file()) {
    //             $file_name = time().'_'.$request->file->getClientOriginalName();
    //             $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

    //             $fileUpload->sH_sign = time().'_'.$request->file->getClientOriginalName();
    //             $fileUpload->taker_sign = '/storage/' . $file_path;
    //             $fileUpload->save();

    //             return response()->json(['success'=>'File uploaded successfully.']);

    //     }
    // }else 
    // if($request->user_grade == 9){
            $request->validate([
                'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
            ]);

            $fileUpload = new signature;

            if($request->file()) {
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

                $fileUpload->sH_sign = $request->user_grade;
                $fileUpload->taker_sign = '/storage/' . $file_path;
                $fileUpload->save();

                return response()->json(['success'=>'File uploaded successfully.']);
        }
    // }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Storage::disk('local')->put('mysign.jpg', $request->sign);
        // Storage::download('file.jpg');
        dd($request);
        die();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function show(signature $signature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function edit(signature $signature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, signature $signature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  /// this function delete data
    {
        //

        $user = signature::findOrFail($id);
        $filePath = $user->image;

        if (file_exists($filePath)) {

        unlink($filePath);
        }

        $user -> delete();
        return back()->with('success', 'success delete');
    }

}

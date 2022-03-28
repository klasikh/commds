<?php 
$categ_array = $request->request_category_id;

if(count($trans_array) === 1){

    $all_array = $trans_array[0]['id'] .'-';

    RequestData::create([
        'request_type_id' => $request->request_type_id['id'],
        'request_number' => $request->request_number,
        'title' => $request->title,
        'reference' => $request->reference,
        'trans_mention_id' => $all_array,
        'asked_works' => $request->asked_works,
        'estimated_amount' => $request->estimate_amount,
        'user_id' => $user_id,
        'status' => 0,
    ]);

}else if(count($trans_array) === 2){

    $all_array = $trans_array[0]['id'] .'-' . $trans_array[1]['id'] .'-' ;

    RequestData::create([
        'request_type_id' => $request->request_type_id['id'],
        'request_number' => $request->request_number,
        'title' => $request->title,
        'reference' => $request->reference,
        'trans_mention_id' => $all_array,
        'asked_works' => $request->asked_works,
        'estimated_amount' => $request->estimate_amount,
        'user_id' => $user_id,
        'status' => 0,
    ]);
}
else if(count($trans_array) === 3){

    $all_array = $trans_array[0]['id'] .'-' . $trans_array[1]['id'] .'-'. $trans_array[2]['id'] ;

    RequestData::create([
        'request_type_id' => $request->request_type_id['id'],
        'request_number' => $request->request_number,
        'title' => $request->title,
        'reference' => $request->reference,
        'trans_mention_id' => $all_array,
        'asked_works' => $request->asked_works,
        'estimated_amount' => $request->estimate_amount,
        'user_id' => $user_id,
        'status' => 0,
    ]);
}else if(count($trans_array) === 4){

    $all_array = $trans_array[0]['id'] .'-' . $trans_array[1]['id'] .'-'. $trans_array[2]['id'] .'-'. $trans_array[3]['id'] ;

    RequestData::create([
        'request_type_id' => $request->request_type_id['id'],
        'request_number' => $request->request_number,
        'title' => $request->title,
        'reference' => $request->reference,
        'trans_mention_id' => $all_array,
        'asked_works' => $request->asked_works,
        'estimated_amount' => $request->estimate_amount,
        'user_id' => $user_id,
        'status' => 0,
    ]);
}else if(count($trans_array) === 5){

    $all_array = $trans_array[0]['id'] .'-' . $trans_array[1]['id'] .'-'. $trans_array[2]['id'] .'-'. $trans_array[3]['id'] .'-'. $trans_array[4]['id'] ;

    RequestData::create([
        'request_type_id' => $request->request_type_id['id'],
        'request_number' => $request->request_number,
        'title' => $request->title,
        'reference' => $request->reference,
        'trans_mention_id' => $all_array,
        'asked_works' => $request->asked_works,
        'estimated_amount' => $request->estimate_amount,
        'user_id' => $user_id,
        'status' => 0,
    ]);
}else if(count($trans_array) === 6){

    $all_array = $trans_array[0]['id'] .'-' . $trans_array[1]['id'] .'-'. $trans_array[2]['id'] .'-'. $trans_array[3]['id'] .'-'. $trans_array[4]['id'] .'-'. $trans_array[5]['id'] ;

    RequestData::create([
        'request_type_id' => $request->request_type_id['id'],
        'request_number' => $request->request_number,
        'title' => $request->title,
        'reference' => $request->reference,
        'trans_mention_id' => $all_array,
        'asked_works' => $request->asked_works,
        'estimated_amount' => $request->estimate_amount,
        'user_id' => $user_id,
        'status' => 0,
    ]);
}else if(count($trans_array) === 7){

    $all_array = $trans_array[0]['id'] .'-' . $trans_array[1]['id'] .'-'. $trans_array[2]['id'] .'-'. $trans_array[3]['id'] .'-'. $trans_array[4]['id'] .'-'. $trans_array[5]['id'] .'-'. $trans_array[6]['id'] ;

    RequestData::create([
        'request_type_id' => $request->request_type_id['id'],
        'request_number' => $request->request_number,
        'title' => $request->title,
        'reference' => $request->reference,
        'trans_mention_id' => $all_array,
        'asked_works' => $request->asked_works,
        'estimated_amount' => $request->estimate_amount,
        'user_id' => $user_id,
        'status' => 0,
    ]);
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SuccessfulEmail;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    
    public function store(Request $request){
        
        $emailData = Validator::make(json_decode($request->getContent(),true),[
            'subject'=>['required'],
            'to' => ['required'],
            'textmessage' => ['required'],
        ]);
        if($emailData->passes()){
            $jsonData = json_decode($request->getContent(), TRUE);
            $headers['content-type'] = $request->header('content-type');
            $headers['accept'] = $request->header('accept');
            $jsonData['headers'] = $headers;
            $combinedString = json_encode($jsonData, JSON_PRETTY_PRINT);
            //print_r($request->get('to'));die;
            $data = SuccessfulEmail::create([
                'subject' => $request->get('subject'),
                'email' => $combinedString,
                'raw_text' => $request->get('textmessage'),
                'to' => $request->get('to')[0]
            ]);
    
            return response()->json([
                'message' => 'Email stored succcessfully',
            ]);
        }else{
            dd($emailData->errors()->all());
        }
        
    }

    public function update(Request $request){
        
        $emailData = Validator::make(json_decode($request->getContent(),true),[
            'id' => ['required'],
            'subject'=>['required'],
            'to' => ['required'],
            'textmessage' => ['required'],
        ]);
        if($emailData->passes()){
            $jsonData = json_decode($request->getContent(), TRUE);
            $headers['content-type'] = $request->header('content-type');
            $headers['accept'] = $request->header('accept');
            $jsonData['headers'] = $headers;
            $combinedString = json_encode($jsonData, JSON_PRETTY_PRINT);
            $id = $request->get('id');
            $record = SuccessfulEmail::findOrFail($id);
           $record->update([
                'subject' => $request->get('subject'),
                'email' => $combinedString,
                'raw_text' => $request->get('textmessage'),
                'to' => $request->get('to')[0]
            ]);
    
            return response()->json([
                'message' => 'Record updated succcessfully',
            ]);
        }else{
            dd($emailData->errors()->all());
        }
        
    }


    public function getByID($id){
        $data = SuccessfulEmail::find($id);    
        return response()->json($data);
    }

    public function getAll(){
        $data = SuccessfulEmail::all();    
        return response()->json($data);
    }

    public function deleteById($id){
        $data = SuccessfulEmail::find($id);
        $data->delete();    
        return response()->json(['message'=>'Record deleted successfully']);
    }
}

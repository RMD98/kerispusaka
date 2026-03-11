<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Jwt\ClientToken;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use DB;
use Carbon\Carbon;
class CallController extends Controller
{
    //
    function index(){
        return view('call');
    }

    function startCall(Request $request){
        // $caller = auth()->user()->user_name;
        $caller = $request->name;
        session('caller_name', $caller);
        $twilio = new Client(
            env('TWILIO_ACCOUNT_SID'),
            env('TWILIO_AUTH_TOKEN')
        );

      
        $twilio->calls->create(
            '+6285222179263', // Agent phone number
            env('TWILIO_PHONE_NUMBER'), // Caller ID (Twilio number)
            [
                'url' => route('call.twiml') // URL Twilio will hit for TwiML
            ]
        );
        // return view('call-started',
        // ['callerName'=>$caller]);
    }

    function twiml(Request $request){
        $name = session('caller_name', 'an unknown caller');

        $response = new VoiceResponse();
        $response->say("You have a new call from $name. Please stay on the line.", ['voice' => 'alice']);
        $response->pause(['length' => 1]);

        return response($response)->header('Content-Type', 'text/xml');
    }

    function sendMessage(Request $request){
        // This function is used to send a WhatsApp message using Wablas API
        // Make sure to set your Wablas API credentials in the .env file
        // WABLAS_API_KEY and WABLAS_SECRET_KEY
        $id = DB::table('ticket')->orderBy('id_ticket', 'desc')->first();
        $year = Carbon::now()->format('Y.m');
        if($id == null){
            $id = '001';
        }else{
            if(substr($id->id_ticket, strrpos($id->id_ticket, '-') + 1,7) != $year){
                $id = 1;
            }else{
                $numb = explode('-', $id->id_ticket)[1];
                $id = explode('.', $numb)[2] + 1;
            }
        }
        $data = [
            'id_ticket' => 'Laporan-'.$year.'.'.sprintf('%03d', $id),
            'id_peternak' => $request->peternak,
            'id_staff' => $request->agent,
            'jenis_laporan' => $request->jenis,
            'status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('ticket')->insert($data);
        fire_and_forget(env('SHEET_WEBHOOK_URL'), [
            'action'      => 'create',
            'table'       => 'ticket',
            'primary_key' => $data['id_ticket'],
            'row'         => $data
        ]);
        if(!env('WABLAS_API_KEY') || !env('WABLAS_SECRET_KEY')){
            return response()->json(['error' => 'Wablas API credentials not set'], 500);
        }
        
    //     $agent = DB::table('staff')
    //         ->where('id_staff', $request->agent)
    //         ->get();
    
    // // Initialize cURL session
    //     $curl = curl_init();

    //     // Your API credentials
    //     $token = env('WABLAS_API_KEY');
    //     $secret_key = env('WABLAS_SECRET_KEY');

    //     // Message details
    //     $sender = DB::table('peternak')
    //         ->where('id_peternak', $request->peternak)
    //         ->get();
    //     $massage = "No Tiket :{$id} \nNama Peternak : {$sender[0]->nama}\nNo Telp Peternak : {$sender[0]->no_hp}\nJenis Laporan : {$request->jenis}";
        
    //     // $massage = "Test";
    //     $data = [
    //     'phone' => '6283163374681',
    //     // 'phone' => $agent->no_hp, // Phone number to send the message to
    //     'message' => $massage,
    //     ];
    //     curl_setopt($curl, CURLOPT_HTTPHEADER,
    //         array(
    //             "Authorization: $token.$secret_key",
    //         )
    //     );
    //     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    //     curl_setopt($curl, CURLOPT_URL,  "https://sby.wablas.com/api/send-message");
    //     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    //     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    //     $result = curl_exec($curl);
    //     curl_close($curl);
        
    //     return response()->json(['success' => true, 'message' => 'WhatsApp message sent successfully', 'data' => json_decode($result)], 200);
        return response()->json(['success' => true, 'message' => 'Ticket created successfully', 'data' => $data], 200);
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class WhatsappController extends Controller
{
	public $json;
    public function __construct()
    {
        $this->middleware('guest');
        $data = file_get_contents(storage_path().'/countrycode.json');
        $this->json = json_decode($data);
    }

    public function index()
    {
    	return view('whatsapp')->with('countrycode',$this->json);
    }

    public function send_whatsapp(Request $request){
    	$agent = new Agent();
    	$request->replace(array(
	    		'phonenumber' => $request->countrycode.$request->phonenumber,
	    		'countrycode' => $request->countrycode,
	    		'message' => $request->message
    		));

    	$validator = Validator::make($request->all(),[
    			'phonenumber' => 'required|regex:/^\+[1-9]{1}[0-9]{3,14}$/',
    			'countrycode' => 'required'
    		]);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator->messages())->withInput($request->all());
    	}
    	else{
    		if ($agent->isDesktop()) {
    			$url = "https://web.whatsapp.com/send?text=".$request->message."&phone=".$request->phonenumber;
    			return Redirect::to($url);
	    	}
	    	else{
	    		$url = "whatsapp://send?text=".$request->message."&phone=".$request->phonenumber;
	    		return Redirect::to($url);
	    	}
    	}
    }

    public function send($phonenumber,$text = "Hello There")
    {
    	$agent = new Agent();
    	if (preg_match("/^\+[1-9]{1}[0-9]{3,14}$/", $phonenumber)) {
    		if ($agent->isDesktop()) {
    			$url = "https://web.whatsapp.com/send?text=".$text."&phone=".$phonenumber;
    			return Redirect::to($url);
	    	}
	    	else{
	    		$url = "whatsapp://send?text=".$text."&phone=".$phonenumber;
	    		return Redirect::to($url);
	    	}
    	}
    	else{
    		$data = [
    			'status' => false,
    			'message' => 'invalid phone number format'
    		];

    		return response()->json($data);
    	}
    }
}

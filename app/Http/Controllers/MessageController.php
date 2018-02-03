<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Message;
use Input;

class MessageController extends Controller
{
		public function getHome() {

			return view('message');
		}

		public function getMessage() {

			$messages = Message::all();

			return response()->json($messages);
		}

    public function postMessage() {

    	$data = Input::all();

    	$name = $data['name'];
    	$message = $data['message'];

    	Message::create(['name' => $name,
    									 'message' => $message]);
    	
    }
}

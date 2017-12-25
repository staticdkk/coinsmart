<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
	public function updateCurrentId(Request $request)
	{
		$user = Auth::user();
		$user->current_message_id = $request['current_id'];
		$user->save();
		return response()->json(true);
	}

   	public function addNewMessage(Request $request)
	{
		$user = Auth::user();

		if(isset($_FILES['fileImage'])){
			$file = $_FILES['fileImage'];
			list($width, $height) = getimagesize($file['tmp_name']);

			preg_match("/.[a-zA-Z]{3,4}$/", $file['name'], $tail);
			$name = 'img/'.$user['id'].'-'.strtotime(date('Y-m-d H:i:s')).$tail[0];
			
			$size = $file['size']/(1024*1024); // MB
			
			if($size >= 0.7 || $size <= 0.05){
				if($size >= 5) $x = 4;
				else if($size >= 4) $x = 3.5;
				else if($size >= 3) $x = 3;
				else if($size >= 2) $x = 2;
				else if($size >= 1) $x = 1.5;
				else if($size >= 0.7) $x = 1;
				else if($size >= 0.03) $x = 0.5;
				else $x = 0.3;

				$new_width = $width/$x;
				$new_height = $height/$x;
        		$src = imagecreatefromstring(file_get_contents($file['tmp_name']));
	            $dst = imagecreatetruecolor( $new_width, $new_height );
	            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	            imagedestroy( $src );
	            if($tail[0] == 'png'){
	            	imagepng( $dst, $file['tmp_name']); 
	            } else {
	            	imagejpeg( $dst, $file['tmp_name']); 
	            }
	            imagedestroy( $dst );
			} 
			
			if(move_uploaded_file($file['tmp_name'], 'public/'.$name)){
				$message = '{"type":"image","message":"'.$name.'"}';
			} else {
				return response()->json(false);
			}
		} else {
			$message = $request['data'];
		}
		
		$data = array(
			'id_user' => $user['id'],
			'id_exchange' => $request['exchange'],
			'message' => $message,
			'date'	  => date('Y-m-d H:i:s')
		);

		// DB::table('message')->insert($data);
		$user['current_message_id'] = DB::table('message')->insertGetId($data);
		$user->save();
		return response()->json(true);
	}

	public function getOldMessage(Request $request)
	{
		$user = Auth::user();
		$id = $request['firstId'];
		$exchange = $request['exchange'];
		if($id < 0) $id = $user['current_message_id'];

		$messages = DB::table('message')
			->join('users', 'users.id', '=', 'message.id_user')
			->select('message.*', 'users.name')
			->where('message.id', '<=', $id)
			->where('message.id_exchange', '=', $exchange)
			// ->whereColumn([
   //                  ['message.id', '<=', $id],
   //                  ['message.id_exchange', '=', $exchange]
   //              ])
			->orderBy('message.id', 'desc')
			->take(10)->get();
		
		$result = '';

		foreach ($messages as $message) {
			$message = (array)$message;
			$result = $this->processMessage($message).$result;
		}

		return response()->json($result);
	}

	public function getNewMessage(Request $request)
	{
		$user = Auth::user();
		$exchange = $request['exchange'];
		$time = 0;
		while(true){
			$qty = DB::table('message')
			    ->where('message.id_exchange', '=', $exchange)
				->where('message.id', '>', $request['current_id'])
				->count();
			$time += 0.5;
			if($time >= $request['timeout'] || $qty > 0) 
				break;
			usleep(500000);
		}
		$data = '';

		$messages = DB::table('message')
				->join('users', 'users.id', '=', 'message.id_user')
				->select('message.*', 'users.name')
				->where('message.id', '>', $request['current_id'])
			    ->where('message.id_exchange', '=', $exchange)
				->orderBy('message.id', 'asc')
				->get();
		foreach ($messages as $message) {
			$message = (array)$message;
			$data .= $this->processMessage($message);
			if($message['id_user'] == $user['id'])
				$qty--;
		}
		$result = array(
			"qty" => $qty, 
			"data" => $data
		);
		return response()->json($result);
	}

	public function processMessage($data)
	{
		$m = (array)json_decode($data['message']);
		if($m['type'] == 'text'){
			$message = preg_replace("/:\)/", "<span class='fa fa-smile-o'></span>", $m['message'])." ";

			$message = preg_replace("/(@.+?)([ ;.,:?!])/", "<span class='tag'>$1</span>$2", $message);	
		} else if($m['type'] == 'icon'){
			$message = "<span class='fa {$m['message']} large'></span>";
		} else $message = "<img src='public/".$m['message']."'>"; 
	
		$result = "<p id='{$data['id']}-message' title='".date("H:i:s", strtotime($data['date']))."'><span class='username'>".$data['name']."</span>".$message."</p>";
		return $result;
	}


	public function testMessage()
	{
		$interview = DB::table('users')->where('level', '=', 1)->get();
		echo "<pre>";
		print_r(date("H:i:s", strtotime("2017-11-6 14:20:11")));
		// return response("true");
		
	}
}

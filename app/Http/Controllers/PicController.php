<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\pics;

use Illuminate\Support\Facades\Input;

class PicController extends Controller
{
	public function index(){return pics::all();}
    /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//return "storage reached";
		$pics = array();
	 
		foreach (input::get('data') as $data){
			$url = "https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=0edf0c91700ff7449c153710cb204820"
			$url .= "&lat=".$data["lat"];
			$url .= "&lon=".$data["lng"];
			$url .= "&format=json&nojsoncallback=1"
			$url .= "&auth_token=72157667895575375-792702598999a01a";
			$url .= "&api_sig=831a667f2f62554b377bb35f44845c8e";
			
			$data_array = json_decode(file_get_contents($url), true) ['photos'] ['photo'];
			
			if (empty($data_array)) continue;

			foreach($data_array as $d){

				$pic = new pics;
				
				//$pic->name = $data["name"];
				$pic->search = $data['search'];

				$pic->id = $d['id'];
				$pic->caption = $d['title'];

				$farm_id = $d('farm-id');
				$server_id = $d('server-id');
				$secret = $d('secret');

				$pic->link = "https://farm{$farm_id}.staticflickr.com/{$server_id}/{$pic->id}_{$secret}.jpg"

				//$pic->low_resolution = $d['images']['low_resolution'];
				//$pic->thumbnail = $d['images']['thumbnail'];
				//$pic->standard_resolution = $d['images']['standard_resolution'];

				$pic->save();

				$pics[] = $pic;
			}
		}

		return $pics;
	}
}

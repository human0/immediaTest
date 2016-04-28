<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pics;

class PicController extends Controller
{
    /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$pics;

		foreach (input::get('data') as $data){
			$url = "https://api.instagram.com/v1/media/search?lat=".$data["lat"];
			$url .= "&lng=".$data["lng"];
			$url .= "&access_token=ACCESS-TOKEN"; //<<<----- still to do
			
				foreach(json_encode(file_get_contents($url))["data"] as $d){
				$pic = new Pic;
				
				$pic->name = $data["name"];
				$pic->search = $data['search'];

				$pic->id = $d['id'];
				$pic->caption = $d['caption'];
				$pic->link = $d['link'];

				$pic->low_resolution = $d['images']['low_resolution'];
				$pic->thumbnail = $d['images']['thumbnail'];
				$pic->standard_resolution = $d['images']['standard_resolution'];

				$pic->save();

				$pics[] = $pic;
			}
		}

		return $pics;
	}
}

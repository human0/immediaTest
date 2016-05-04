<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\pics;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\View;	

class PicController extends Controller
{

	public function index() {
		$pics = array();
		$search = input::has('search') ? input::get('search') : 'coffee';

		$area = 10;

		$raw = (!input::has('search')) ? 
			pics::where('id', '!=', 0) :		
			pics::where('search', 'LIKE', "%{$search}%")
				->where('lat', '>=', input::get("lat")-$area)->where('lat', '<=', input::get("lat")+$area)
				->where('lng', '>=', input::get("lng")-$area)->where('lng', '<=', input::get("lng")+$area);

		$count = $raw->count();
		$pics = $raw->paginate($count/20);

		return View::make('welcome', compact('pics', 'search'));
	}

    /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(){
		$pics = array();

		$url = "https://api.flickr.com/services/rest/?method=flickr.photos.search";
		$url .= "&api_key=1ad998e52dfca4baa06c90efe7e5e514&per_page=10";
		$url .= "&lat=".input::get('lat')."&lon=".input::get('lng');
		$url .= "&radius=1&radius_units=m&format=json&nojsoncallback=1";
		
		$data = json_decode(file_get_contents($url), true);
		$data_array = $data ['photos'] ['photo'];

		if (empty($data_array)) return;

		foreach($data_array as $d){

			if (pics::where('id',$d['id'])->exists()) continue;

			$pic = new pics;			
			$pic->name = input::get('name');
			$pic->search = input::get('search');
			$pic->lat = input::get('lat');
			$pic->lng = input::get('lng');
			$pic->id = $d['id'];
			$pic->caption = $d['title'];
			$pic->link = "https://farm{$d['farm']}.staticflickr.com/{$d['server']}/{$d['id']}_{$d['secret']}.jpg";

			$pic->save();
			$pics[] = $pic;
		}
	
		return $pics;	
	}
}

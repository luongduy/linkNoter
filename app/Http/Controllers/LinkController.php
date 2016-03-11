<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LinkRepository;


class LinkController extends Controller
{	
	protected $links;
	public function index(Request $request) {
		return view('links.index', [
			'links' => $this->links->forUser($request->user()),
		]);
	}
	public function store() {
		$request->user()->links()->create([
        	'title' => $request->title,
        	'href' => $request->href
    	]);
    	// TODO: storing tags

	}
    public function __construct(LinkRepository $links) {
    	$this->middleware('auth');
		$this->links = $links;
    }
}

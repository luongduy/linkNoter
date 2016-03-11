<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LinkRepository;
use App\Repositories\TagRepository;
use App\Util;
use App\Tag;
use Log;

class LinkController extends Controller
{	
	protected $links, $tags; // repository

	public function index(Request $request) {
		return view('links.index', [
			'links' => $this->links->getAllLinks(),
		]);
	}
	// save new link to database
	public function store(Request $request) {
		$href = $request->url;
		$util = new Util();
		// get the page's title based on page url
		$title = $util->getTitle($href);
		// save the link to database
		$savedLink = $request->user()->links()->create([
        	'title' => $title,
        	'href' => $href,
        	'voted' => 0,
        	'viewed' => 0,
 		]);
 		// save the tags to database
    	$tagArr = array_unique(explode(',', $request->tags));
    	foreach ($tagArr as $tagString) {
    		if ($tagString != ""){
    			$existedTag = $this->tags->getTagByName($tagString);	
    			if ($existedTag == null){
    				$newTag = new Tag;
    				$newTag->name = $tagString;
    				$savedLink->tags()->save($newTag);
    			}else {
    				$savedLink->tags()->attach($existedTag);
    			}
    		}
    	}
    	return redirect('/links');
	}
    public function __construct(LinkRepository $links, TagRepository $tags) {
	   	$this->middleware('auth');
		$this->links = $links;
		$this->tags = $tags;
    }

}

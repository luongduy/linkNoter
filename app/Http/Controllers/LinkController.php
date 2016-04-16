<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LinkRepository;
use App\Repositories\TagRepository;
use App\Repositories\CommentRepository;
use App\Util;
use App\Tag;
use App\Link;
use App\Comment;
use Log;

class LinkController extends Controller
{	
	protected $links, $tags, $comments; // repository

	public function __construct(LinkRepository $links, TagRepository $tags, CommentRepository $comments) {
	   	$this->middleware('auth', ['only' => [
	   		'store',
	   		'increaseVote',
	   		'decreaseVote',
	   		'increaseCommentVote',
	   		'decreaseCommentVote',
	   		'postComment',
	   		'deleteLink'
   		]]);
		$this->links = $links;
		$this->tags = $tags;
		$this->comments = $comments;
    }

	public function index(Request $request) {
		$link_collection = $this->links->getAllLinks();
		$vote_arr = $this->links->getVotes($link_collection, $request->user());
		return view('links.index', [
			'links' => $link_collection,
			'votes' => $vote_arr
		]);
	}
	// save new link to database
	public function store(Request $request) {
		$href = $request->url;
		$util = new Util();
		// get the page's title based on page url
		$title = $util->getTitle($href);
		if ($title === FALSE) {
			return view ('errors.link_error');
		}
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
	// return links that have $tag
	public function getTag(Request $request, $tag) {
		$link_collection = $this->tags->getTagByName($tag)->links;
		$votecomment_arr = $this->links->getVotes($link_collection, $request->user());
		return view('links.index', [
			'links' => $link_collection,
			'votes' => $votecomment_arr
		]);
	}
	// return comments page
	public function getComments(Request $request, Link $link) {
		$vote = $this->links->getVote($link, $request->user());
		$comment_collection = $this->comments->forLink($link);
		$vote_arr = $this->comments->getVotes($comment_collection, $request->user());
		return view('links.comments' ,[
			'link' => $link,
			'vote' => $vote,
			'comments' => $comment_collection,
			'votes' => $vote_arr
		]);
	}
	// post a comment
	public function postComment(Request $request, Link $link) {
		$content = $request->content;
		$comment = new Comment;
		$comment->user_id = $request->user()->id;
		$comment->link_id = $link->id;
		$comment->content = $content;
		$comment->save();
		return redirect('/links/'.$link->id.'/comments');
	}
	// return page with all tags
	public function getTags() {
		return view('links.tags', [
			'tags' => $this->tags->getAllTags(),
		]);
	}

	public function increaseView(Request $request, Link $link) {
		$link->viewed = $link->viewed + 1;
		$link->save();	
		return "";
	}
	public function increaseVote(Request $request, Link $link) {
		$this->links->increaseVote($link, $request->user());
		return "";
	}
	public function decreaseVote(Request $request, Link $link) {
		$this->links->decreaseVote($link, $request->user());
		return "";
	}
	public function deleteLink(Request $request, Link $link) {
		$link->delete();
		return redirect('/links');
	}

	public function increaseCommentVote(Request $request, Link $link, Comment $comment) {
		$this->comments->increaseCommentVote($comment, $request->user());
		return "";
	}
	public function decreaseCommentVote(Request $request, Link $link, Comment $comment) {
		$this->comments->decreaseCommentVote($comment, $request->user());
		return "";
	}

	public function doSearch(Request $request) {
		if ($request->searchText == null)
			return redirect ('/links');
		$searchString = $request->searchText;
		$link_collection = $this->links->searchLinks($searchString);
		$vote_arr = $this->links->getVotes($link_collection, $request->user());
		return view('links.index', [
			'links' => $link_collection,
			'votes' => $vote_arr
		]);
	}

}

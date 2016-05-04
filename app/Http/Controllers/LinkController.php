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
   		$this->middleware('post_redirect', ['only' => [
   			'postComment',
		]]);
		$this->links = $links;
		$this->tags = $tags;
		$this->comments = $comments;
    }

	public function index(Request $request) {
		$user = $request->user();
		$link_collection_time = $this->links->getAllLinks('time');
		$vote_arr_time = $this->links->getVotes($link_collection_time, $user);
		$link_collection_vote = $this->links->getAllLinks('vote');
		$vote_arr_vote = $this->links->getVotes($link_collection_vote, $user);
		$link_collection_view = $this->links->getAllLinks('view');
		$vote_arr_view = $this->links->getVotes($link_collection_view, $user);
		return view('links.index', [
			'links_sort_by_time' => $link_collection_time,
			'votes_sort_by_time' => $vote_arr_time,
			'links_sort_by_vote' => $link_collection_vote,
			'votes_sort_by_vote' => $vote_arr_vote,
			'links_sort_by_view' => $link_collection_view,
			'votes_sort_by_view' => $vote_arr_view,
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
		$user = $request->user();
		$link_collection_time = $this->tags->getLinksByTagName($tag, 'time');
		$vote_arr_time = $this->links->getVotes($link_collection_time, $user);
		$link_collection_vote = $this->tags->getLinksByTagName($tag, 'vote');
		$vote_arr_vote = $this->links->getVotes($link_collection_vote, $user);
		$link_collection_view = $this->tags->getLinksByTagName($tag, 'view');
		$vote_arr_view = $this->links->getVotes($link_collection_view, $user);
		return view('links.index', [
			'links_sort_by_time' => $link_collection_time,
			'votes_sort_by_time' => $vote_arr_time,
			'links_sort_by_vote' => $link_collection_vote,
			'votes_sort_by_vote' => $vote_arr_vote,
			'links_sort_by_view' => $link_collection_view,
			'votes_sort_by_view' => $vote_arr_view,
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
		if ($request->has('content')) {
			$content = $request->content;
			$comment = new Comment;
			$comment->user_id = $request->user()->id;
			$comment->link_id = $link->id;
			$comment->content = $content;
			$comment->save();
		}
		return redirect('/links/'.$link->id);
	}
	// return page with all tags
	public function getTags() {
		return view('links.tags', [
			'tags' => $this->tags->getAllTags(),
		]);
	}

	public function increaseView(Request $request, Link $link) {
		$link->viewed ++;
		$status = $link->save();	
		return $status;
	}
	public function increaseVote(Request $request, Link $link) {
		$status = $this->links->increaseVote($link, $request->user());
		return $status;
	}
	public function decreaseVote(Request $request, Link $link) {
		$status = $this->links->decreaseVote($link, $request->user());
		return $status;
	}
	public function deleteLink(Request $request, Link $link) {
		$link->delete();
		return "";
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

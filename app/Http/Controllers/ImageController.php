<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
	public function getEmojiImage($filename) {
		$path = public_path(config('assets.emoji-images')) . $filename;
		return response()->download($path);
	}
}

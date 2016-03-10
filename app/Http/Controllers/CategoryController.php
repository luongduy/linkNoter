<?php

namespace App\Http\Controllers;

use App\Category;
use App\Note;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $categories = Category::where('user_id', $request->user()->id)->get();

        //get current notes by cate_id in uri, if not, default is first one in his categories
        $selectedCId = $request->get('c_id');
        if (empty($selectedCId)) {
            $defaultCategory = Category::first();
            if ($defaultCategory) {
                $selectedCId = $defaultCategory->id;
            }
        }

        $notes = Note::where('category_id', $selectedCId)->get();

        return view('categories.index', [
            'categories' => $categories,
            'notes' => $notes,
        ]);

    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);


    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }

}

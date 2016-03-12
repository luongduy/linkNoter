<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\NoteRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    protected $categories;
    protected $notes;

    public function __construct()
    {
        $this->middleware('auth');
        $this->categories = CategoryRepository::getInstance();
        $this->notes = NoteRepository::getInstance();
    }

    /**
     * Get current notes by cate_id in uri, if not, default is first one in his categories
     *
     * @param Request $request
     * @return integer
     */
    protected function getCategoryIdFromRequest(Request $request) {
        $selectedCId = $request->get('c_id');
        if (empty($selectedCId)) {
            $defaultCategory = $this->categories->forUser($request->user())
                ->first();
            if ($defaultCategory) {
                $selectedCId = $defaultCategory->id;
            }
        }
        return $selectedCId;
    }

    public function index(Request $request)
    {
        $categories = $this->categories->forUser($request->user())
            ->get();


        $selectedCId = $this->getCategoryIdFromRequest($request);
        $notes = NoteRepository::getInstance()
            ->forCategory($selectedCId)
            ->get();

        return view('categories.index', [
                'categories' => $categories, 'notes' => $notes,
            ]
        );

    }

    public function storeCategory(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|max:255',
            ]
        );

        $request->user()->categories()->create([
            'name' => $request->name
        ]);

        return redirect('/categories');
    }

    public function storeNote(Request $request)
    {
        $this->validate($request, [
                'title' => 'required|max:255', 'content' => 'required',
            ]
        );

        $categoryId = $this->getCategoryIdFromRequest($request);
        $category = $this->categories->findOne($categoryId);

        $category->notes()->create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

        return redirect('/categories');
    }

    public function delete(Request $request)
    {

    }

}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\NoteRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    //TODO Currently disable Notes function, discussing more!!!

    protected $categories;
    protected $notes;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->categories = CategoryRepository::getInstance();
        $this->notes      = NoteRepository::getInstance();
        $user             = $request->user();
        if ($user) {
            $this->notes->setUser($user);
        }
    }

    /**
     * Get current notes by cate_id in uri, if not, default is first one in his categories
     *
     * @param Request $request
     * @return Category | null
     */
    protected function getCategoryFromRequest(Request $request, $cid)
    {
        if (empty($cid)) {
            $defaultCategory = $this->categories->forUser($request->user())->firstOrFail();
            if ($defaultCategory) {
                return $defaultCategory;
            }
        }

        return $this->categories->forUser($request->user())->where('id', $cid)->firstOrFail();
    }

    public function index(Request $request, $cid = null)
    {
        $categories = $this->categories->forUser($request->user())->get();

        $currentCate = $this->getCategoryFromRequest($request, $cid);

        $notes = null;
        if ($currentCate) {
            $notes = $this->notes->forCategory($currentCate->id)->get();
        }

        return view('categories.index', [
                'categories'  => $categories,
                'notes'       => $notes,
                'currentCate' => $currentCate
            ]);

    }

    public function storeCategory(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|max:255',
            ]);

        $category = $request->user()->categories()->create([
            'name' => $request->input('name')
        ]);

        /** @var $category Category */

        return response()->json($category->toArray());
    }

    public function editCategory(Request $request, $cid = null)
    {
        $this->validate($request, [
                'name' => 'required|max:255',
            ]);

        $category = $this->categories->forUser($request->user())->where('id', $cid)->firstOrFail();

        $status = $category->update(['name' => $request->input('name')]);
        if ($status) {
            return redirect('/categories/' . $cid);
        }

    }

    public function destroyCategory(Request $request, $cid = null)
    {
        $category = $this->categories->forUser($request->user())->where('id', $cid)->firstOrFail();
        if ($category) {
            if ($category->delete()) {
                return redirect('/categories');
            }
        }

    }

    public function editNote($id, Request $request)
    {
        $note = $this->notes->findOne($id);
        if ($note && $request->isMethod('get')) {
            return view('categories.edit_note', [
                    'note' => $note,
                ]);
        }

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'title'   => 'required|max:255',
                'content' => 'required'
            ]);

            $status = $note->update([
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
            ]);
            if ($status) {
                return redirect('/categories/' . $note['category_id']);
            }
        }

    }

    public function storeNote(Request $request, $cid = null)
    {
        $this->validate($request, [
                'title'   => 'required|max:255',
                'content' => 'required',
            ]);

        $category = $this->categories->forUser($request->user())->where('id', $cid)->firstOrFail();
        if (!$category) {
            return response()->json(['status' => false]);
        }

        /**@var $category Category */
        $note           = $category->notes()->create([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        $note           = $note->toArray();
        $note['status'] = true;

        return response()->json($note);
    }

    public function destroyNote($id, Request $request)
    {
        $this->notes->setUser($request->user());
        $note = $this->notes->findOne($id);
        if ($note) {
            if ($note->delete()) {
                return response()->json(['status' => true]);
            }
        }

        return response()->json(['status' => false]);
    }

}

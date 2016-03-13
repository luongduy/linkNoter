<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\NoteRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    protected $categories;
    protected $notes;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->categories = CategoryRepository::getInstance();
        $this->notes = NoteRepository::getInstance();
        $this->notes->setUser($request->user());
    }

    /**
     * Get current notes by cate_id in uri, if not, default is first one in his categories
     *
     * @param Request $request
     * @return integer
     */
    protected function getCategoryIdFromRequest(Request $request, &$cid) {
        if (empty($cid)) {
            $defaultCategory = $this->categories->forUser($request->user())
                ->first();
            if ($defaultCategory) {
                $cid = $defaultCategory->getAttribute('id');
            }
        }
        return $cid;
    }

    public function index(Request $request, $cid = null)
    {
        $categories = $this->categories->forUser($request->user())
            ->get();

        $selectedCId = $this->getCategoryIdFromRequest($request, $cid);
        $notes = NoteRepository::getInstance()
            ->forCategory($selectedCId)
            ->get();
        return view('categories.index', [
                'categories' => $categories, 'notes' => $notes, 'cid' => $cid
            ]
        );

    }

    public function editNote($id, Request $request)
    {
        $rMethod = $request->getMethod();
        $note = $this->notes->findOne($id);
        if ($note && $rMethod == 'GET') {
            return view('categories.editNote', [
                    'note' => $note,
                ]
            );
        }

        if ($request->getMethod() === 'POST') {
            $this->validate($request, [
                'title' => 'required|max:255', 'content' => 'required'
            ]);

            $status = $note->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);
            if ($status) {
                return redirect('/categories/' . $note['category_id']);
            }
        }

        return 'Page not found';
    }

    public function storeCategory(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|max:255',
            ]
        );

        $category = $request->user()->categories()->create([
            'name' => $request->input('name')
        ]);
        /** @var $category Category */

        return response()->json($category->toArray());
    }

    public function storeNote(Request $request, $cid = null)
    {
        $this->validate($request, [
                'title' => 'required|max:255', 'content' => 'required',
            ]
        );

        $categoryId = $this->getCategoryIdFromRequest($request, $cid);
        if  (!$categoryId) {
            return response()->json(['status' => false]);
        }
        $category = $this->categories->findOne($categoryId);

        $note = $category->notes()->create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);
        $note = $note->toArray();
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

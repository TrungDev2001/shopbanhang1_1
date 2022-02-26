<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\deleteTraits;

class CategoryPostController extends Controller
{
    use deleteTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $categoryPost;
    public function __construct(CategoryPost $categoryPost)
    {
        $this->categoryPost = $categoryPost;
    }
    public function index(Request $request)
    {
        $categoryPosts = $this->categoryPost->latest()->paginate(5);
        if ($request->ajax()) {
            $categoryPostHtml = view('admin.CategoryPost.data', compact('categoryPosts'))->render();
            return Response()->json([
                'status' => 200,
                'categoryPostHtml' => $categoryPostHtml,
            ]);
        }
        return view('admin.CategoryPost.index', compact('categoryPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Validator = Validator::make(
            $request->all(),
            [
                'nameCategoryPost' => ['required'],
                'slugCategoryPost' => ['required'],
                'descriptionCategoryPost' => ['required'],
            ],
            [
                'nameCategoryPost.required' => 'Name không được để trống',
                'slugCategoryPost.required' => 'Slug không được để trống',
                'descriptionCategoryPost.required' => 'Description không được để trống',
            ]
        );
        if ($Validator->fails()) {
            return Response()->json([
                'status' => 400,
                'errors' => $Validator->errors(),
            ]);
        } else {
            $this->categoryPost->create([
                'name' => $request->nameCategoryPost,
                'slug' => $request->slugCategoryPost,
                'description' => $request->descriptionCategoryPost,
                'action' => $request->statusCategory,
            ]);
            return Response()->json([
                'status' => 200,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryPost = $this->categoryPost->find($id);
        return Response()->json([
            'status' => 200,
            'categoryPost' => $categoryPost
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoryPost = $this->categoryPost->find($id);
        $categoryPost->update([
            'name' => $request->nameCategoryPostEdit,
            'slug' => $request->slugCategoryPostEdit,
            'description' => $request->descriptionCategoryPostEdit,
            'action' => $request->statusCategoryPostEdit,
        ]);
        return Response()->json([
            'status' => 200,
            'categoryPost' => $categoryPost,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != 11) { // không được phép xóa danh mục bài tin footer
            return $this->DeleteTraits($this->categoryPost, $id);
        } else {
            return Response()->json([
                'status' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}

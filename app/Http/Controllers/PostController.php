<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Traits\deleteTraits;
use App\User;

class PostController extends Controller
{
    use deleteTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $categoryPost;
    private $post;
    private $tag;
    private $postTag;
    public function __construct(CategoryPost $categoryPost, Post $post, Tag $tag, PostTag $postTag)
    {
        $this->categoryPost = $categoryPost;
        $this->post = $post;
        $this->tag = $tag;
        $this->postTag = $postTag;
    }
    public function index(Request $request)
    {
        $posts = $this->post->latest()->paginate(5);
        if ($request->ajax()) {
            $LoadPaginatePostHtml = view('admin.Post.data', compact('posts'))->render();
            return Response()->json([
                'status' => 200,
                'LoadPaginatePostHtml' => $LoadPaginatePostHtml,
            ]);
        }
        return view('admin.Post.index', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryPosts = $this->categoryPost->latest()->where('action', 0)->get();
        $tags = $this->tag->latest()->take(6)->get();
        return view('admin.Post.add', compact('categoryPosts', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataCreatePost = [
            'title' => $request->titlePostAdd,
            'slug' => $request->SlugPostAdd,
            'description' => $request->DescriptionPostAdd,
            'content' => $request->ContentPostAdd,
            'categoryPost_id' => $request->CategoryPostAdd,
            'status' => $request->StatusPostAdd,
            'user_id' => Auth()->id(),
        ];
        if ($request->hasFile('FileImagePostAdd')) {
            $file = $request->FileImagePostAdd;
            $nameFile = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $image_path = 'uploads/post/' . Auth()->id() . '/' . time() . Str::random(3) . '.' . $extension;
            $file->move('uploads/post/' . Auth()->id(), $image_path);
            $dataCreatePost['image_name'] = Str::slug($nameFile);
            $dataCreatePost['image_path'] = $image_path;
        }
        $post = $this->post->create($dataCreatePost);
        if ($request->PostTagsAdd) {
            foreach ($request->PostTagsAdd as $tag) {
                $tags = $this->tag->firstOrCreate([
                    'name' => $tag,
                ]);
                $tagIds[] = $tags->id;
            }
        }
        $post->tags()->attach($tagIds);
        return redirect()->route('Post.index');
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
        $post = $this->post->find($id);
        $categoryPosts = $this->categoryPost->latest()->where('action', 0)->get();
        $tagsForPost = $post->tags;
        foreach ($tagsForPost as $item) {
            $tagsForPostId[] = $item->id;
        }
        $tags = $this->tag->latest()->whereNotIn('id', [$tagsForPostId])->take(6)->get();

        return view('admin.Post.edit', compact('categoryPosts', 'tags', 'post', 'tagsForPost'));
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
        $post = $this->post->find($id);
        $dataUpdatePost = [
            'title' => $request->titlePostAdd,
            'slug' => $request->SlugPostAdd,
            'description' => $request->DescriptionPostAdd,
            'content' => $request->ContentPostAdd,
            'categoryPost_id' => $request->CategoryPostAdd,
            'status' => $request->StatusPostAdd,
        ];
        if ($request->hasFile('FileImagePostAdd')) {
            $file = $request->FileImagePostAdd;
            if (File::exists($post->image_path)) {
                File::delete($post->image_path);
            }
            $nameFile = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $image_path = 'uploads/post/' . Auth()->id() . '/' . time() . Str::random(3) . '.' . $extension;
            $file->move('uploads/post/' . Auth()->id(), $image_path);
            $dataUpdatePost['image_name'] = Str::slug($nameFile);
            $dataUpdatePost['image_path'] = $image_path;
        }
        $post->update($dataUpdatePost);
        if ($request->PostTagsAdd) {
            foreach ($request->PostTagsAdd as $tag) {
                $tags = $this->tag->firstOrCreate([
                    'name' => $tag,
                ]);
                $tagIds[] = $tags->id;
            }
        }
        $post->tags()->sync($tagIds);
        return redirect()->route('Post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->post->find($id);
        if (File::exists($post->image_path)) {
            File::delete($post->image_path);
        }
        $post->tags()->detach();
        return $this->DeleteTraits($this->post, $id);
    }
}

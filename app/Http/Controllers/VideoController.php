<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Traits\deleteTraits;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use deleteTraits;
    private $video;
    public function __construct(Video $video)
    {
        $this->video = $video;
    }
    public function index(Request $request)
    {
        $videos = $this->video->latest()->paginate(5);
        if ($request->ajax()) {
            $videoLoadPaginate = view('admin.Video.data', compact('videos'))->render();
            return Response()->json([
                'status' => 200,
                'videoLoadPaginate' => $videoLoadPaginate,
            ]);
        }
        return view('admin.Video.index', compact('videos'));
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
        try {
            DB::beginTransaction();
            $validata = Validator::make(
                $request->all(),
                [
                    'titleAdd' => 'required',
                    'slugAdd' => 'required',
                    'descriptionAdd' => 'required',
                    'linkAdd' => 'required',
                ],
                [
                    'titleAdd.required' => 'Title không được để trống',
                    'slugAdd.required' => 'Slug không được để trống',
                    'descriptionAdd.required' => 'Description không được để trống',
                    'linkAdd.required' => 'Link không được để trống',
                ]
            );
            if ($validata->fails()) {
                return Response()->json([
                    'status' => 401,
                    'errors' => $validata->errors(),
                ]);
            } else {
                $data_video_add = [
                    'title' => $request->titleAdd,
                    'slug' => $request->slugAdd,
                    'discription' => $request->descriptionAdd,
                    'link' => $request->linkAdd,
                    'status' => $request->statusAdd,
                ];
                if ($request->has('imageVideoAdd')) {
                    $fileImage = $request->imageVideoAdd;
                    $image_name_video = $fileImage->getClientOriginalName();
                    $extension = $fileImage->getClientOriginalExtension();
                    $image_name_path = 'uploads/video/' . Auth()->id() . '/' . time() . '.' . $extension;
                    $fileImage->move('uploads/video/' . Auth()->id(), $image_name_path);
                    $data_video_add['image_name_video'] = substr(Str::slug($image_name_video), 0, -3);
                    $data_video_add['image_path_video'] = $image_name_path;
                }
                $videos[] = $this->video->create($data_video_add);
                DB::commit();
                if ($videos) {
                    $videoHtml = view('admin.Video.data', compact('videos'))->render();
                    return Response()->json([
                        'status' => 200,
                        'videoHtml' => $videoHtml,
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' Line: ' . $e->getLine());
            return Response()->json([
                'status' => 400,
                'Message' => 'Message: ' . $e->getMessage() . ' Line: ' . $e->getLine(),
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
        $video = $this->video->find($id);
        return Response()->json([
            'status' => 200,
            'video' => $video,
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
        try {
            DB::beginTransaction();
            $validata = Validator::make(
                $request->all(),
                [
                    'titleEdit' => 'required',
                    'slugEdit' => 'required',
                    'descriptionEdit' => 'required',
                    'linkEdit' => 'required',
                ],
                [
                    'titleEdit.required' => 'Title không được để trống',
                    'slugEdit.required' => 'Slug không được để trống',
                    'descriptionEdit.required' => 'Description không được để trống',
                    'linkEdit.required' => 'Link không được để trống',
                ]
            );
            if ($validata->fails()) {
                return Response()->json([
                    'status' => 401,
                    'errors' => $validata->errors(),
                ]);
            } else {
                $data_video_add = [
                    'title' => $request->titleEdit,
                    'slug' => $request->slugEdit,
                    'discription' => $request->descriptionEdit,
                    'link' => $request->linkEdit,
                    'status' => $request->statusEdit,
                ];
                if ($request->has('imageVideoEdit')) {
                    $fileImage = $request->imageVideoEdit;
                    $image_name_video = $fileImage->getClientOriginalName();
                    $extension = $fileImage->getClientOriginalExtension();
                    $image_name_path = 'uploads/video/' . Auth()->id() . '/' . time() . '.' . $extension;
                    $fileImage->move('uploads/video/' . Auth()->id(), $image_name_path);
                    $data_video_add['image_name_video'] = substr(Str::slug($image_name_video), 0, -3);
                    $data_video_add['image_path_video'] = $image_name_path;
                }
                $video = $this->video->find($id);
                $video->update($data_video_add);
                DB::commit();
                if ($video) {
                    return Response()->json([
                        'status' => 200,
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' Line: ' . $e->getLine());
            return Response()->json([
                'status' => 400,
                'Message' => 'Message: ' . $e->getMessage() . ' Line: ' . $e->getLine(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = $this->video->find($id);
        if (File::exists($video->image_path_video)) {
            File::delete($video->image_path_video);
        }
        return $this->deleteTraits($this->video, $id);
    }
}

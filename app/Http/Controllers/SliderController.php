<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Traits\deleteTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    use deleteTraits;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.Slider.index');
    }

    public function petchSlider()
    {
        $sliders = $this->slider->latest()->paginate(5);
        return Response()->json([
            'status' => 200,
            'sliders' => $sliders
        ]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'nameAdd' => 'required',
                'descriptionAdd' => 'required',
                'image_path_SiderAdd' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            ],
            [
                'nameAdd.required' => 'Name không được để trống.',
                'descriptionAdd.required' => 'Description không được để trống.',
                'image_path_SiderAdd.required' => 'Ảnh không được để trống.',
                'image_path_SiderAdd.image' => 'File add phải là một hình ảnh.',
                'image_path_SiderAdd.mimes' => 'File phải là một tệp có kiểu: jpeg, png, jpg, gif.',
            ]
        );
        if ($validator->fails()) {
            return Response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $dataSlider = [
                'name' => $request->nameAdd,
                'description' => $request->descriptionAdd,
                'active' => $request->statusAdd,
            ];
            if ($request->hasFile('image_path_SiderAdd')) {
                $file =  $request->file('image_path_SiderAdd');
                $imageName =  $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $imagePath = 'uploads/slider/' . Auth::user()->id . '/' . time() . '.' . $extension;
                $file->move('uploads/slider/' . Auth::user()->id, $imagePath);
                $dataSlider['image_name_Sider']  = Str::slug($imageName);
                $dataSlider['image_path_Sider']  = $imagePath;
                $this->slider->create($dataSlider);
            }
            return Response()->json([
                'status' => 200,
                'message' => 'Add slider success.'
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
        $slider = $this->slider->find($id);
        return Response()->json([
            'status' => 200,
            'slider' => $slider
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
        //dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'nameEdit' => 'required',
                'descriptionEdit' => 'required',
                'image_path_SiderAdd' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            ],
            [
                'nameEdit.required' => 'Name không được để trống.',
                'descriptionEdit.required' => 'Description không được để trống.',
                //'image_path_SiderAdd.required' => 'Ảnh không được để trống.',
                'image_path_SiderEdit.image' => 'File add phải là một hình ảnh.',
                'image_path_SiderEdit.mimes' => 'File phải là một tệp có kiểu: jpeg, png, jpg, gif.',
            ]
        );
        if ($validator->fails()) {
            return Response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $slider = $this->slider->find($id);
            $dataSlider = [
                'name' => $request->nameEdit,
                'description' => $request->descriptionEdit,
                'active' => $request->statusEdit,
            ];
            if ($request->hasFile('image_path_SiderEdit')) {
                if (File::exists($slider->image_path_Sider)) {
                    File::delete($slider->image_path_Sider);
                };
                $file =  $request->file('image_path_SiderEdit');
                $imageName =  $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $imagePath = 'uploads/product/' . Auth::user()->id . '/' . time() . '.' . $extension;
                $file->move('uploads/product/' . Auth::user()->id, $imagePath);
                $dataSlider['image_name_Sider']  = Str::slug($imageName);
                $dataSlider['image_path_Sider']  = $imagePath;
            }
            $slider->update($dataSlider);
            return Response()->json([
                'status' => 200,
                'message' => 'Edit slider success.'
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
        return $this->DeleteTraits($this->slider, $id);
    }
}

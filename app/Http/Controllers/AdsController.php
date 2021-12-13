<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Traits\deleteTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AdsController extends Controller
{
    use deleteTraits;
    private $ads;
    public function __construct(Ads $ads)
    {
        $this->ads = $ads;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        return view('admin.Ads.index');
    }

    public function fetchAds()
    {
        $adss = $this->ads->latest()->paginate(5);
        return Response()->json([
            'status' => 200,
            'adss' => $adss
        ], 200);
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
        //dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'nameAdsAdd' => 'required',
                'descriptionAdd' => 'required',
                'image_path_AdsAdd' => 'required',
            ],
            [
                'nameAdsAdd.required' => 'Name không được để trống',
                'descriptionAdd.required' => 'Description không được để trống',
                'image_path_AdsAdd.required' => 'Image không được để trống',
            ]
        );
        if ($validator->fails()) {
            return Response()->json([
                'status' => 500,
                'error' => $validator->errors()
            ]);
        } else {
            $dataAds = [
                'name' => $request['nameAdsAdd'],
                'description' => $request['descriptionAdd'],
                'active' => $request['statusAdsAdd'],
            ];
            if ($request->file('image_path_AdsAdd')) {
                $file = $request->file('image_path_AdsAdd');
                $nameImage = $file->getClientOriginalName();
                $extensionImage = $file->getClientOriginalExtension();
                $pathImage = 'uploads/ads/' . Auth()->id() . '/' . time() . '.' . $extensionImage;
                $file->move('uploads/ads/' . Auth()->id(), $pathImage);
                $dataAds['name_image_ads'] = $nameImage;
                $dataAds['path_image_ads'] = $pathImage;
            }
            $this->ads->create($dataAds);
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
        $ads = $this->ads->find($id);
        return Response()->json([
            'status' => 200,
            'ads' => $ads
        ], 200);
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
        $ads = $this->ads->find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'nameAdsEdit' => 'required',
                'descriptionEdit' => 'required',
            ],
            [
                'nameAdsEdit.required' => 'Name không được để trống',
                'descriptionEdit.required' => 'Description không được để trống',
            ]
        );
        if ($validator->fails()) {
            return Response()->json([
                'status' => 500,
                'error' => $validator->errors()
            ]);
        } else {
            $dataAds = [
                'name' => $request['nameAdsEdit'],
                'description' => $request['descriptionEdit'],
                'active' => $request['statusAdsEdit'],
            ];
            if ($request->file('image_path_AdsEdit')) {
                File::delete($ads->path_image_ads);
                $file = $request->file('image_path_AdsEdit');
                $nameImage = $file->getClientOriginalName();
                $extensionImage = $file->getClientOriginalExtension();
                $pathImage = 'uploads/ads/' . Auth()->id() . '/' . time() . '.' . $extensionImage;
                $file->move('uploads/ads/' . Auth()->id(), $pathImage);
                $dataAds['name_image_ads'] = $nameImage;
                $dataAds['path_image_ads'] = $pathImage;
            }
            $ads->update($dataAds);
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
        $ads = $this->ads->find($id);
        File::delete($ads->path_image_ads);
        return $this->deleteTraits($this->ads, $id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\deleteTraits;
use App\Components\Recusive;
use App\Models\Category;

class BrandController extends Controller
{
    use deleteTraits;
    public $brands;
    public $category;
    public function __construct(Brand $brands, Category $category)
    {
        $this->brands = $brands;
        $this->category = $category;
    }
    public function getCategory($parentId) //hàm lấy category cha con dùng chung cho create và edit
    {
        $Categories = $this->category->where('active', 1)->get();;
        $recusive = new Recusive($Categories); //khởi tạo class, code đệ lấy category phân cấp trong App\components
        $htmlOption = $recusive->categoryRecusive($parentId); //gọi chạy hàm đệ quy lấy category phân cấp
        return $htmlOption;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.Brands.index');
    }

    public function fetchBrands()
    {
        $brands = $this->brands->latest()->paginate(5);
        $htmlOption = $this->getCategory($parentId = '');
        return Response()->json([
            'status' => 200,
            'brands' => $brands,
            'htmlOption' => $htmlOption
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
                'statusAdd' => 'required',
                'category_idAdd' => 'required',
            ],
            [
                'nameAdd.required' => 'Name không được để trống',
                'descriptionAdd.required' => 'Description không được để trống',
                'statusAdd.required' => 'Status không được để trống',
                'category_idAdd.required' => 'Category không được để trống',
            ]
        );

        if ($validator->fails()) {
            return Response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $brand = $this->brands->create([
                'name' => $request['nameAdd'],
                'description' => $request['descriptionAdd'],
                'active' => $request['statusAdd'],
                'category_id' => $request['category_idAdd'],
            ]);
            return Response()->json([
                'status' => 200,
                'message' => 'Add success'
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
        $brand = $this->brands->find($id);
        return Response()->json([
            'status' => 200,
            'brand' => $brand
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = $this->brands->find($id);
        return Response()->json([
            'status' => 200,
            'brand' => $brand
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
        $validator = Validator::make(
            $request->all(),
            [
                'nameEdit' => 'required',
                'descriptionEdit' => 'required',
                'statusEdit' => 'required',
            ],
            [
                'nameEdit.required' => 'Name không được để trống',
                'descriptionEdit.required' => 'Description không được để trống',
                'statusEdit.required' => 'Status không được để trống',
            ]
        );
        if ($validator->fails()) {
            return Response()->json([
                'status' => 500,
                'message' => 'Fail'
            ]);
        } else {
            $brand = $this->brands->find($id)->update([
                'name' => $request['nameEdit'],
                'description' => $request['descriptionEdit'],
                'active' => $request['statusEdit'],
                'category_id' => $request['id_CategoryEdit'],
            ]);
            return Response()->json([
                'status' => 200,
                'message' => 'Edit success'
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
        $brand = $this->brands;
        return $this->DeleteTraits($brand, $id);
    }
}

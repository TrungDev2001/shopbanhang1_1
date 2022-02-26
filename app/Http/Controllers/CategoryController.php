<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Traits\deleteTraits;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Exports\ExportExcelCategory;
use App\Imports\ImportExcelCategory;


use Excel;



class CategoryController extends Controller
{

    use deleteTraits;
    private $category;
    public function __construct(Category $category)
    {
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
        $categorys = $this->category->latest()->paginate(5);
        $htmlOption = $this->getCategory($parentId = '');
        if ($request->ajax()) {
            $view = view('admin.Category.data', compact('categorys', 'htmlOption'))->render();
            return Response()->json(['html' => $view]);
        };
        return view('admin.Category.index', compact('categorys', 'htmlOption'));
    }

    public function activeCategory()
    {
        $htmlOptionAdd = $this->getCategory($parentId = '');
        return Response()->json([
            'htmlOptionAdd' => $htmlOptionAdd,
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
                'name' => 'Name không được để trống'
            ]);
        } else {
            $category = $this->category->create([
                'name' => $request['name'],
                'active' => $request['status'],
                'parent_id' => $request['parent'],
                'slug' => Str::slug($request['name'])
            ]);
            $categorys[] = $category;
            $viewCategoryAdd = view('admin.Category.data', compact('categorys'))->render();
            return Response()->json([
                'status' => 200,
                'viewCategoryAdd' => $viewCategoryAdd,
                'message' => 'Thêm danh mục thành công.'
            ]);
        };
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
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return Response()->json([
            'status' => 200,
            'category' => $category,
            'htmlOption' => $htmlOption,
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
            $category = $this->category->find($id);
            $category->update([
                'name' => $request['name'],
                'active' => $request['active'],
                'parent_id' => $request['prent'],
            ]);
            $categorys[] = $category;
            $viewCategoryEdit = view('admin.Category.data', compact('categorys'))->render();
            return Response()->json([
                'status' => 200,
                'viewCategoryEdit' => $viewCategoryEdit,
                'message' => 'Cập nhập thành công'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' Line: ' . $e->getLine());
            return Response()->json([
                'status' => 500,
                'message' => 'fail'
            ], 500);
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
        //$this->category->find($id)->delete();
        return $this->DeleteTraits($this->category, $id);
        // return Response()->json([
        //     'status' => 200,
        // ]);
    }



    public function ajaxNameCategory(Request $request, $id)
    {
        $nameajax = [
            'name' => $request['name'],
        ];
        $this->category->find($id)->update($nameajax);
        return Response()->json([
            'message' => 'Cập nhập name thành công'
        ]);
    }

    public function ajaxActiveCategory($id)
    {
        $category = $this->category->find($id);
        if ($category->active == 0) {
            $category->update(['active' => 1]);
        } else {
            $category->update(['active' => 0]);
        }

        $activeOn = "";
        if ($category->active == 0) {
            $activeOn .= "<i class='fa fa-circle-o'></i>";
        } else {
            $activeOn .= "<i class='fa fa-circle'></i>";
        };
        return Response()->json([
            'activeOn' => $activeOn,
            'active' => $category->active,
            'messageOn' => 'Hiện danh mục thành công',
            'messageOff' => 'Ẩn danh mục thành công',
        ]);
    }

    public function export_excel()
    {
        return Excel::download(new ExportExcelCategory, 'Category.xlsx');
    }

    public function import_excel(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportExcelCategory, $path);
        return back();
    }
}

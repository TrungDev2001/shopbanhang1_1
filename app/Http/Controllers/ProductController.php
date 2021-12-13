<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Components\Recusive;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Traits\deleteTraits;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use deleteTraits;
    private $brand;
    private $category;
    private $tag;
    private $product;
    private $productImage;
    public function __construct(Brand $brand, Category $category, Tag $tag, Product $product, ProductImage $productImage)
    {
        $this->brand = $brand;
        $this->category = $category;
        $this->tag = $tag;
        $this->product = $product;
        $this->productImage = $productImage;
    }

    public function getCategory($parentId) //hàm lấy category cha con dùng chung cho create và edit
    {
        $Categories = $this->category->where('active', 1)->get();
        $recusive = new Recusive($Categories); //khởi tạo class, code đệ lấy category phân cấp trong App\components
        $htmlOption = $recusive->categoryRecusive($parentId); //gọi chạy hàm đệ quy lấy category phân cấp
        return $htmlOption;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $htmlOption = $this->getCategory($parentId = '');
        $brands = $this->brand->where('active', 0)->get();
        return view('admin.Product.index', compact('brands', 'htmlOption'));
    }

    public function fetchProduct()
    {
        $products = $this->product->latest()->paginate(5);
        $html = '';
        foreach ($products as $product) {
            $html .= '
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>' . $product->name . '</td>
                    <td>' . number_format($product->price, 0, ',', '.') . 'đ</td>';
            if ($product->active == 0) {
                $html .= '<td data-url="" id="" class=""><i class="fa fa-circle"></i></td>';
            } else {
                $html .= '<td data-url="" id="" class=""><i class="fa fa-circle-o"></i></td>';
            }
            $html .= '
                    <td><img style="height: 100px; object-fit: cover;" class="file-upload" src="' . $product->feature_image_path . '" alt=""></td>\
                    <td>' . $product->quantity_product . '</td>
                    <td>' . $product->quantity_sold . '</td>
                    <td>' . $product->categorys->name . '</td>
                    <td>' . $product->brands->name . '</td>
                    <td>' . date_format($product->created_at, "d-m-Y") . '</td>
                    <td>
                        <a href="' . url("products/edit_cover/$product->id") . '"><button type="button">Edit</button></a>
                        <button type="button"><i data-url="products/delete/' . $product->id . '" class="fa fa-times text-danger text delete-sweetalert"></i></button>
                    </td>
                </tr>
            ';
        }
        return Response()->json([
            'status' => 200,
            'html' => $html
        ]);
        // return Response()->json([
        //     'status' => 200,
        //     'products' => $products
        // ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        $brands = $this->brand->where('active', 0)->get();
        $tags = $this->tag->get();
        return view('admin.Product.create', compact('brands', 'htmlOption', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->tagsProductAdd);
        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'nameAdd' => 'required',
                    'priceAdd' => 'required',
                    'descriptionAdd' => 'required',
                    'statusAdd' => 'required',
                    'image_AvatarAdd' => 'required|image|mimes:jpg,png,gif,jpeg|max:10240',
                    'image_DetailAdd' => 'required',
                    'contentAdd' => 'required',
                    'tagsProductAdd' => 'required',
                    'id_CategoryAdd' => 'required',
                    'Category_brandsAdd' => 'required',
                ],
                [
                    'nameAdd.required' => 'Name không được để trống',
                    'priceAdd.required' => 'Price không được để trống',
                    'descriptionAdd.required' => 'Description không được để trống',
                    'statusAdd.required' => 'Status không được để trống',
                    'image_AvatarAdd.required' => 'Image avatar không được để trống',
                    'image_DetailAdd.required' => 'Image detail không được để trống',
                    'contentAdd.required' => 'Content không được để trống',
                    'tagsProductAdd.required' => 'Tag không được để trống',
                    'id_CategoryAdd.required' => 'Category không được để trống',
                    'Category_brandsAdd.required' => 'Brand không được để trống',
                ]
            );
            if ($validator->fails()) {
                return Response()->json([
                    'status' => 500,
                    'errors' => $validator->errors()
                ]);
            } else {
                $dataform = [
                    'name' => $request['nameAdd'],
                    'slug' => $request['slugAdd'],
                    'price' => $request['priceAdd'],
                    'quantity_product' => $request['quantityProductAdd'],
                    'description' => $request['descriptionAdd'],
                    'active' => $request['statusAdd'],
                    'product_status' => $request['statusProductAdd'],
                    'user_id' => Auth()->id(),
                    'content' => $request['contentAdd'],
                    'category_id' => $request['id_CategoryAdd'],
                    'brand_id' => $request['Category_brandsAdd'],
                ];
                if ($request->hasFile('image_AvatarAdd')) {
                    $fileAvatar = $request->file('image_AvatarAdd');
                    $nameAvatar = $fileAvatar->getClientOriginalName();
                    $extention = $fileAvatar->getClientOriginalExtension();
                    $pathAvatar = 'uploads/product/' . Auth()->id() . '/' . time() . '.' . $extention;
                    $fileAvatar->move('uploads/product/' . Auth()->id(), $pathAvatar);
                    $dataform['feature_image_name'] = Str::slug($nameAvatar);
                    $dataform['feature_image_path'] = $pathAvatar;
                }
                $product = $this->product->create($dataform);
                if ($request->hasFile('image_DetailAdd')) {
                    foreach ($request->image_DetailAdd as $item_ImageDetail) {
                        $nameImageDetail = $item_ImageDetail->getClientOriginalName();
                        $extention1 = $item_ImageDetail->getClientOriginalExtension();
                        $pathImageDetail = 'uploads/product/' . Auth()->id() . '/' . time() . Str::random(2) . '.' . $extention1;
                        $item_ImageDetail->move('uploads/product/' . Auth()->id(), $pathImageDetail);
                        $product->ProductImages()->create([
                            'product_ImagesDetail_name' => Str::slug($nameImageDetail),
                            'product_ImagesDetail_path' => $pathImageDetail
                        ]);
                    }
                }
                if ($request->tagsProductAdd) {
                    foreach ($request->tagsProductAdd as $itemTag) {
                        $tag = $this->tag->firstOrCreate([
                            'name' => $itemTag
                        ]);
                        $tagId[] = $tag->id;
                    }
                }
                $product->tags()->attach($tagId);
                session()->put('ProductAddSuccess', 'Add product success');
                DB::commit();

                return redirect()->route('products.index');
                // return Response()->json([

                //     'status' => 200,
                //     'message' => 'Add product success'
                // ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' Line: ' . $e->getLine());
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

        $product = $this->product->find($id);
        $imageDetail = $product->ProductImages;
        $tags = $product->tags;

        $htmlImage = '';
        $htmltags = '';
        foreach ($imageDetail as $imageItem) {
            $htmlImage .= '<img class="detailImage" src="' . $imageItem->product_ImagesDetail_path . '" alt="">';
        }
        foreach ($tags as $tag) {
            $htmltags .= '<option selected value="' . $tag->name . '">' . $tag->name . '</option>';
        }
        return Response()->json([
            'status' => 200,
            'product' => $product,
            'htmlImage' => $htmlImage,
            'htmltags' => $htmltags,
        ]);
    }
    public function edit_cover($id, Request $request)
    {
        $brands = $this->brand->where('active', 0)->get();
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        $imageDetails = $product->ProductImages->sortBy('position');
        if ($request->ajax()) {
            $htmlImage = view('admin.Product.editImageAjax.editImageAjax', compact('imageDetails', 'product'))->render();
            return Response()->json([
                'status' => 200,
                'htmlImage' => $htmlImage,
            ]);
        }
        // dd($imageDetails);
        $tagsProductEdit = $product->tags;
        foreach ($tagsProductEdit as $tagProductEdit) {
            $tagProductEdit_id[] = $tagProductEdit->id;
        }
        $tags = $this->tag->whereNotIn('id', $tagProductEdit_id)->get();
        return view('admin.Product.edit_cover', compact('brands', 'htmlOption', 'product', 'imageDetails', 'tagsProductEdit', 'tags'));
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
            $product = $this->product->find($id);

            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'nameEdit' => 'required',
                    'priceEdit' => 'required',
                    'descriptionEdit' => 'required',
                    'statusEdit' => 'required',
                    //'image_AvatarEdit' => 'required|image|mimes:jpg,png,gif,jpeg|max:10240',
                    //'image_DetailEdit' => 'required',
                    'contentEdit' => 'required',
                    'tagsProductEdit' => 'required',
                    'id_CategoryEdit' => 'required',
                    'Category_brandsEdit' => 'required',
                ],
                [
                    'nameEdit.required' => 'Name không được để trống',
                    'priceEdit.required' => 'Price không được để trống',
                    'descriptionEdit.required' => 'Description không được để trống',
                    'statusEdit.required' => 'Status không được để trống',
                    //'image_AvatarEdit.required' => 'Image avatar không được để trống',
                    //'image_DetailEdit.required' => 'Image detail không được để trống',
                    'contentEdit.required' => 'Content không được để trống',
                    'tagsProductEdit.required' => 'Tag không được để trống',
                    'id_CategoryEdit.required' => 'Category không được để trống',
                    'Category_brandsEdit.required' => 'Brand không được để trống',
                ]
            );
            if ($validator->fails()) {
                return Response()->json([
                    'status' => 500,
                    'errors' => $validator->errors()
                ]);
            } else {
                $dataform = [
                    'name' => $request['nameEdit'],
                    'price' => $request['priceEdit'],
                    'description' => $request['descriptionEdit'],
                    'active' => $request['statusEdit'],
                    'user_id' => Auth()->id(),
                    'content' => $request['contentEdit'],
                    'category_id' => $request['id_CategoryEdit'],
                    'brand_id' => $request['Category_brandsEdit'],
                ];

                if ($request->hasFile('image_AvatarEdit')) {
                    //xoa ảnh trong file
                    if (File::exists($product->feature_image_path)) {
                        File::delete($product->feature_image_path);
                    };
                    $fileAvatar = $request->file('image_AvatarEdit');
                    $nameAvatar = $fileAvatar->getClientOriginalName();
                    $extention = $fileAvatar->getClientOriginalExtension();
                    $pathAvatar = 'uploads/product/' . Auth()->id() . '/' . time() . '.' . $extention;
                    $fileAvatar->move('uploads/product/' . Auth()->id(), $pathAvatar);
                    $dataform['feature_image_name'] = Str::slug($nameAvatar);
                    $dataform['feature_image_path'] = $pathAvatar;
                }
                $product->update($dataform);

                if ($request->hasFile('image_DetailEdit')) {
                    //xoa ảnh trong file
                    $image = $product->ProductImages;
                    foreach ($image as $img) {
                        File::delete($img->product_ImagesDetail_path);
                    };
                    //xóa path ảnh trong database 
                    $product->ProductImages()->delete();
                    foreach ($request->image_DetailEdit as $item_ImageDetai) {
                        $nameImage = $item_ImageDetai->getClientOriginalName();
                        $extention1 = $item_ImageDetai->getClientOriginalExtension();
                        $pathImage = 'uploads/product/' . Auth()->id() . '/' . time() . Str::random(3) . '.' . $extention1;
                        $item_ImageDetai->move('uploads/product/' . Auth()->id(), $pathImage);
                        $product->ProductImages()->create([
                            'product_ImagesDetail_name' => Str::slug($nameImage),
                            'product_ImagesDetail_path' => $pathImage
                        ]);
                    }
                }
                if ($request->tagsProductEdit) {
                    foreach ($request->tagsProductEdit as $itemTag) {
                        $tag = $this->tag->firstOrCreate([
                            'name' => $itemTag
                        ]);
                        $tagId[] = $tag->id;
                    }
                }
                $product->tags()->sync($tagId);
                DB::commit();
                return Response()->json([
                    'status' => 200,
                    'message' => 'Edit product success'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' Line: ' . $e->getLine());
        };
    }

    public function update_cover(Request $request, $id)
    {
        // dd($request->all());
        $product = $this->product->find($id);
        $data_update_product = [
            'name' => $request->nameEdit,
            'price' => $request->priceEdit,
            'slug' => $request->slugEdit,
            'description' => $request->descriptionEdit,
            'content' => $request->contentEdit,
            'quantity_product' => $request->quantityProductEdit,
            'product_status' => $request->statusProductEdit,
            'active' => $request->statusEdit,
            'user_id' => Auth()->id(),
            'category_id' => $request->id_CategoryEdit,
            'brand_id' => $request->brandsEdit,
        ];
        if ($request->hasFile('image_AvatarEdit')) {
            if (File::exists($product->feature_image_path)) {
                File::delete($product->feature_image_path);
            }
            $fileAvatar = $request->file('image_AvatarEdit');
            $imageName = $fileAvatar->getClientOriginalName();
            $extention = $fileAvatar->getClientOriginalExtension();
            $imagePath = 'uploads/product/' . Auth()->id() . '/' . time() . '.' . $extention;
            $fileAvatar->move('uploads/product/' . Auth()->id(), $imagePath);
            $data_update_product['feature_image_name'] = substr(Str::slug($imageName), 0, -3);
            $data_update_product['feature_image_path'] = $imagePath;
        }
        if ($request->tagsProductEdit) {
            // dd($request->tagsProductEdit);
            foreach ($request->tagsProductEdit as $tagProductEdit_item) {
                $tags = $this->tag->firstOrCreate([
                    'name' => $tagProductEdit_item
                ]);
                $tagsId[] =  $tags->id;
            }
            $product->tags()->sync($tagsId);
        }
        $product->update($data_update_product);
        session()->put('editSuccess', 'Edit product success');
        return redirect()->route('products.index');
    }
    public function updateImageDetail(Request $request)
    {
        if ($request->order) {
            foreach ($request->order as $productImage_item) {
                $productImage = $this->productImage->where('id', $productImage_item['id'])->update([
                    'position' => $productImage_item['position'],
                ]);
            }
            return Response()->json([
                'status' => 200,
                'message' => 'Edit image detail seccess',
            ]);
        }
        // elseif($request->file){

        // }
    }
    public function addImageDetail($id, Request $request)
    {
        $productImage = $this->productImage->where('product_id', $id);
        if ($request->hasFile('addImageDetaill')) {
            foreach ($request->addImageDetaill as $addImageDetaill_item) {
                $image_name = $addImageDetaill_item->getClientOriginalName();
                $extention = $addImageDetaill_item->getClientOriginalExtension();
                $image_path = 'uploads/product/' . Auth()->id() . '/' . time() . Str::random(3) . '.' . $extention;
                $addImageDetaill_item->move('uploads/product/' . Auth()->id(), $image_path);
                $imageDetails = $this->productImage->create([
                    'product_ImagesDetail_name' => substr(Str::slug($image_name), 0, -3),
                    'product_ImagesDetail_path' => $image_path,
                    'product_id' => $id,
                    'position' => $productImage->max('position') + 1,
                ]);
            }
            return Response()->json([
                'status' => 200,
                'imageDetails' => $imageDetails,
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
        $product = $this->product->find($id);
        foreach ($product->ProductImages as $item) {
            File::delete($item->product_ImagesDetail_path);
        }
        File::delete($product->feature_image_path);
        $product->ProductImages()->delete();
        $product->tags()->detach();
        return $this->deleteTraits($this->product, $id);
    }
    public function destroyImageDetail($id)
    {
        $imageDetail = $this->productImage->find($id);
        if ($imageDetail) {
            File::delete($imageDetail->product_ImagesDetail_path);
        }
        return $this->deleteTraits($this->productImage, $id);
    }

    public function categoryBrands(Request $request)
    {
        $value = key($request->all());
        $brands = $this->brand->where('active', 0)->where('category_id', $value)->get();
        foreach ($brands as $brand) {
            echo '<option value=" ' . $brand->id . '">' . $brand->name . '</option>';
        }
    }
}

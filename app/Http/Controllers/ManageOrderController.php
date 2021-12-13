<?php

namespace App\Http\Controllers;

use App\Models\Oder;
use App\Models\OderDetail;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ManageOrderController extends Controller
{

    private $oder;
    private $product;
    private $oderDetail;
    public function __construct(Oder $oder, Product $product, OderDetail $oderDetail)
    {
        $this->oder = $oder;
        $this->product = $product;
        $this->oderDetail = $oderDetail;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oders = $this->oder->latest()->paginate(5);
        return view('admin.ManageOrder.index', compact('oders'));
    }
    public function petchDataOder()
    {
        $oders = $this->oder->latest()->paginate(5);
        $viewOderIndexHtml = view('admin.ManageOrder.component.index', compact('oders'))->render();
        return Response()->json([
            'status' => 200,
            'oder' => $oders,
            'viewOderIndexHtml' => $viewOderIndexHtml,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $oder = $this->oder->find($id);
        $userKH = User::find($oder->user_id);
        $oder_detail = $oder->oder_detail;
        foreach ($oder_detail as $itemOd) {
            $oder_detail_product[] = $this->product->find($itemOd->product_id);
        }
        $address = $oder->sonha . ', ' .  $oder->XaPhuong->name . ', ' . $oder->QuanHuyen->name . ', ' . $oder->ThanhPho->name;

        $nameVoucher = 0;
        $priceVoucher = 0;


        if ($oder->Voucher) {
            $nameVoucher = $oder->Voucher->name;
            if ($oder->Voucher->tpye == 0) {
                $priceVoucher = $oder->total_price * $oder->Voucher->number / 100;
            } else {
                $priceVoucher = $oder->Voucher->number;
            }
        }

        // echo "<pre>";
        // print_r($oder_detail_product);

        return Response()->json([
            'oder' => $oder,
            'userKH' => $userKH,
            'address' => $address,
            'oder_detail' => $oder_detail,
            'oder_detail_product' => $oder_detail_product,
            'nameVoucher' => $nameVoucher,
            'priceVoucher' => $priceVoucher,
        ]);
    }

    public function print($id)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_oder_html($id));
        return $pdf->stream();
    }
    public function print_oder_html($id)
    {
        $oder = $this->oder->find($id);
        $userKH = User::find($oder->user_id);
        $oder_detail = $oder->oder_detail;
        $address = $oder->sonha . ', ' .  $oder->XaPhuong->name . ', ' . $oder->QuanHuyen->name . ', ' . $oder->ThanhPho->name;

        $nameVoucher = 'No';
        $priceVoucher = 0;
        if (isset($oder->Voucher)) {
            $nameVoucher = $oder->Voucher->name;
            if ($oder->Voucher->tpye == 0) {
                $priceVoucher = $oder->total_price * $oder->Voucher->number / 100;
            } else {
                $priceVoucher = $oder->Voucher->number;
            }
        }
        return view('admin.ManageOrder.component.print', compact('oder', 'userKH', 'oder_detail', 'address', 'priceVoucher', 'nameVoucher'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $oder = $this->oder->find($id);

        if ($oder) {
            $oder_details = $this->oderDetail->whereIn('oder_id', [$id])->get();
            if ($request->statusOder == 3) {
                foreach ($oder_details as $oder_detail) {
                    $quantity = $oder_detail->quantity;
                    $product = $this->product->find($oder_detail->product_id);
                    $product->update([
                        'quantity_sold' => $product->quantity_sold + $quantity,
                        'quantity_product' => $product->quantity_product - $quantity,
                    ]);
                }
            } elseif ($request->statusOder == 0 && $oder->active == 3) {
                foreach ($oder_details as $oder_detail) {
                    $quantity = $oder_detail->quantity;
                    $product = $this->product->find($oder_detail->product_id);
                    $product->update([
                        'quantity_sold' => $product->quantity_sold - $quantity,
                        'quantity_product' => $product->quantity_product + $quantity,
                    ]);
                }
            } elseif ($request->statusOder == 1 && $oder->active == 3) {
                foreach ($oder_details as $oder_detail) {
                    $quantity = $oder_detail->quantity;
                    $product = $this->product->find($oder_detail->product_id);
                    $product->update([
                        'quantity_sold' => $product->quantity_sold - $quantity,
                        'quantity_product' => $product->quantity_product + $quantity,
                    ]);
                }
            } elseif ($request->statusOder == 2 && $oder->active == 3) {
                foreach ($oder_details as $oder_detail) {
                    $quantity = $oder_detail->quantity;
                    $product = $this->product->find($oder_detail->product_id);
                    $product->update([
                        'quantity_sold' => $product->quantity_sold - $quantity,
                        'quantity_product' => $product->quantity_product + $quantity,
                    ]);
                }
            } elseif ($request->statusOder == 4 && $oder->active == 3) {
                foreach ($oder_details as $oder_detail) {
                    $quantity = $oder_detail->quantity;
                    $product = $this->product->find($oder_detail->product_id);
                    $product->update([
                        'quantity_sold' => $product->quantity_sold - $quantity,
                        'quantity_product' => $product->quantity_product + $quantity,
                    ]);
                }
            } elseif ($request->statusOder == 5 && $oder->active == 3) {
                foreach ($oder_details as $oder_detail) {
                    $quantity = $oder_detail->quantity;
                    $product = $this->product->find($oder_detail->product_id);
                    $product->update([
                        'quantity_sold' => $product->quantity_sold - $quantity,
                        'quantity_product' => $product->quantity_product + $quantity,
                    ]);
                }
            }
            $oder->update([
                'active' => $request->statusOder,
            ]);
            return Response()->json([
                'status' => 200,

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
        //
    }
}

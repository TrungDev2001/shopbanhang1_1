<?php

namespace App\Http\Controllers;

use App\Models\Oder;
use App\Models\OderDetail;
use App\Models\Product;
use App\Models\Statistics;
use App\Models\Voucher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ManageOrderController extends Controller
{

    private $oder;
    private $product;
    private $oderDetail;
    private $statistics;
    private $voucher;
    public function __construct(Oder $oder, Product $product, OderDetail $oderDetail, Statistics $statistics, Voucher $voucher)
    {
        $this->oder = $oder;
        $this->product = $product;
        $this->oderDetail = $oderDetail;
        $this->statistics = $statistics;
        $this->voucher = $voucher;
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

            if ($oder->Voucher->type == 0) {
                $nameVoucher = $oder->Voucher->name . ' "Mã giảm giá ' . $oder->Voucher->number . '%"';
                if ($oder->Voucher->numberMax > 0) {
                    $nameVoucher = $oder->Voucher->name . ' "Mã giảm giá ' . $oder->Voucher->number . '% tối đa ' . number_format($oder->Voucher->numberMax, 0, ',', '.') . 'đ"';
                    $priceVoucher = $oder->Voucher->numberMax;
                } else {
                    $priceVoucher = $oder->total_price * $oder->Voucher->number / 100;
                }
            } else {
                $nameVoucher = $oder->Voucher->name . ' "Mã giảm giá ' . number_format($oder->Voucher->number, 0, ',', '.') . 'đ"';
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
        $oder_quantity = 0;
        $sales = 0;
        $profit = 0;
        $price_voucher = 0;
        if ($oder) {
            $oder_details = $this->oderDetail->whereIn('oder_id', [$id])->get();
            $voucher = $this->voucher->find($oder->coupon_id);
            if ($voucher->type == 0) {
                $price_voucher = $oder->total_price * ($voucher->number / 100);
            } else {
                $price_voucher = $voucher->number;
            }
            $sales -= $price_voucher;
            $sales += $oder->priceShip;

            if ($request->statusOder == 3) {
                foreach ($oder_details as $oder_detail) {
                    //cập nhập lại số kho và số lượng đã bán
                    $quantity = $oder_detail->quantity;
                    $product = $this->product->find($oder_detail->product_id);
                    $product->update([
                        'quantity_sold' => $product->quantity_sold + $quantity,
                        'quantity_product' => $product->quantity_product - $quantity,
                    ]);
                    //thống kê doanh thu
                    $oder_quantity += 1;
                    $sales += ($oder_detail->price * $oder_detail->quantity);
                    $profit += $oder_detail->product->original_price;
                }

                $date_day_statistic = $oder->created_at->format('Y-m-d');

                $data_statistic_create = [
                    'oder_quantity' => $oder_quantity,
                    'sales' => $sales,
                    'profit' => $sales - $profit,
                    'date_day_statistic' => $date_day_statistic,
                ];
                $statistic = $this->statistics->where('date_day_statistic', $date_day_statistic)->first();
                if ($statistic == null) {
                    $this->statistics->create($data_statistic_create);
                } else {
                    $data_statistic_update = [
                        'oder_quantity' => $statistic->oder_quantity + $oder_quantity,
                        'sales' => $statistic->sales + $sales,
                        'profit' => $statistic->profit + $sales - $profit,
                    ];
                    $statistic->update($data_statistic_update);
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

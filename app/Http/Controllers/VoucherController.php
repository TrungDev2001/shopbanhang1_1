<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VoucherValidator;
use App\Http\Requests\VoucherValidatorUpdate;
use App\Models\Voucher;
use Illuminate\Support\Facades\Validator;
use App\Traits\deleteTraits;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VoucherController extends Controller
{
    use deleteTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $voucher;
    private $now;
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
        $this->now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');;
    }

    public function index()
    {
        return view('admin.Voucher.index');
    }

    public function petchDataVoucher()
    {
        $vouchers = $this->voucher->latest()->paginate(5);
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $html_dataVoucher = view('admin.Voucher.components.data', compact('vouchers', 'now'))->render();
        return Response()->json([
            'code' => 200,
            'html_dataVoucher' => $html_dataVoucher,
        ], 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherValidator $request)
    {
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'nameVoucher' => 'required',
        //         'codeVoucher' => 'required',
        //         'typeVoucher' => 'required',
        //         'numberVoucher' => 'required',
        //         'quantityVoucher' => 'required',
        //         'dateStartVoucher' => 'required',
        //         'dateEndVoucher' => 'required',
        //         'quantity_use_user_Voucher' => 'required',
        //     ],
        //     [
        //         'nameVoucher.required' => 'Không được để trống',
        //         'codeVoucher.required' => 'Không được để trống',
        //         'typeVoucher.required' => 'Không được để trống',
        //         'numberVoucher.required' => 'Không được để trống',
        //         'quantityVoucher.required' => 'Không được để trống',
        //         'dateStartVoucher.required' => 'Không được để trống',
        //         'dateEndVoucher.required' => 'Không được để trống',
        //         'quantity_use_user_Voucher.required' => 'Không được để trống',
        //     ]
        // );
        // if ($validator->fails()) {
        //     return Response()->json([
        //         'code' => 401,
        //         'errors' => $validator->errors(),
        //     ]);
        // } else {
        $insertVoucher = [
            'name' => $request['nameVoucher'],
            'description' => $request['descriptionVoucher'],
            'code' => $request['codeVoucher'],
            'type' => $request['typeVoucher'],
            'number' => filter_var($request->numberVoucher, FILTER_SANITIZE_NUMBER_INT),
            'numberMax' => filter_var($request->numberMaxVoucher, FILTER_SANITIZE_NUMBER_INT),
            'quantity' => $request['quantityVoucher'],
            'date_start' => $request['dateStartVoucher'],
            'date_end' => $request['dateEndVoucher'],
            'quantity_use_of_user' => $request['quantity_use_user_Voucher'],
            'status' => $request['statusVoucher'],
        ];
        $vouchers[] = $this->voucher->create($insertVoucher);
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $html_dataVoucher = view('admin.Voucher.components.data', compact('vouchers', 'now'))->render();
        return Response()->json([
            'code' => 200,
            'VoucherNew' => $html_dataVoucher,
        ], 200);
        //}
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
        $voucher = $this->voucher->find($id);
        return Response()->json([
            'status' => 200,
            'voucher' => $voucher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoucherValidatorUpdate $request, $id)
    {
        $insertVoucher = [
            'name' => $request['nameVoucher'],
            'description' => $request['descriptionVoucher'],
            'code' => $request['codeVoucher'],
            'type' => $request['typeVoucher'],
            'number' => filter_var($request->numberVoucher, FILTER_SANITIZE_NUMBER_INT),
            'numberMax' => filter_var($request->numberMaxVoucher, FILTER_SANITIZE_NUMBER_INT),
            'quantity' => $request['quantityVoucher'],
            'date_start' => $request['dateStartVoucher'],
            'date_end' => $request['dateEndVoucher'],
            'quantity_use_of_user' => $request['quantity_use_user_Voucher'],
            'status' => $request['statusVoucher'],
        ];
        $voucher = $this->voucher->find($id);
        $voucher->update($insertVoucher);
        $vouchers[] = $voucher;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $html_dataVoucher = view('admin.Voucher.components.data', compact('vouchers', 'now'))->render();
        return Response()->json([
            'status' => 200,
            'VoucherNew' => $html_dataVoucher,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->DeleteTraits($this->voucher, $id);
    }

    public function send_gift_kh_vip($voucher_id, Request $request)
    {
        // try {
        $voucher = $this->voucher->find($voucher_id);
        if ($request->type == 'KHvip') {
            $users = User::where('count_buy', '>', 0)->get();
        } else {
            $users = User::where('count_buy', 0)->get();
        }
        foreach ($users as $user) {
            $to_emails[] = $user->email;
        }
        $from_name = "Shop TrungBui " . $this->now;
        $from_email = "nobita9cs6vk@gmail.com"; //gửi từ email
        // $to_email = Auth::user()->email; //gủi đến email người dùng

        $content_email = [
            'name' => 'Đặt hàng thành công.',
            'body' => 'Cảm ơn bạn đã mua hàng.'
        ];
        Mail::send('admin.Voucher.components.sent_email', compact('content_email', 'voucher'), function ($message) use ($from_name, $from_email, $to_emails) { //view, array, function
            $message->to($to_emails)->subject($from_name); //gửi đến email với tiêu đề chính
            $message->from($from_email, $from_name); //gửi từ
        });
        return Response()->json([
            'status' => 200,
        ]);
        //https://www.youtube.com/watch?v=eTmiJLIrGRQ&t=548s
        // } catch (\Exception $e) {
        //     Log::error('Message: ' . $e->getMessage() . ' Line: ' . $e->getLine());
        //     return Response()->json([
        //         'status' => 500,
        //     ]);
        // }
    }

    public function test()
    {
        $voucher = $this->voucher->find(26);
        return view('admin.Voucher.components.sent_email', compact('voucher'));
    }
}

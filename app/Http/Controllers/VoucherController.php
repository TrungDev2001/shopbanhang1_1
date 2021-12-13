<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VoucherValidator;
use App\Models\Voucher;
use Illuminate\Support\Facades\Validator;
use App\Traits\deleteTraits;

class VoucherController extends Controller
{
    use deleteTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $voucher;
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function index()
    {
        return view('admin.Voucher.index');
    }

    public function petchDataVoucher()
    {
        $vouchers = $this->voucher->latest()->paginate(5);
        return Response()->json([
            'code' => 200,
            'vouchers' => $vouchers,
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
        $insertVoucher = [
            'name' => $request['nameVoucher'],
            'code' => $request['codeVoucher'],
            'type' => $request['typeVoucher'],
            'number' => $request['numberVoucher'],
            'quantity' => $request['quantityVoucher'],
        ];
        $VoucherNew = $this->voucher->create($insertVoucher);
        return Response()->json([
            'code' => 200,
            'VoucherNew' => $VoucherNew,
        ], 200);
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'nameVoucher' => 'required',
        //         'codeVoucher' => 'required',
        //         'typeVoucher' => 'required',
        //         'numberVoucher' => 'required',
        //     ],
        //     [
        //         'nameVoucher.required' => 'Không được để trống',
        //         'codeVoucher.required' => 'Không được để trống',
        //         'typeVoucher.required' => 'Không được để trống',
        //         'numberVoucher.required' => 'Không được để trống',
        //     ]
        // );
        // if ($validator->fails()) {
        //     return Response()->json([
        //         'code' => 422,
        //         'errors' => $validator->errors(),
        //     ]);
        // }
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
        //
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

    public function thuchanh()
    {
        return view('admin.Voucher.thuchanhLTW');
    }
}

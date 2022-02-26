<?php

namespace App\Http\Controllers;

use App\Models\QuanHuyen;
use App\Models\ThanhPho;
use App\Models\TransportFee;
use App\Models\XaPhuong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\deleteTraits;

class Transport_feeController extends Controller
{
    use deleteTraits;
    private $thanhPho;
    private $quanHuyen;
    private $xaPhuong;
    private $transportFee;
    public function __construct(ThanhPho $thanhPho, QuanHuyen $quanHuyen, XaPhuong $xaPhuong, TransportFee $transportFee)
    {
        $this->thanhPho = $thanhPho;
        $this->quanHuyen = $quanHuyen;
        $this->xaPhuong = $xaPhuong;
        $this->transportFee = $transportFee;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thanhPhos = $this->thanhPho->get();
        return view('admin.Transport_fee.index', compact('thanhPhos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->type == 'tp') {
            $data = $this->quanHuyen->where('matp', $request->matp)->get();
        } else {
            $data = $this->xaPhuong->where('maqh', $request->maqh)->get();
        }
        return Response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
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
                'thanhpho' => 'required',
                'quanhuyen' => 'required',
                'xaphuong' => 'required|unique:transport_fees',
                'numberTransportFree' => 'required',
            ],
            [
                'thanhpho.required' => 'Thành phố không được đế trống',
                'quanhuyen.required' => 'Quận huyện không được đế trống',
                'xaphuong.required' => 'Xã phường không được đế trống',
                'xaphuong.unique' => 'Xã phường không được trùng nhau',
                'numberTransportFree.required' => 'Phí vận chuyển không được đế trống',
            ]
        );
        if ($validator->fails()) {
            return Response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 200);
        } else {
            $data = [
                'thanhpho' => $request->thanhpho,
                'quanhuyen' => $request->quanhuyen,
                'xaphuong' => $request->xaphuong,
                'phivanchuyen' => $request->numberTransportFree,
            ];
            $this->transportFee->create($data);
        }
    }
    public function petchDataTransportFee()
    {
        $transportFees = $this->transportFee->latest()->paginate(5);
        $viewDataTransportFee = view('admin.Transport_fee.component.data', compact('transportFees'))->render();

        return Response()->json([
            'status' => 200,
            'viewDataTransportFee' => $viewDataTransportFee,
        ], 200);
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
        $dataUpdate = [
            'phivanchuyen' => $request->PriceShip,
        ];
        $this->transportFee->find($id)->update($dataUpdate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->DeleteTraits($this->transportFee, $id);
    }
}

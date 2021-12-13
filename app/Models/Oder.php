<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Oder extends Model
{
    protected $guarded = [];
    public function oder_detail()
    {
        return $this->HasMany(OderDetail::class, 'oder_id');
    }

    public function Voucher()
    {
        return $this->belongsTo(Voucher::class, 'coupon_id');
    }

    public function ThanhPho()
    {
        return $this->belongsTo(ThanhPho::class, 'thanhpho');
    }
    public function QuanHuyen()
    {
        return $this->belongsTo(QuanHuyen::class, 'quanhuyen');
    }
    public function XaPhuong()
    {
        return $this->belongsTo(XaPhuong::class, 'xaphuong');
    }
}

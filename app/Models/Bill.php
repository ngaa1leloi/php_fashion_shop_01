<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'bills';

    protected $fillable = [
        'user_id',
        'note',
        'total_amount',
        'method_of_payment',
    ];

    public function billProducts()
    {
        return $this->hasMany(BillProduct::class);
    }

    public function billStatus()
    {
        return $this->hasMany(BillStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

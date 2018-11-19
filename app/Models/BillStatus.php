<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillStatus extends Model
{
    protected $table = 'bill_status';

    protected $fillable = [
        'bill_id',
        'user_id',
        'status_id',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}

<?php

namespace Shultzer\RupeebizCcavenue\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
      'order_id',
      'currency',
      'amount'
    ];

    public function user (  ) {
        return $this->belongsTo('App\User');
    }
}

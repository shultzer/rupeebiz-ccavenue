<?php

namespace Shultzer\RupeebizCcavenue\Models;

use Illuminate\Database\Eloquent\Model;

class Mobiletransaction extends Model
{
    protected $fillable = [
      'order_id',
      'currency',
      'amount',
      'mn'
    ];
    public function users (  ) {
        return $this->belongsTo('App\User');
    }
}

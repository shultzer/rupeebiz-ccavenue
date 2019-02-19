<?php

namespace Shultzer\RupeebizCcavenue\Models;

use Illuminate\Database\Eloquent\Model;

class Dthtransaction extends Model
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

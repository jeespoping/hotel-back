<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_id', 'amount', 'type', 'accommodation'];

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }
}

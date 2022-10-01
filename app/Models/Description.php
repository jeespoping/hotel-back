<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;

class Description extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_id', 'amount', 'type', 'accommodation'];

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function diffValidatedroom($num, $hotel){
        $numH = intval($this->where('hotel_id', $hotel)->sum('amount'));
        $numHo = DB::select("select room from hotels where id = '{$hotel}'");
        $numHO = intval($numHo[0]->room);
        return ["diff" => ($numH + $numHO) - $num, "disp" => ($numH - $numHo[0]->room)];
    }

    public function validateRoom($accommodation, $type, $hotel){
        $numH = intval($this->where('accommodation', $accommodation)->where('type', $type)->where('hotel_id', $hotel)->count());
        return $numH;
    }

    public function validateaccommodation($type, $accommodation){
        if($type === "ESTANDAR" and ($accommodation == "SENCILLA" || $accommodation == "DOBLE")) return ["msg" => "la Acomodacion debe ser Sencilla o Doble", "res" => false];
        elseif ($type === "JUNIOR" and ($accommodation == "TRIPLE" || $accommodation == "CUADRUPLE")) return ["msg" => "la Acomodacion debe ser Triple o Cuadruple", "res" => false];
        elseif ($type === "SUITE" and ($accommodation == "SENCILLA" || $accommodation == "DOBLE" || $accommodation == "TRIPLE")) return ["msg" => "la Acomodacion debe ser Sencilla, Doble o Triple", "res" => false];
        return ["msg" => "datos Correctamente", "res" => true];
    }
}

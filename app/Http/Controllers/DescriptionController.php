<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDescriptionRequest;
use App\Models\Description;
use App\Models\Hotel;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

class DescriptionController extends Controller
{
    public function store(CreateDescriptionRequest $request){
        $description = new Description();



        $diff = $description->diffValidatedroom($request->amount,$request->hotel_id);
        $validateH = $description->validateRoom($request->accommodation, $request->type, $request->hotel_id);
        $validatA = $description->validateaccommodation($request->accommodation, $request->type);

        if($diff < 0){
            return response()->json([
                'message' => 'El numero de habitaciones es superior al permitido',
                'res' => false
            ]);
        }else if ($validateH > 0){
            return response()->json([
                'message' => 'No se puede hacer este registro debido a que las habitaciones ya existen para este hotel',
                'res' => false
            ]);
        }else if (!$validatA["res"]){
            return response()->json([
                'message' => $validatA["msg"],
                'res' => false
            ]);
        }

        $create = Description::create($request->all());

        if ($create){
            return response()->json([
                'message' => 'Se ha creado con exito',
                'data' => $create,
                'res' => true
            ], 200);
        }

        return response()->json([
            'message' => 'No se logro crear con exito',
            'res' => false
        ]);

    }

}

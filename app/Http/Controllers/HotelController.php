<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHotelRequest;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function store(CreateHotelRequest $request){

        $create = Hotel::create([
            "name" => $request->name,
            "address" => $request->address,
            "city" => $request->city,
            "nit" => $request->nit,
            "room" => $request->room,
        ]);

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
        ]);;
    }

    public function index(){
        $data = Hotel::get();

        if ($data){
            return response()->json([
                'message' => 'Se encontro con exito',
                'data' => $data,
                'res' => true
            ]);
        }else{
            return response()->json([
                'message' => 'No se encontro con exito',
                'res' => false
            ]);
        }

        return $data;
    }

    public function show($id){

        $data = Hotel::where('id', $id)->first();

        if ($data){
            return response()->json([
                'message' => 'Se encontro con exito',
                'data' => $data,
                'res' => true
            ]);
        }else{
            return response()->json([
                'message' => 'No se encontro con exito',
                'res' => false
            ]);
        }
    }

    public function update(Request $request, $id){
        $data = Hotel::where('id', $id)->update([
            "name" => $request->name,
            "address" => $request->address,
            "city" => $request->city,
            "nit" => $request->nit,
            "room" => $request->room,
        ]);

        if ($data){
            return response()->json([
                'message' => 'Se editaron los datos con exito',
                'data' => $data,
                'res' => true
            ]);
        }else{
            return response()->json([
                'message' => 'No se pudieron eliminar los datos',
                'res' => false
            ]);
        }
    }

    public function delete($id){
        $data = Hotel::where('id', $id)->delete();

        if ($data){
            return response()->json([
                'message' => 'Se eliminaron los datos exitosamente',
                'data' => $data,
                'res' => true
            ]);
        }else{
            return response()->json([
                'message' => 'No se pudieron eliminar los datos',
                'res' => false
            ]);
        }
    }
}

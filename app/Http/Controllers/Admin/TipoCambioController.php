<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoCambio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TipoCambioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return TipoCambio::get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'fecha' => 'required',
                'tc_compra' => 'required',
                'tc_venta' => 'required',
            ]);

            $tipo_cambio=TipoCambio::where('fecha',$request->fecha)->get()->first();
            if($tipo_cambio){
                return response()->json(['status'=>0,'mensaje'=>'Ya existe un registro con la fecha ingresada.']);

            }

            $tipo_cambio=new TipoCambio();
            $tipo_cambio->fecha=$request->fecha;
            $tipo_cambio->tc_compra=$request->tc_compra;
            $tipo_cambio->tc_venta=$request->tc_venta;

            if($tipo_cambio->save()){
                return response()->json(['status'=>1,'mensaje'=>'Datos guardados satisfactoriamente.']);
            }
            else{   return response()->json(['status'=>0,'mensaje'=>'No se pudieron editar los datos.']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status'=>0,'mensaje'=>$th]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'fecha' => 'required',
                'tc_compra' => 'required',
                'tc_venta' => 'required',
            ]);

            $tipo_cambio=TipoCambio::find($id);
            $tipo_cambio->fecha=$request->fecha;
            $tipo_cambio->tc_compra=$request->tc_compra;
            $tipo_cambio->tc_venta=$request->tc_venta;

            if($tipo_cambio->save()){
                return response()->json(['status'=>1,'mensaje'=>'Datos editados satisfactoriamente.']);
            }
            else{   return response()->json(['status'=>0,'mensaje'=>'No se pudieron editar los datos.']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status'=>0,'mensaje'=>$th]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tipo_cambio=TipoCambio::find($id);
            if($tipo_cambio->delete()){
                return response()->json(['status'=>1,'mensaje'=>'Datos borrados satisfactoriamente.']);
            }
            else{   return response()->json(['status'=>0,'mensaje'=>'No se pudieron borar los datos.']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status'=>0,'mensaje'=>$th]);
        }

    }
    public function listar()
    {
        //
        return view('admin.lista');
    }
    public function editar()
    {
        //
        return view('admin.editar');
    }
    public function crear()
    {
        //
        return view('admin.crear');
    }

    // funciones consumidas por la api publica, mediante un middleware

    public function tipocambio()
    {
        try {
            $carbon = new Carbon('America/Los_Angeles');
            $fecha=$carbon->toDateString();
            $tipoCambio= TipoCambio::where('fecha',$fecha)->get()->first();
            if(!$tipoCambio){
                $tipoCambio= TipoCambio::get()->sortByDesc('id')->first();

            }
            return response()->json(['tc_venta'=>$tipoCambio->tc_venta,'tc_compra'=>$tipoCambio->tc_compra]);
        } catch (\Throwable $th) {
            return response()->json(['mensaje'=>$th]);
        }
      }
}

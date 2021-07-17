<?php

namespace App\Http\Controllers\Admin;

use App\Egresado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class EgresadoController extends Controller
{

    public function index(){
        return view('admin.egresados.index');
    }
    
    public function show(Egresado $egresado){
        // dd($egresado);
        return view('admin.egresados.show', compact('egresado'));
    }

    public function aceptar(Egresado $egre){
     
        $egre->estado = '1';
        $egre->update();
        
        return redirect()->route('home');
    }

    public function contador_nuevo_egresado(Request $request)
    {

        // dd($request->all());
        if ($request->ajax()) {
            $egresado = Egresado::where('estado', '0')->get();
            // dd($pagos);
            $contador_nuevos = count($egresado);
            // dd($contador_nuevos);
            return json_decode($contador_nuevos);
        } //procesa la peticion ajax 
        else {
        } //retornas por ejemplo,una vistadd($request->all());
    }


    public function destroy(Egresado $egresado)
    {
        
        $egresado->delete();
        Session::flash('estado', 'ok');
     
        return redirect()
        ->route('home');
    }
}

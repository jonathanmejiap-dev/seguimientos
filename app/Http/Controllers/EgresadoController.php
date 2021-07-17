<?php

namespace App\Http\Controllers;

use App\{Egresado, Titulacion, Centro_laboral};
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EgresadoController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'dni' => 'required|min:8',
            'nombres' => 'required|min:5',
            'telefono' => 'required|min:9',
            'genero' => 'required',
            'estado_civil' => 'required',
            'fecha_nac' => 'required|date',

            'programa_estudios' => 'required',
            'anho_egreso' => 'required|min:4',
            'titulado' => 'required',

            'satisfecho' => 'required|String|in:1,2,3,4,5',

            // 'trabaja' => 'required',
            // 'nombre_laboral' => 'required|min:5',
            // 'cargo_laboral' => 'required',
            // 'descripcion_laboral' => 'required',
            'check_ok' => 'required',
        ]);

        if ($request->get('trabaja') == 'SI') {
            $this->validate($request, [
                
                'trabaja' => 'required',
                'nombre_laboral' => 'required|min:5',
                'sector' => 'required',
                'cargo_laboral' => 'required',
                'descripcion_laboral' => 'required',
                'anho_labor' => 'required',
                
            ]);
        }

        //validamos los datos enviados
        if ($request->get('check_ok') == 'on') {
            // dd($request->all());
            //consultamos si el registro ya existe
            $egre_update = Egresado::find($request->get('dni'));

            //si existe solo actualiza
            if($egre_update ){
                //ACTUALIZAMOS
                $egre_update->nombres = Str::title($request->get('nombres'));
                $egre_update->telefono = $request->get('telefono');
                $egre_update->email = $request->get('email');
                $egre_update->genero = $request->get('genero');
                $egre_update->estado_civil = $request->get('estado_civil');
                $egre_update->fecha_nac = $request->get('fecha_nac');
                $egre_update->trabaja = $request->get('trabaja');
                $egre_update->motivo = $request->get('motivo');
                $egre_update->save();

            }else{
                //CREAMOS NUEVO
                $egre = new Egresado;
                $egre->id = $request->get('dni');
                $egre->nombres = Str::title($request->get('nombres'));
                $egre->telefono = $request->get('telefono');
                $egre->email = $request->get('email');
                $egre->genero = $request->get('genero');
                $egre->estado_civil = $request->get('estado_civil');
                $egre->fecha_nac = $request->get('fecha_nac');
                $egre->trabaja = $request->get('trabaja');
                $egre->motivo = $request->get('motivo');
                $egre->estado = '0'; //1=activo | 0=inactivo
                $egre->save();
            }
            

        
            /**************FIN EGRESADO************* */

            /********************TITULACION**********************/

            //validamos el archivo
            if ($request->file('archivo')) {
                /* subimos la imagen original*/
                $archivo = $request->file('archivo')->store('public/titulos');
                $archivoUrl = Storage::url($archivo);
            } else {
                $archivoUrl = '';
            }

            // Comprobamos si ya existen registros en la carrera
            $titulado = Titulacion::where('programa', $request->get('programa_estudios'))
                        ->where('egresado_id', $request->get('dni'))
                        ->first();

            // dd($titulado);
            //Si existe actualizamos
            if($titulado){
                //UPDATE
                // dd($titulado);
                $titulado->titulado =  $request->get('titulado');
                $titulado->anho_titulado =  $request->get('anho_titulo');
                $titulado->archivo =  $archivoUrl;
                $titulado->egresado_id =  $request->get('dni');
                $titulado->save();

            }else{
                //creamos el objeto
                $titulado = new Titulacion;
                $titulado->programa =  $request->get('programa_estudios');
                $titulado->anho_egreso =  $request->get('anho_egreso');
                $titulado->titulado =  $request->get('titulado');
                $titulado->anho_titulado =  $request->get('anho_titulo');
                $titulado->archivo =  $archivoUrl;
                $titulado->egresado_id =  $request->get('dni');
                $titulado->save();
            }

            /**************FIN TITULACION************* */

            /********************CENTRO LABORAL**********************/

            //CENTRO LABORAL
            if ($request->get('trabaja') == 'SI') {
                // dd($titulado->id);
                $centro = new Centro_laboral;
                $centro->nombre = Str::title($request->get('nombre_laboral'));
                $centro->sector = $request->get('sector');
                $centro->cargo = Str::title($request->get('cargo_laboral'));
                $centro->jefe_laboral = Str::title($request->get('jefe_laboral'));
                $centro->jefe_telefono = Str::title($request->get('jefe_telefono'));
                $centro->descripcion = $request->get('descripcion_laboral');
                $centro->anho_labor = $request->get('anho_labor');
                $centro->titulacion_id = $titulado->id;
                $centro->save(); 
            }


            Session::flash('estado', 'registro_ok');
            return redirect()->route('egresado.index');

        }

       
        Session::flash('estado', 'registro_ok');
        return redirect()->route('egresado.index');
    }
}

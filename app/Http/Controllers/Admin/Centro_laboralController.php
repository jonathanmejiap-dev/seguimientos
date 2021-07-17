<?php

namespace App\Http\Controllers\Admin;

use App\Centro_laboral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Centro_laboralController extends Controller
{
    //

    public function destroy(Centro_laboral $centro)
    {
        $centro->delete();
        Session::flash('estado', 'ok');
     
        return redirect()
        ->route('home');
    }
}

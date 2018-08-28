<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class EnvioController extends Controller
{
    public function index(Request $request){
        if (!$request->ajax()) return redirect('/');
        $titulo = $request->titulo;
        $descricion = $request->descripcion;

        exec('git commit -m \' Se sube una prueba\'');

        /*$proceso = new Process(array('ls', '-la'));
        $proceso->run();
        if (!$proceso->isSuccessful()){
            throw new ProcessFailedException($proceso);
        }*/

        //return ['respuesta' => $proceso->getOutput()];
    }
}

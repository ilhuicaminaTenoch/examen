<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class EnvioController extends Controller
{
    public function index(Request $request){
        if (!$request->ajax()) return redirect('/');
        $titulo = $request->titulo;
        $descricion = $request->descripcion;

        $cliente = new \Github\Client();
        $cliente->authenticate('ilhuicaminaTenoch','$zerocoolmane371986$',\Github\Client::AUTH_HTTP_PASSWORD);
        //$issues = $cliente->api('issue')->all('ilhuicaminaTenoch', 'examen', array('state' => 'open'));
        $cliente->api('issue')->create('ilhuicaminaTenoch', 'examen', array('title' => $titulo, 'body' => $descricion));

        return;
    }

    public function listar(Request $request){
        $cliente = new \Github\Client();
        $issues = $cliente->api('issue')->all('ilhuicaminaTenoch', 'examen', array('state' => 'open'));
        return ['issue' => $issues];

    }
}

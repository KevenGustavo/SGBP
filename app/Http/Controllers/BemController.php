<?php

namespace App\Http\Controllers;

use App\Models\Bem;
use Illuminate\Http\Request;

class BemController extends Controller
{
    public function index(){
        $bens = Bem::all();

        return view('bens.index',[
            "bens"=>$bens
        ]);
    }

    public function create(){
        return view('bens.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            "patrimonio"=>["required","unique:bems","max:255"],
            "marca"=>["required","max:50"],
            "localizacao"=>["required","max:100"],
            "responsavel"=>["required","exists:users,id","max:100"],
            "tipoUso"=>["required","max:50"],
            "estado"=>["required","max:50"],
            "descricao"=>["required"],
        ]);

        $bem = Bem::create([
            "patrimonio"=> $validated["patrimonio"],
            "marca"=>$validated["marca"],
            "localizacao"=>$validated["localizacao"],
            "responsavel_id"=>$validated["responsavel"],
            "tipoUso"=>$validated["tipoUso"],
            "estado"=>$validated["estado"],
            "descricao"=>$validated["descricao"],
        ]);

        return redirect("/bens");
    }
}

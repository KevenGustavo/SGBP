<?php

namespace App\Http\Controllers;

use App\Models\Bem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BemController extends Controller
{
    public function index(){
        $bens = Bem::all();

        return view('bens.index',[
            "bens"=>$bens
        ]);
    }

    public function create(){
        Gate::authorize("create",Bem::class);

        $users = User::all();

        return view('bens.create',["users"=>$users]);
    }

    public function show(Bem $bem){
        $users = User::all();
        return view("bens.show", ["bem" => $bem,"users"=>$users]);
    }

    public function store(Request $request){
        Gate::authorize("create",Bem::class);

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

    public function edit (Bem $bem){
        return view("bens.edit",["bem"=>$bem]);
    }
}

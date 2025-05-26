<?php

namespace App\Http\Controllers;

use App\Models\Bem;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class BemController extends Controller
{
    public function index()
    {
        $bens = Bem::all();

        return view('bens.index', [
            "bens" => $bens
        ]);
    }

    public function create()
    {
        Gate::authorize("create", Bem::class);

        $users = User::all();

        return view('bens.create', ["users" => $users]);
    }

    public function show(Bem $bem)
    {
        $users = User::all();

        return view("bens.show", ["bem" => $bem, "users" => $users]);
    }

    public function store(Request $request)
    {
        Gate::authorize("create", Bem::class);

        $validated = $request->validate([
            "patrimonio" => ["required", "unique:bems", "max:255"],
            "marca" => ["required", "max:50"],
            "localizacao" => ["required", "max:100"],
            "responsavel" => ["required", "exists:users,id"],
            "tipoUso" => ["required", Rule::in(["Professor", "Pesquisa", "Extensão"])],
            "estado" => ["required", Rule::in(["Em Funcionamento", "Com Defeito", "Ocioso", "Em Manutenção"])],
            "descricao" => ["required"],
        ]);

        try {
            DB::beginTransaction();

            $bem = Bem::create([
                "patrimonio" => $validated["patrimonio"],
                "marca" => $validated["marca"],
                "localizacao" => $validated["localizacao"],
                "responsavel_id" => $validated["responsavel"],
                "tipoUso" => $validated["tipoUso"],
                "estado" => $validated["estado"],
                "descricao" => $validated["descricao"],
            ]);

            DB::commit();

            return redirect()->route("bens");

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Ocorreu um erro ao criar o Bem e seu Histórico.',
                'error' => $e->getMessage() // Opcional: enviar detalhes do erro (cuidado em produção)
            ], 500);
        }
    }

    public function edit(Bem $bem)
    {
        Gate::authorize("update", Bem::class);

        return view("bens.edit", ["bem" => $bem]);
    }

    public function updateDetalhes(Request $request, Bem $bem)
    {
        Gate::authorize("update", Bem::class);

        $validated = $request->validate([
            "patrimonio" => ["required", "max:255", Rule::unique("bems")->ignore($bem->id)],
            "marca" => ["required", "max:50"],
            "tipoUso" => ["required", Rule::in(["Professor", "Pesquisa", "Extensão"])],
            "estado" => ["required", Rule::in(["Em Funcionamento", "Com Defeito", "Ocioso", "Em Manutenção"])],
            "descricao" => ["required"],
        ]);

        $bem->update([
            "patrimonio" => $validated["patrimonio"],
            "marca" => $validated["marca"],
            "tipoUso" => $validated["tipoUso"],
            "estado" => $validated["estado"],
            "descricao" => $validated["descricao"],
        ]);

        return redirect()->route("bens.show", ["bem" => $bem->id]);
    }

    public function updateLocalizacao(Request $request, Bem $bem)
    {
        Gate::authorize("update", Bem::class);

        $validated = $request->validate([
            "localizacao" => ["required", "max:100"],
        ]);

        $bem->update([
            "localizacao" => $validated["localizacao"],
        ]);

        return redirect()->route("bens.show", ["bem" => $bem->id]);
    }

    public function updateResponsavel(Request $request, Bem $bem)
    {
        Gate::authorize("update", Bem::class);

        $validated = $request->validate([
            "responsavel" => ["required", "exists:users,id"],
        ]);

        $bem->update([
            "responsavel_id" => $validated["responsavel"],
        ]);

        return redirect()->route("bens.show", ["bem" => $bem->id]);
    }
}

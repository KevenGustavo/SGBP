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
    public function index(Request $request)
    {
        $users = User::orderBy('name')->get();
        $tiposUso = array_merge(["Todos"],Bem::TIPOS_USO);
        $estados = array_merge(["Todos"],Bem::ESTADOS);

        $query = Bem::with('user');

        if ($request->filled('search_query')) {
            $searchTerm = $request->input('search_query');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('patrimonio', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('marca', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('tipo_uso') && in_array($request->input("tipo_uso"),[1,2,3])) {
            $query->where('tipoUso', $tiposUso[$request->input('tipo_uso')]);
        }

        if ($request->filled('estado') && in_array($request->input("estado"),[1,2,3,4])) {
            $query->where('estado', $estados[$request->input('estado')]);
        }

        if ($request->filled('responsavel_id')) {
            $query->where('responsavel_id', $request->input('responsavel_id'));
        }

        $bens = $query->orderBy('patrimonio', 'asc')->paginate(10);

        return view('bens.index', [
            "bens" => $bens,
            "users" => $users,
            "tiposUso" => $tiposUso,
            "estados" => $estados,
        ]);
    }

    public function create()
    {
        Gate::authorize("create", Bem::class);

        $users = User::orderBy('name')->get();

        return view('bens.create', ["users" => $users]);
    }

    public function show(Bem $bem)
    {
        $bem->load(["historicos"=>function($query){
            $query->with("registrador","responsavelAnterior","responsavelAtual");
        }]);

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
            "tipoUso" => ["required", Rule::in(Bem::TIPOS_USO)],
            "estado" => ["required", Rule::in(Bem::ESTADOS)],
            "descricao" => ["required"],
        ]);

        DB::beginTransaction();

        try {
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
            "tipoUso" => ["required", Rule::in(Bem::TIPOS_USO)],
            "estado" => ["required", Rule::in(Bem::ESTADOS)],
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

        DB::beginTransaction();

        try {
            $bem->update([
                "localizacao" => $validated["localizacao"],
            ]);

            DB::commit();

            return redirect()->route("bens.show", ["bem" => $bem->id]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Ocorreu um erro ao atualizar a localização do Bem e seu Histórico.',
                'error' => $e->getMessage() // Opcional: enviar detalhes do erro (cuidado em produção)
            ], 500);
        }
    }

    public function updateResponsavel(Request $request, Bem $bem)
    {
        Gate::authorize("update", Bem::class);

        $validated = $request->validate([
            "responsavel" => ["required", "exists:users,id"],
        ]);

        DB::beginTransaction();

        try {
            $bem->update([
                "responsavel_id" => $validated["responsavel"],
            ]);

            DB::commit();

            return redirect()->route("bens.show", ["bem" => $bem->id]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Ocorreu um erro ao atualizao o responsavel do Bem e seu Histórico.',
                'error' => $e->getMessage() // Opcional: enviar detalhes do erro (cuidado em produção)
            ], 500);
        }
    }

    public function destroy( Bem $bem){
        Gate::authorize("delete", Bem::class);

        $bem->delete();

        return redirect()->route("bens");
    }
}

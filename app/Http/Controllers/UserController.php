<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SetupAccountNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize("viewAny", User::class);

        $query = User::query();

        if ($request->filled('search_query')) {
            $searchTerm = $request->input('search_query');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        $users = $query->orderBy('name', 'asc')->paginate(10);

        return view("users.index", [
            "users" => $users
        ]);
    }

    public function create()
    {
        Gate::authorize("create", User::class);

        return view("users.create");
    }

    public function store(Request $request)
    {
        Gate::authorize("create", User::class);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'isAdmin' =>['nullable','boolean'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(Str::random(20)),
            'email_verified_at' => null,
            'isAdmin' => $request->boolean('isAdmin'),
        ]);

        $token = Password::broker()->createToken($user);
        $user->notify(new SetupAccountNotification($token));

        return redirect()->route('users')
            ->with('success', 'Usuário registrado! Um e-mail foi enviado para ' . $user->email . ' para configuração da conta.');
    }

    public function destroy(User $user)
    {
        Gate::authorize("delete", User::class);

        if (Auth::id() === $user->id) {
            return redirect()->route('users')
                ->with('error', 'Você não pode excluir sua própria conta por esta interface.');
        }

        DB::beginTransaction();
        try {
            $userName = $user->name;

            $user->delete();

            DB::commit();

            return redirect()->route('users')
                            ->with('success', "Usuário '{$userName}' excluído com sucesso. Bens foram reatribuídos e históricos anonimizados/atualizados.");
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('users')
                            ->with('error', 'Ocorreu um erro ao tentar excluir o usuário: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::all()->sortBy('name');
        $totalUsers = User::all()->count();

        if(Gate::allows('tipo-user')){
            return view('users.index', compact('user', 'totalUsers'));
        }else{
            return back();
        }


    }

    public function create()
    {
        $user = new User();
        if(Gate::allows('tipo-user')){
        return view('users.create', compact('user'));
        }else{
            return back();
        }
    }

    public function store(Request $request)
    {
        $input = $request->toArray();
        //dd($input);


        $input['user_id'] = 1;

        User::create($input);
        $input['password'] = bcrypt($input['password']);
        return redirect()->route('users.index')->with('sucesso', 'Usuário cadastrado com sucesso!');
    }

    public function edit(string $id)
    {
        $user = User::find($id);

        if(!$user){
            return back();
        }

        if(auth()->user()->id == $user['id'] || auth()->user()->tipo == 'admin'){
            return view('users.edit', compact('user'));
        }else{
            return back();
        }
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $user->name = $request->input('name');
        $input = $request->all();

        /*if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }*/

        if($request->password){
            $input['password'] = bcrypt($input['password']);
        }else{
            $input['password'] = $user['password'];
        }

        //$user->tipo = $request->input('tipo');

        $user->fill($input);
        $user->save();

        if($user->type == "admin"){
            return redirect()->route('users.index')->with('sucesso', 'Usuário alterado com sucesso!');
        }else{
            return redirect()->route('users.edit', $user->id)->with('sucesso', 'Usuário alterado com sucesso!');
        }


    }

    public function destroy(User $user, string $id)
    {
        $user = User::find($id);

        $user->delete();
        return redirect()->route('cargos.index')->with('sucesso', 'Usuário deletado com sucesso!');
    }
}

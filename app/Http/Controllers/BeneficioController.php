<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use Illuminate\Http\Request;

class BeneficioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $beneficios = Beneficio::where('descricao', 'like', '%'.$request->busca.'%')->orderBy('descricao', 'asc')->paginate(3);
        $totalBeneficios = Beneficio::all()->count();

        return view('beneficios.index', compact('beneficios', 'totalBeneficios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $beneficios = Beneficio::all()->sortBy('descricao');

        return view('beneficios.create', compact('beneficios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->toArray();
        //dd($input);

        $input['user_id'] = auth()->user()->id;
        Beneficio::create($input);

        return redirect()->route('beneficios.index')->with('sucesso', 'Beneficio cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $beneficio = Beneficio::find($id);
        return view('beneficios.edit', compact('beneficio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $beneficios = Beneficio::find($id);

        $beneficios->descricao = $request->input('descricao');
        $beneficios->save();

        return redirect()->route('beneficios.index')->with('sucesso', 'Beneficio alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $beneficio = Beneficio::find($id);

        $beneficio->delete();
        return redirect()->route('beneficios.index')->with('sucesso', 'Beneficio deletado com sucesso!');
    }
}

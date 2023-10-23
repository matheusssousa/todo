<?php

namespace App\Http\Controllers;

use App\Enums\StatusNotas;
use App\Models\Tarefa;
use App\Http\Requests\StoreTarefaRequest;
use App\Http\Requests\UpdateTarefaRequest;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class TarefaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //         $query = Tarefa::search($request)
        //     ->where('user_id', auth()->user()->id);
        // dd($query->toSql(), $query->getBindings());

        $tarefas = Tarefa::search($request)
            ->where('user_id', auth()->user()->id)
            ->paginate(10)->withQueryString();
        // dd($tarefas);

        return view('tarefa.index', ['tarefas' => $tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTarefaRequest $request)
    {
        $tarefa = new Tarefa;

        $tarefa->nome = $request->nome;
        $tarefa->descricao = $request->descricao;
        $tarefa->data_prazo = $request->data_prazo;
        $tarefa->markdown = StatusNotas::NaoConcluido;
        $tarefa->user_id = auth()->user()->id;

        $tarefa->save();

        return to_route('tarefa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        return view('tarefa.edit', ['tarefa' => $tarefa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTarefaRequest $request, Tarefa $tarefa)
    {
        $tarefa->fill($request->all());
        $tarefa->save();

        return to_route('tarefa.index');
    }

    /**
     * Dando update somente no markdown da tarefa.
     */
    public function updateMarkdown(Request $request, Tarefa $tarefa)
    {
        $tarefa->markdown = $request->new_markdown;
        $tarefa->save();

        return to_route('tarefa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();

        return to_route('tarefa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore($tarefa)
    {
        $tarefa = Tarefa::withTrashed()->where('id', $tarefa)->restore();

        return to_route('tarefa.index');
    }
}

{{-- @dd($tarefas) --}}
@extends('layouts.app')

@section('content')
    <div class="body-page">
        <div class="w-full flex justify-between items-center">
            <h1 class="title-lit">Minhas Tarefas</h1>

            <form action="{{ route('tarefa.index') }}" method="get" class="flex gap-3 bg-cinzaClaro p-1 rounded-lg">
                <div class="group-input-search">
                    <label for="nome" class="label">Nome</label>
                    <input type="search" name="nome" id="nome" value="{{ request()->nome ?? '' }}" class="input">
                </div>
                <div class="group-input-search">
                    <label for="markdown" class="label">Concluído</label>
                    <select name="markdown" id="markdown" class="select" type="search">
                        <option value="" @if (request('markdown') === '') selected @endif>Todos</option>
                        <option value='{{ App\Enums\StatusNotas::Concluido }}'
                            @if (request('markdown') === 'Concluido') selected @endif>Sim</option>
                        <option value='{{ App\Enums\StatusNotas::NaoConcluido }}'
                            @if (request('markdown') === 'NaoConcluido') selected @endif>Não</option>
                    </select>
                </div>
                <div class="group-input-search">
                    <label for="deleted_at" class="label">Deletados</label>
                    <select name="deleted_at" id="deleted_at" class="select">
                        <option value="every" @if (request('deleted_at') === '') selected @endif>Todos</option>
                        <option value='null' @if (request('deleted_at') === 'null') selected @endif>Não</option>
                        <option value='notnull' @if (request('deleted_at') === 'notnull') selected @endif>Sim</option>
                    </select>
                </div>
                <button type="submit" class="btn-search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"
                            class="fill-white"></path>
                    </svg>
                </button>
            </form>


            <a href="{{ route('tarefa.create') }}"
                class="px-2 py-2 bg-purple-500 hover:bg-purple-800 rounded-lg flex items-center justify-center hover:shadow-xl duration-200 text-sm gap-2 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"
                        class="fill-white">
                    </path>
                </svg>
                Adicionar Tarefa
            </a>
        </div>
        <div class="w-full flex flex-wrap gap-2 pt-4">
            @foreach ($tarefas as $tarefa)
                <div class="w-full md:w-[24.6%] h-48 bg-cinzaClaro rounded-lg relative flex">
                    <div
                        class="w-1/2 h-full bg-gradient-to-br from-purple-500 to-sky-500 rounded-br-full flex items-center p-4">
                        <p class="text-xl font-medium text-white capitalize">{{ $tarefa->nome }}</p>
                    </div>
                    <div class="w-1/2 h-full p-4 flex flex-col gap-2">
                        <div class="w-full h-2/3 flex flex-col justify-between">
                            <p class="text-sm font-light text-cinzaEscuro">{{ substr($tarefa->descricao, 0, 100) }}...</p>
                            <div class="w-full h-px bg-gradient-to-r from-purple-500 to-sky-500 bg-opacity-30 my-2"></div>
                        </div>
                        <p class="text-sm font-light text-cinzaEscuro">
                            {{ \Carbon\Carbon::parse($tarefa->data_prazo)->format('d/m/Y') }}</p>
                        <div class="w-full flex justify-between items-center">

                            @if (!$tarefa->deleted_at)
                                <form action="{{ route('tarefa.mark', $tarefa->id) }}" method="post"
                                    id="form-concluido-{{ $tarefa->id }}" class="flex gap-1 items-stretch">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="new_markdown" value="{{ $tarefa->markdown ? 0 : 1 }}">
                                    <input type="checkbox" name="markdown" id="markdown-{{ $tarefa->id }}"
                                        value="{{ old('markdown', $tarefa ?? '') }}"
                                        onclick="event.preventDefault();document.getElementById('form-concluido-{{ $tarefa->id }}').submit()"
                                        class="cursor-pointer" @if ($tarefa->markdown == 1) checked @endif>
                                    <label for="markdown-{{ $tarefa->id }}"
                                        class="text-xs text-cinzaEscuro font-light select-none cursor-pointer">Concluída</label>
                                </form>





                                <div class="flex items-center gap-1">
                                    <a href="{{ route('tarefa.edit', ['tarefa' => $tarefa->id]) }}" class="group">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                                            viewBox="0 0 256 256">
                                            <path
                                                d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"
                                                class="fill-cinzaEscuro group-hover:fill-sky-400"></path>
                                        </svg>
                                    </a>
                                    <button type="button"
                                        onclick="event.preventDefault();document.getElementById('form-delete-{{ $tarefa->id }}').submit();"
                                        class="group">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                                            viewBox="0 0 256 256">
                                            <path
                                                d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"
                                                class="fill-cinzaEscuro group-hover:fill-vermelho"></path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('tarefa.destroy', ['tarefa' => $tarefa->id]) }}" method="post"
                                        id="form-delete-{{ $tarefa->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            @endif

                            @if ($tarefa->deleted_at)
                                <form action="{{ route('tarefa.restore', ['tarefa' => $tarefa->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="group">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" viewBox="0 0 256 256"><path d="M240,56v48a8,8,0,0,1-8,8H184a8,8,0,0,1,0-16H211.4L184.81,71.64l-.25-.24a80,80,0,1,0-1.67,114.78,8,8,0,0,1,11,11.63A95.44,95.44,0,0,1,128,224h-1.32A96,96,0,1,1,195.75,60L224,85.8V56a8,8,0,1,1,16,0Z" class="fill-cinzaEscuro group-hover:text-sky-500"></path></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection

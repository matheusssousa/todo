@extends('layouts.app')

@section('content')
    <div class="body-page">
        <div class="w-full flex justify-center items-center">
            <h1 class="title-lit">Editando {{$tarefa->nome}}</h1>
        </div>
        <div class="flex items-center justify-center mt-10">
            <form action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}" method="post" class="form">
                @csrf
                @method('PUT')
                @include('tarefa.partials.form')
            </form>
        </div>
    </div>
@endsection

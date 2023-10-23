@extends('layouts.app')

@section('content')
    <div class="body-page">
        <div class="w-full flex justify-center items-center">
            <h1 class="title-lit">Nova Tarefa</h1>
        </div>
        <div class="flex items-center justify-center mt-10">
            <form action="{{ route('tarefa.store') }}" method="post" class="form">
                @csrf
                @include('tarefa.partials.form')
            </form>
        </div>
    </div>
@endsection

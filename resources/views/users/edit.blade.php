@extends('layouts.default')
@section('title', 'SisRH - Alteração de Usuário')

@section('content')
    @if (Session::get('sucesso'))
        <div class="alert alert-success text-center">{{ Session::get('sucesso') }}</div>
    @endif
    <h1 class="fs-2 mb-3">Alterar usuário</h1>

    <form class="row g-3" method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf <!--token for security-->
        @method('PUT')
        @include('users.partials.form')
        <div class="col-12">
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="{{ route('users.index') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
@endsection

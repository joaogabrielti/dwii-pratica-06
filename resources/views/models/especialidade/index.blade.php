@extends('layouts.app', ['page' => 'especialidade', 'title' => 'Cadastro de Especialidades', 'icon' => 'clipboard'])

@section('content')
<x-data-search :model="'especialidade'" :btnCreateText="'Cadastrar Nova Especialidade'" />
<x-data-table :head="['id', 'nome', 'descricao']" :array="$especialidades" :model="'especialidade'" />
@endsection

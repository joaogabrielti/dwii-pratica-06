@extends('layouts.app', ['page' => 'cliente', 'title' => 'Cadastro de Clientes', 'icon' => 'person-circle'])

@section('content')
<x-data-search :model="'cliente'" :btnCreateText="'Cadastrar Novo Cliente'" />
<x-data-table :head="['id', 'nome', 'telefone', 'email']" :array="$clientes" :model="'cliente'" />
@endsection

@extends('layouts.app', ['page' => 'veterinario', 'title' => 'Cadastro de Veterinários', 'icon' => 'file-earmark-person'])

@section('content')
<x-data-search :model="'veterinario'" :btnCreateText="'Cadastrar Novo Veterinário'" />
<x-data-table :head="['id', 'nome', 'crmv', ['name' => 'especialidade', 'attr' => 'especialidade.nome']]" :array="$veterinarios" :model="'veterinario'" />
@endsection

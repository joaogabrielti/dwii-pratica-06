<?php

namespace App\Http\Controllers;

use App\Models\Veterinario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VeterinarioController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $veterinarios = Veterinario::all();
        return view('models.veterinario.index', compact('veterinarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('models.veterinario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = array_map('mb_strtoupper', $request->validate([
            'nome' => ['required', 'string'],
            'crmv' => ['required', 'number'],
            'especialidade_id' => ['required', 'number']
        ]));

        DB::beginTransaction();
        try {
            Veterinario::create($validatedData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }

        return redirect(route('veterinario.index'))->with(['status' => 'success', 'message' => 'Veterinário cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Veterinario  $veterinario
     * @return \Illuminate\Http\Response
     */
    public function show(Veterinario $veterinario) {
        return response()->json($veterinario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Veterinario  $veterinario
     * @return \Illuminate\Http\Response
     */
    public function edit(Veterinario $veterinario) {
        return view('models.veterinario.create', compact('veterinario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Veterinario  $veterinario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Veterinario $veterinario) {
        $validatedData = array_map('mb_strtoupper', $request->validate([
            'nome' => ['required', 'string'],
            'crmv' => ['required', 'number'],
            'especialidade_id' => ['required', 'number']
        ]));

        DB::beginTransaction();
        try {
            $veterinario->update($validatedData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }

        return redirect(route('veterinario.index'))->with(['status' => 'success', 'message' => 'Veterinário editado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Veterinario  $veterinario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Veterinario $veterinario) {
        DB::beginTransaction();
        try {
            $veterinario->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }

        return redirect(route('veterinario.index'))->with(['status' => 'success', 'message' => 'Veterinário excluído com sucesso!']);
    }
}

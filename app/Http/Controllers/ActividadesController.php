<?php

namespace App\Http\Controllers;

use App\Models\actividades;
use Illuminate\Http\Request;

class ActividadesController extends Controller
{

    public function index()
    {
       // $actividades = actividades::all();
        $actividades = actividades::orderBy('created_at', 'desc')->get();
    
    // Pasar los registros a la vista 'registros.principal'
    return view('actividades.actividades', compact('actividades'));
    }

 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function show(actividades $actividades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function edit(actividades $actividades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, actividades $actividades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function destroy(actividades $actividades)
    {
        //
    }
}
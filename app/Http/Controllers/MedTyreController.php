<?php

namespace App\Http\Controllers;

use App\MedTyre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedTyreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medtyres = MedTyre::all();
        return view('medtyres',compact('medtyres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createMedidas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medtyres = new MedTyre();
        $medtyres->name = $request->nome;
        $medtyres->type = $request->type;
        $medtyres->abbr = 0;
        $medtyres->save();
        $lastID = DB::getPdo()->lastInsertId();
        if($lastID < 10){
            $medtyres->abbr = "00" . $lastID;
        }else if($lastID < 100){
            $medtyres->abbr = "0" . $lastID;
        }else{
            $medtyres->abbr = $lastID;
        }
        $medtyres->save();
        $medtyres = MedTyre::All();
        return view('medtyres',compact('medtyres'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedTyre  $medTyre
     * @return \Illuminate\Http\Response
     */
    public function show(MedTyre $medTyre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedTyre  $medTyre
     * @return \Illuminate\Http\Response
     */
    public function edit(MedTyre $medTyre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedTyre  $medTyre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedTyre $medTyre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedTyre  $medTyre
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedTyre $medTyre)
    {
        //
    }
}

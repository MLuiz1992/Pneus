<?php

namespace App\Http\Controllers;

use App\Tyre;
use App\MedTyre;
use App\ZebraPrinter;
use Illuminate\Http\Request;
use Image;
use DB;

class TyreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function teste()
    {
        $hostPrinter = "\\localhost\Elgin";
        $speedPrinter = 4;
        $darknessPrint = 2;
        $labelSize = array(300,10);
        $referencePoint = array(223,15);

        $z = new ZebraPrinter($hostPrinter, $speedPrinter, $darknessPrint, $labelSize, $referencePoint);
       
        $z->setBarcode(1, 344, 80, "ContentBarCode"); #1 -> cod128
        $z->writeLabel("Hello World",344,30,4);
        $z->setLabelCopies(1);
        $z->print2zebra();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medpneus = MedTyre::all();
        return view('spa2', compact('medpneus'));
    }

    public function view()
    {
        $pneus = Tyre::all();
        $medtyres = MedTyre::all();
        return view('viewtyres',compact('pneus','medtyres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medpneus = MedTyre::all();
        $tyre = new Tyre();
        $tyre->medtyre_id = $request->medpneus;
        $medpneu = MedTyre::find($request->medpneus);
        $tyre->cod = $medpneu->abbr . '_' . $this->countPneus() . $this->timestamps(date('d-m-Y H:i:s'));
        $fotoCripto = $request->foto;
        if(is_dir("pneus")){
        Image::make($fotoCripto)->save( public_path('pneus/' . $tyre->cod . '.jpg') );
        }else{
            mkdir("pneus", 0700);
        }
        $tyre->foto = $tyre->cod . '.jpg';
        $tyre->save();
        return view('spa2', compact('medpneus'));

    }

    public function countPneus(){
        $qtd = 0;
        $qtd_tyres = Tyre::all();
        foreach($qtd_tyres as $qtd_tyre){
            $qtd++;
        }
        return $qtd++;
    }

   public function timestamps($timestamp){
        $array_splited = str_split($timestamp);
       // dd($array_splited);
        $array_dump = $array_splited[0].$array_splited[1].$array_splited[3].$array_splited[4].$array_splited[8].$array_splited[9].$array_splited[11].$array_splited[12].$array_splited[14].$array_splited[15].$array_splited[17].$array_splited[18];
    return $array_dump;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tyre  $tyre
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pneu = Tyre::with('medtyre')->where('id', $id)->first();
        return view("pneus.show", compact("pneu"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tyre  $tyre
     * @return \Illuminate\Http\Response
     */
    public function edit(Tyre $tyre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tyre  $tyre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tyre $tyre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tyre  $tyre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tyre $tyre)
    {
        //
    }
}

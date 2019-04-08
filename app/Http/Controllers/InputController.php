<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Input;
use App\Wilayah;

use DB;

class InputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $provs = Wilayah::whereRaw('LENGTH(kode) = 2')->get();
        //print_r($prov);
        //return view('input');
        return view('input')->with('provs', $provs);
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
        request()->validate([
            'nama' => 'required',
            'npm' => 'required',
            'judul' => 'required',
            'lokasi' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'keperluan' => 'required',
            'north' => 'required',
            'south' => 'required',
            'east' => 'required',
            'west' => 'required'
        ]);

        Input::create($request->all());    
        return redirect()->route('input.index')->with('success', "Hooray, things are awesome!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function show(Input $input)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function edit(Input $input)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Input $input)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Input  $input
     * @return \Illuminate\Http\Response
     */
    public function destroy(Input $input)
    {
        //
    }

    public function selectKab(Request $request)
    {

        //$states = Wilayah::all();
        //$states = Wilayah::select(DB::raw('LEFT("kode", 2)=11 AND LENGTH(kode) = 5 ORDER BY nama'))->get();
        /*$states = Wilayah::where('kode', 'like', '11%')
        ->whereRaw('LENGTH(kode) = 5')
        ->get();
        
        $data = view('ajax-select',compact('states'))->render();
        return response()->json(['options'=>$data]);*/
        
        if($request->ajax()){
            $states = Wilayah::where('kode', 'like', $request->id_kab.'%')
            ->whereRaw('LENGTH(kode) = 5')
            ->orderBy('nama')
            ->get();

            $data = view('ajax-select-kab',compact('states'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function selectKec(Request $request)
    {

        //$states = Wilayah::all();
        //$states = Wilayah::select(DB::raw('LEFT("kode", 2)=11 AND LENGTH(kode) = 5 ORDER BY nama'))->get();
        /*$states = Wilayah::where('kode', 'like', '11%')
        ->whereRaw('LENGTH(kode) = 5')
        ->get();
        
        $data = view('ajax-select',compact('states'))->render();
        return response()->json(['options'=>$data]);*/
        
        if($request->ajax()){
            $states = Wilayah::where('kode', 'like', $request->id_kec.'%')
            ->whereRaw('LENGTH(kode) = 8')
            ->orderBy('nama')
            ->get();

            $data = view('ajax-select-kec',compact('states'))->render();
            return response()->json(['options'=>$data]);
        }
    }
}

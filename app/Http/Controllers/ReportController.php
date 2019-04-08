<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Input;
use App\Wilayah;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Input::all();
        return view('report')->with('datas', $datas);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reportView($id)
    {
        $wilayah = new Wilayah();
        $data = Input::findOrFail($id);
        
        $prov = $wilayah->wilayah($data->provinsi);
        $kab = $wilayah->wilayah($data->kabupaten);
        $kec = $wilayah->wilayah($data->kecamatan);
        return view('report-view')
            ->with('data', $data)
            ->with('kab', $kab)
            ->with('kec', $kec)
            ->with('prov', $prov);
        //return view('report-view', compact($datas, $lokasi));
    }

}

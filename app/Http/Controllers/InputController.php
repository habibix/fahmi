<?php

namespace App\Http\Controllers;

use App\Input;
use App\Singkapan;
use App\Wilayah;
use Illuminate\Http\Request;

use Storage;

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
        $request->validate([
            'attach.*' => 'required|file|max:5000|mimes:pdf,docx,doc',
        ]);

        request()->validate([
            'nama'             => 'required',
            'npm'              => 'required',
            'judul'            => 'required',
            'lokasi'           => 'required',
            'kecamatan'        => 'required',
            'kabupaten'        => 'required',
            'provinsi'         => 'required',
            'keperluan'        => 'required',
            'north'            => 'required',
            'south'            => 'required',
            'east'             => 'required',
            'west'             => 'required',
            'kode_singkapan.*' => 'required',
            'nama_batuan.*'    => 'required',
            'jenis_batuan.*'   => 'required',
            'longitude.*'      => 'required',
            'latitude.*'       => 'required',
            'elevasi.*'        => 'required',
            'attach.*'         => 'required|mimes:doc,docx,odt|max:2000',
            'attach'           => 'required',
        ], [

            'kode_singkapan.*' => 'Pastikan isi kode singkapan',
            'nama_batuan.*'    => 'Isi nama batuan',
            'jenis_batuan.*'   => 'isi jenis batuan',
            'longitude.*'      => 'Isi koordinat longitude',
            'latitude.*'       => 'Isi koordinat latitude',
            'elevasi.*'        => 'Isi elevasi',
            'attach'           => 'Upload file singkapan',
            'attach.*'         => 'Upload hanya file doc, docx, and odt. Maksimum ukuran dokumen 2MB',
        ]
        );

        $count_kec = Input::select('kecamatan')->where('kecamatan', 'like', $request->kecamatan.'%');
        $count_kec = $count_kec->count();

        $data = array(
            'nama'             => $request->nama,
            'npm'              => $request->npm,
            'judul'            => $request->judul,
            'lokasi'           => $request->lokasi,
            'kecamatan'        => $request->kecamatan.'-'.$count_kec,
            'kabupaten'        => $request->kabupaten,
            'provinsi'         => $request->provinsi,
            'keperluan'        => $request->keperluan,
            'north'            => $request->north,
            'south'            => $request->south,
            'east'             => $request->east,
            'west'             => $request->west,
        );

        //$data   = $request->all();
        $lastid = Input::create($data)->id;

        /*$kec_kode = $data->kecamatan;
        $last_kec = Input::select('kecamatan')->where('kecamatan', 'like', $kec_kode.'%');
        $count_kec = $last_kec->count();
        echo $count_kec;
*/
        

        $files = $request->file('attach');
        $path  = public_path('/uploads/');

        /*foreach ($files as $file => $val) {
        echo $val->getClientOriginalName();
        }*/

        foreach ($files as $item => $v) {
            //$filename = $file

            $data2 = array(
                'input_id'               => $lastid,
                'singkapan_kode'         => $request->kode_singkapan[$item],
                'singkapan_nama_batuan'  => $request->nama_batuan[$item],
                'singkapan_jenis_batuan' => $request->jenis_batuan[$item],
                'singkapan_lng'          => $request->longitude[$item],
                'singkapan_lat'          => $request->latitude[$item],
                'singkapan_elevasi'      => $request->elevasi[$item],
                'singkapan_attach'       => $v->getClientOriginalName(),
            );

            //Singkapan::create($data2);

            //Storage::putFileAs($path, $v, $v->getClientOriginalName().$item);

            $file = time().$v->getClientOriginalName();
            $path = base_path() . '/public/uploads/';
            $v->move($path, $item.'-NAME.'.$v->getClientOriginalExtension());
        }
        //return redirect()->back()->with('success','data insert successfully');
        return redirect()->route('input.index')->with('success', "Insert Success");

        /*

    request()->validate([
    'input_id.*'=> 'required',
    'singkapan_kode.*'=> 'required',
    'singkapan_nama_batuan.*'=> 'required',
    'singkapan_jenis_batuan.*'=> 'required',
    'singkapan_lng.*'=> 'required',
    'singkapan_lat.*'=> 'required',
    'singkapan_elevasi.*'=> 'required',
    'singkapan_attach.*'=> 'required'
    ]);

    $rules = [
    'name' => 'required|max:255',
    ];

    foreach ($request->kode_singkapan as $key => $val) {
    request()->validate([
    'singkapan_kode.' . $key      => 'required',
    'singkapan_nama_batuan.' . $key       => 'required',
    'singkapan_jenis_batuan.' . $key     => 'required',
    'singkapan_lng.' . $key    => 'required',
    'singkapan_lat.' . $key => 'required',
    'singkapan_elevasi.' . $key => 'required',
    'singkapan_attach.' . $key  => 'required',
    'keperluan' => 'required',
    'north'     => 'required',
    'south'     => 'required',
    'east'      => 'required',
    'west'      => 'required',
    ]);
    }*/
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

        if ($request->ajax()) {
            $states = Wilayah::where('kode', 'like', $request->id_kab . '%')
                ->whereRaw('LENGTH(kode) = 5')
                ->orderBy('nama')
                ->get();

            $data = view('ajax-select-kab', compact('states'))->render();
            return response()->json(['options' => $data]);
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

        if ($request->ajax()) {
            $states = Wilayah::where('kode', 'like', $request->id_kec . '%')
                ->whereRaw('LENGTH(kode) = 8')
                ->orderBy('nama')
                ->get();

            $data = view('ajax-select-kec', compact('states'))->render();
            return response()->json(['options' => $data]);
        }
    }
}

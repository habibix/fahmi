<?php

namespace App\Http\Controllers;

use App\Input;
use App\Singkapan;
use App\Wilayah;

use Excel;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input     = Input::all();
        $singkapan = Singkapan::all();

        return view('home')
            ->with('singkapan', $singkapan)
            ->with('input', $input);
    }

    public function single($id)
    {
        $wilayah = new Wilayah();

        $singkapan = Singkapan::where('input_id', $id)->get();
        $input = Input::findOrFail($id);
        $input->singkapan;

        $id_kec = explode('-', $input->kabupaten);
        $prov   = $wilayah->wilayah($input->provinsi);
        $kab    = $wilayah->wilayah($input->kabupaten);
        $kec    = $wilayah->wilayah($id_kec);

        return view('home-detail')

            ->with('data', $input)
            ->with('singkapan_arr', $singkapan)
            ->with('kab', $kab)
            ->with('kec', $kec)
            ->with('prov', $prov);
    }

    public function delete($id)
    {
        $path         = 'uploads/';
        $input        = Input::findOrFail($id);
        $input_attach = $input->singkapan;

        $input->delete();

        foreach ($input_attach as $key => $value) {
            $file = $value['singkapan_attach'];

            if (file_exists(public_path($path . $file))) {
                unlink(public_path($path . $file));
            }
        }

        return redirect()->back();
    }

    public function export()
    {
        $wilayah = new Wilayah();
        $counter = 1;
        $singkapan_data = Singkapan::all();
        $customer_data = Input::all();

        $singkapan_array[] = array(
            'NAMA',
            'NPM',
            'JUDUL',
            'LOKASI',
            'KECAMATAN',
            'KABUPATEN',
            'PROVINSI',
            'KEPERLUAN',
            'NORTH',
            'SOUTH',
            'EAST',
            'WEST',
            'KODE SINGKAPAN',
            'NAMA BATUAN',
            'JENIS BATUAN',
            'SINGKAPAN_LATITUDE',
            'SINGKAPAN_LONGITUDE',
            'SINGKAPAN_ELEVASI',
            'ATTACH',
            'TANGGAL',
        );

        $id = '';

        foreach ($singkapan_data as $key => $value) {

            if($id != $value->input->id) {
                $singkapan_array[] = array(
                    'nama' => $value->input->nama,
                    'npm' => $value->input->npm,
                    'judul' => $value->input->judul,
                    'lokasi' => $value->input->lokasi,
                    'kecamatan' => $value->input->kecamatan,
                    'kabupaten' => $value->input->kabupaten,
                    'provinsi' => $value->input->provinsi,
                    'keperluan' => $value->input->keperluan,
                    'north' => $value->input->north,
                    'south' => $value->input->south,
                    'east' => $value->input->east,
                    'west' => $value->input->west,
                    'singkapan_kode' => $value->singkapan_kode,
                    'singkapan_nama_batuan' => $value->singkapan_nama_batuan,
                    'singkapan_jenis_batuan' => $value->singkapan_jenis_batuan,
                    'singkapan_lat' => $value->singkapan_lat,
                    'singkapan_lng' => $value->singkapan_lng,
                    'singkapan_elevasi' => $value->singkapan_elevasi,
                    'singkapan_attach' => $value->singkapan_attach,
                    'created_at' => $value->created_at,
                );
                
            } else {
                $singkapan_array[] = array(
                    'nama' => '',
                    'npm' => '',
                    'judul' => '',
                    'lokasi' => '',
                    'kecamatan' => '',
                    'kabupaten' => '',
                    'provinsi' => '',
                    'keperluan' => '',
                    'north' => '',
                    'south' => '',
                    'east' => '',
                    'west' => '',
                    'singkapan_kode' => $value->singkapan_kode,
                    'singkapan_nama_batuan' => $value->singkapan_nama_batuan,
                    'singkapan_jenis_batuan' => $value->singkapan_jenis_batuan,
                    'singkapan_lat' => $value->singkapan_lat,
                    'singkapan_lng' => $value->singkapan_lng,
                    'singkapan_elevasi' => $value->singkapan_elevasi,
                    'singkapan_attach' => $value->singkapan_attach,
                    'created_at' => $value->created_at,
                );
            }

            $id = $value->input->id;

            /*if($key > 0){
                $singkapan_array[] = array(
                    'nama' => '',
                    'npm' => '',
                    'judul' => '',
                    'lokasi' => '',
                    'kecamatan' => '',
                    'kabupaten' => '',
                    'provinsi' => '',
                    'keperluan' => '',
                    'north' => '',
                    'south' => '',
                    'east' => '',
                    'west' => '',
                    'singkapan_kode' => $value->singkapan_kode,
                    'singkapan_nama_batuan' => $value->singkapan_nama_batuan,
                    'singkapan_jenis_batuan' => $value->singkapan_jenis_batuan,
                    'singkapan_lat' => $value->singkapan_lat,
                    'singkapan_lng' => $value->singkapan_lng,
                    'singkapan_elevasi' => $value->singkapan_elevasi,
                    'singkapan_attach' => $value->singkapan_attach,
                    'created_at' => $value->created_at,
                );
            } else {
                $singkapan_array[] = array(
                    'nama' => $value->input->nama,
                    'npm' => $value->input->npm,
                    'judul' => $value->input->judul,
                    'lokasi' => $value->input->lokasi,
                    'kecamatan' => $value->input->kecamatan,
                    'kabupaten' => $value->input->kabupaten,
                    'provinsi' => $value->input->provinsi,
                    'keperluan' => $value->input->keperluan,
                    'north' => $value->input->north,
                    'south' => $value->input->south,
                    'east' => $value->input->east,
                    'west' => $value->input->west,
                    'singkapan_kode' => $value->singkapan_kode,
                    'singkapan_nama_batuan' => $value->singkapan_nama_batuan,
                    'singkapan_jenis_batuan' => $value->singkapan_jenis_batuan,
                    'singkapan_lat' => $value->singkapan_lat,
                    'singkapan_lng' => $value->singkapan_lng,
                    'singkapan_elevasi' => $value->singkapan_elevasi,
                    'singkapan_attach' => $value->singkapan_attach,
                    'created_at' => $value->created_at,
                );
            }
        }*/
        
        /*foreach ($customer_data as $key => $customer) {

            $singkapan[] = $customer->singkapan[$key]['singkapan_kode'];
            $singkapan_nama_batuan[] = $customer->singkapan[$key]['singkapan_nama_batuan'];
            $singkapan_jenis_batuan[] = $customer->singkapan[$key]['singkapan_jenis_batuan'];
            $singkapan_latlng[] = $customer->singkapan[$key]['singkapan_lat'].', '.$customer->singkapan[$key]['singkapan_lat'];
            $singkapan_elevasi[] = $customer->singkapan[$key]['singkapan_elevasi'];
            $singkapan_attach[] = $customer->singkapan[$key]['singkapan_attach'];

            $id_kec = explode('-', $customer->kecamatan);

            $customer_array[] = array(
                'NO' => $counter++,
                'NAMA' => $customer->nama,
                'NPM' => $customer->npm,
                'JUDUL' => $customer->judul,
                'KEPERLUAN' => $customer->keperluan,
                'LOKASI' => $customer->lokasi,
                'KECAMATAN' => $wilayah->wilayah($id_kec)->nama,
                'KABUPATEN' => $wilayah->wilayah($customer->kabupaten)->nama,
                'PROVINSI' => $wilayah->wilayah($customer->provinsi)->nama,
                'NORTH' => $customer->north,
                'SOUTH' => $customer->south,
                'EAST' => $customer->east,
                'WEST' => $customer->west,
                //'SINGKAPAN KODE' => $sheet->fromArray($singkapan, null, 'A1', false, false)
                'SINGKAPAN KODE' => implode(",", $singkapan),
                'NAMA BATUAN' => implode(",", $singkapan_nama_batuan),
                'JENIS BATUAN' => implode(",", $singkapan_jenis_batuan),
                'LAT, LNG' => implode(",", $singkapan_latlng),
                'ELEVASI' => implode(",", $singkapan_elevasi),
                'ATTACHMENT' => implode(",", $singkapan_attach),
            );
        }*/
    }

        //return $singkapan_array;

        $time = date("d-M-Y");
        
        Excel::create('Export-'.$time, function ($excel) use ($singkapan_array) {
            $excel->setTitle('Customer Data');
            $excel->sheet('Customer Data', function ($sheet) use ($singkapan_array) {
                $sheet->fromArray($singkapan_array, null, 'A1', false, false);
            });
        })->download('xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Input;
use App\Singkapan;
use App\Wilayah;

use Illuminate\Http\Request;


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
        $input = Input::all();
        $singkapan = Singkapan::all();

        return view('home')
            ->with('singkapan', $singkapan)
            ->with('input', $input);
    }

    public function single($id){
        $wilayah = new Wilayah();

        $input = Input::findOrFail($id);
        $input->singkapan;

        $id_kec = explode('-', $input->kabupaten);
        $prov = $wilayah->wilayah($input->provinsi);
        $kab = $wilayah->wilayah($input->kabupaten);
        $kec = $wilayah->wilayah($id_kec);

        return view('home-detail')

            ->with('data', $input)
            ->with('kab', $kab)
            ->with('kec', $kec)
            ->with('prov', $prov);
    }

    function delete($id){
        $path = 'uploads/';
        $input = Input::findOrFail($id);
        $input_attach = $input->singkapan;

        $input->delete();

        foreach ($input_attach as $key => $value) {
            $file = $value['singkapan_attach'];

            if(file_exists(public_path($path.$file))){
              unlink(public_path($path.$file));
            }
        }

        return redirect()->back();
    }

    function export(){
     
     $input_data = DB::table('user')->get()->toArray();
     $customer_array[] = array('Customer Name', 'Address', 'City', 'Postal Code', 'Country');
     foreach($customer_data as $customer)
     {
      $customer_array[] = array(
       'Customer Name'  => $customer->CustomerName,
       'Address'   => $customer->Address,
       'City'    => $customer->City,
       'Postal Code'  => $customer->PostalCode,
       'Country'   => $customer->Country
      );
     }
     Excel::create('Customer Data', function($excel) use ($customer_array){
      $excel->setTitle('Customer Data');
      $excel->sheet('Customer Data', function($sheet) use ($customer_array){
       $sheet->fromArray($customer_array, null, 'A1', false, false);
      });
     })->download('xlsx');
    }
}

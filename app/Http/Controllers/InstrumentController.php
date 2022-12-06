<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstrumentController extends Controller
{
    public function index(){
        $title = "Daftar Instrument";
        $data = Instrument::all();
        $dataKriteria = Kriteria::all();
        return view('instrument.instrument',[
            'title' => $title,
            'data' => $data,
            'dataKriteria' => $dataKriteria
        ]);
    }

    public function add(){
        $title = "Tambah Instrument";
        $dataKriteria = Kriteria::all();
        return view('instrument.tambah_instrument', compact('dataKriteria','title'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "kriteria_id" => "required",
            "jenis" => "required",
            "no_urut" => "required",
            "no_butir" => "required",
            "bobot" => "required",
            "element" => "required",
            "descriptor" => "required",
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ],501);
        }
      
        $data = new Instrument();
        $data->kriteria_id = $request->kriteria_id;
        $data->jenis = $request->jenis;
        $data->no_urut = $request->no_urut;
        $data->no_butir = $request->no_butir;
        $data->bobot = $request->bobot;
        $data->element = $request->element;
        $data->descriptor = $request->descriptor;
        // dd($data);
        // $data->deskripsi = $request->deskripsi;
        $data->save();
        return redirect('/instrument')->with('success', 'Data Berhasil Ditambah');
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            "instrument" => "required",
            "deskripsi" => "required",
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ],501);
        }
        
        $data = Instrument::firstWhere('id',$request->id);
        if ($data){
            $data->instrument = $request->instrument;
            $data->deskripsi = $request->deskripsi;
            $data->update();
            return redirect('/instrument')->with('success', 'Data Berhasil Diubah');
        }else{
            return redirect('/instrument')->with('error', 'Data tidak tersedia');
        }
    }

    public function destroy(Request $request){
        $data = Instrument::findOrFail($request->id);
        $data->delete();
        return redirect('/instrument')->with('success', 'Data Berhasil Dihapus');
    }
}

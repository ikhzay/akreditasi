<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Kriteria;
use App\Models\Penilaian;
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
        $data->nilai = $request->radio1;
        $data->skor = ($data->nilai/4)*$data->bobot;

        $data->save();
        $instrument = Instrument::orderBy('created_at', 'DESC')->first();
        
        $pen = [
            [
                "instrument_id"=>$instrument->id,
                "deskripsi"=>$request->nilai4,
                "nilai"=>4,
                "keterangan"=>"Sangat Baik"
            ],
            [
                "instrument_id"=>$instrument->id,
                "deskripsi"=>$request->nilai3,
                "nilai"=>3,
                "keterangan"=>"Baik"
            ],
            [
                "instrument_id"=>$instrument->id,
                "deskripsi"=>$request->nilai2,
                "nilai"=>2,
                "keterangan"=>"Cukup"
            ],
            [
                "instrument_id"=>$instrument->id,
                "deskripsi"=>$request->nilai1,
                "nilai"=>1,
                "keterangan"=>"Kurang"
            ],
        ];

        foreach($pen as $p){
            $penilaian = new Penilaian();
            $penilaian->instrument_id = $p['instrument_id'];
            $penilaian->deskripsi = $p['deskripsi'];
            $penilaian->nilai = $p['nilai'];
            $penilaian->keterangan = $p['keterangan'];
            $penilaian->save();
        }
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
        $instrument = Instrument::findOrFail($request->id);
        $penilaian = Penilaian::where('instrument_id',$request->id)->get();
        $instrument->delete();
        foreach ($penilaian as $pen){
            $pen->delete();
        }
        return redirect('/instrument')->with('success', 'Data Berhasil Dihapus');
    }
}

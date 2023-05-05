<?php

namespace App\Http\Controllers;

use App\Imports\InstrumentImport;
use App\Models\Dokumen;
use App\Models\Instrument;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Node\Block\Document;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Maatwebsite\Excel\Facades\Excel;

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

    public function edit(Request $request){
        $title = "Edit Instrument";
        $instrument = Instrument::where('id',$request->id)->with('kriteria')->first();
        $kriteria = Kriteria::get();
        $document = Dokumen::where('instrument_id',$request->id)->get();
       
        return view('instrument.edit_instrument',[
            'instrument'=>$instrument,
            'dataKriteria' => $kriteria,
            'document' => $document,
            'title' => $title
            ]
        );
    }

    public function store(Request $request){
        // return response()->json($request);

        $validator = Validator::make($request->all(),[
            "kriteria_id" => "required",
            "jenis" => "required",
            "no_urut" => "required",
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
        if($request->id_dok != ''){
            foreach($request->id_dok as $dok){
                $document = Dokumen::where('id',$dok)->first();
                $document->instrument_id = $instrument->id;
                $document->update();
            }
        }
        
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
        
        // return $request;
        $validator = Validator::make($request->all(),[
            "kriteria_id" => "required",
            "jenis" => "required",
            "no_urut" => "required",
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


        if ($request->id_dok){
            foreach($request->id_dok as $dok){
                $document = Dokumen::where('id',$dok)->first();
                $document->instrument_id = $request->id;
                $document->update();
            }
        }
        
        $data = Instrument::firstWhere('id',$request->id);
        if ($data){
            $data->kriteria_id = $request->kriteria_id;
            $data->jenis = $request->jenis;
            $data->no_urut = $request->no_urut;
            $data->no_butir = $request->no_butir;
            $data->bobot = $request->bobot;
            $data->element = $request->element;
            $data->descriptor = $request->descriptor;
            $data->nilai = $request->radio1;
            $data->skor = ($data->nilai/4)*$data->bobot;
            $data->penilaian[0]->deskripsi = $request->nilai4;
            $data->penilaian[1]->deskripsi = $request->nilai3;
            $data->penilaian[2]->deskripsi = $request->nilai2;
            $data->penilaian[3]->deskripsi = $request->nilai1;
        
            foreach($data->penilaian as $p){
                $penilaian = Penilaian::where('id',$p['id'])->first();
                $penilaian->deskripsi = $p['deskripsi'];
                $penilaian->update();
            }

            $data->update();
            return redirect('/instrument')->with('success', 'Data Berhasil Diubah');
        }else{
            return redirect('/instrument')->with('error', 'Data tidak tersedia');
        }
    }

    public function importInstrument(Request $request){
        // return $request->kriteria_id;
        $arr = explode("\r\n", $request->file);
        // return $arr;
        $data = new Instrument();
        $data->kriteria_id = $request->kriteria_id;
        $data->jenis = $arr[0];
        $data->no_urut = $arr[1];
        $data->no_butir = $arr[2];
        $data->bobot = $arr[3];
        $data->element = $arr[4];
        $data->descriptor = $arr[5];
        $data->nilai = $arr[10];
        $data->skor = ($data->nilai/4)*$data->bobot;
        // return $data;
        $data->save();
        $instrument = Instrument::orderBy('created_at', 'DESC')->first();
        // if($request->id_dok != ''){
        //     foreach($request->id_dok as $dok){
        //         $document = Dokumen::where('id',$dok)->first();
        //         $document->instrument_id = $instrument->id;
        //         $document->update();
        //     }
        // }
        
        $pen = [
            [
                "instrument_id"=>$instrument->id,
                "deskripsi"=>$arr[6],
                "nilai"=>4,
                "keterangan"=>"Sangat Baik"
            ],
            [
                "instrument_id"=>$instrument->id,
                "deskripsi"=>$arr[7],
                "nilai"=>3,
                "keterangan"=>"Baik"
            ],
            [
                "instrument_id"=>$instrument->id,
                "deskripsi"=>$arr[8],
                "nilai"=>2,
                "keterangan"=>"Cukup"
            ],
            [
                "instrument_id"=>$instrument->id,
                "deskripsi"=>$arr[9],
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
    
    public function filterInstrument($kriteria,$nilai,$no_urut){
        if ($kriteria == ''){
            $data = Instrument::where([
                'nilai' => $nilai,
                'no_urut' => $no_urut
            ])->get();
        }
        else if ($nilai == ''){
            $data = Instrument::where([
                'kriteria_id' => $kriteria,
                'no_urut' => $no_urut
            ])->get();
        }
        else if ($nilai == ''){
            $data = Instrument::where([
                'kriteria_id' => $kriteria,
                'nilai' => $nilai,
                'no_urut' => $no_urut
            ])->get();
        }
        return response()->json([
            'status'=>'success',
            'messages' => 'Fiter Of Instrument',
            'data' => $data
        ]);
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

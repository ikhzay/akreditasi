<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Instrument;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Node\Block\Document;

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
        // return response()->json([
        //     'instrument'=>$instrument,
        //     'dataKriteria' => $kriteria,
        //     'document' => $document,
        //     'title' => $title
        // ], 200);
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
        foreach($request->id_dok as $dok){
            $document = Dokumen::where('id',$dok)->first();
            $document->instrument_id = $instrument->id;
            $document->update();
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
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'File Uploaded',
        //     'data' => $data
        // ], 200);
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

    public function filterInstrument($kriteria,$nilai){
        $data = Instrument::where([
            'kriteria_id'=>$kriteria,
            'nilai' => $nilai
        ])->get();
        
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

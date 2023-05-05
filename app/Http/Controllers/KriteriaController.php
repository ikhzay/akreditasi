<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    public function index(){
        $title = "Daftar Kriteria";
        $data = Kriteria::all();
        return view('kriteria.kriteria',compact('title', 'data'));
    }

    public function store(Request $request){
         $validator = Validator::make($request->all(),[
            "kriteria" => "required",
            "deskripsi" => "required",
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ],501);
        }
      
        $data = new Kriteria();
        $data->kriteria = $request->kriteria;
        $data->deskripsi = $request->deskripsi;
        $data->save();
        return redirect('/kriteria')->with('success', 'Data Berhasil Ditambah');
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            "kriteria" => "required",
            "deskripsi" => "required",
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ],501);
        }
        
        $data = Kriteria::firstWhere('id',$request->id);
        if ($data){
            $data->kriteria = $request->kriteria;
            $data->deskripsi = $request->deskripsi;
            $data->update();
            return redirect('/kriteria')->with('success', 'Data Berhasil Diubah');
        }else{
            return redirect('/kriteria')->with('error', 'Data tidak tersedia');
        }
    }

    public function destroy(Request $request){
        $data = Kriteria::findOrFail($request->id);
        $data->delete();
        return redirect('/kriteria')->with('success', 'Data Berhasil Dihapus');
    }
}

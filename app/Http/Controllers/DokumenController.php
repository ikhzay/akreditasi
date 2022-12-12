<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokumenController extends Controller
{
    public function tes(){
        return "hhhh";
    }
    public function uploadFile(Request $request){
        // return "OK";
        $request->validate([
            'keterangan' =>'required',
            'file' => 'required|mimes:doc,docx,pdf,zip,rar|max:2048',
        ]);
        
        $fileName = time().'.'.$request->file->extension();  
         
        $request->file->move(public_path('file'), $fileName);
      
        $data = Dokumen::create(['nama' => $fileName,'keterangan' => $request->keterangan]);
        return response()->json([
            'status' => 'success',
            'message' => 'File Uploaded',
            'data' => $data
        ], 200);
    }
  
}

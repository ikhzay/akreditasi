<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Node\Block\Document;

class DokumenController extends Controller
{
    public function openFile(Request $request){
        // return "hhhh"; 
        return response()->file('http://127.0.0.1:8000/file/1671417194.pdf');
    }

    public function getDocument(Request $request){
        $data = Dokumen::where('instrument_id',$request->id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Detail Document',
            'data' => $data
        ], 200);
    }

    public function uploadFile(Request $request){
        // return "OK";
        $request->validate([
            'keterangan' =>'required',
            'file' => 'mimes:doc,docx,pdf,zip,rar|max:2048',
        ]);
        
        if ($request->file ==null){
            $fileName = null;  
            
            // $request->file->move(public_path('file'), $fileName);
            // $request->file('file')->storeAs('public', $fileName);
        
            $data = Dokumen::create(['nama' => $fileName,'keterangan' => $request->keterangan]);
            return response()->json([
                'status' => 'success',
                'message' => 'File Uploaded',
                'data' => $data
            ], 200);
        }else{
            $fileName = 'fileDocument/'.time().'.'.$request->file->extension();  
            
            // $request->file->move(public_path('file'), $fileName);
            $request->file('file')->storeAs('public', $fileName);
        
            $data = Dokumen::create(['nama' => $fileName,'keterangan' => $request->keterangan]);
            return response()->json([
                'status' => 'success',
                'message' => 'File Uploaded',
                'data' => $data
            ], 200);
        }


        
    }

    public function destroy(Request $request){
        $data = Dokumen::findOrFail($request->id);
        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Dokumen Deleted',
            'data' => null
        ], 201);
    }
}

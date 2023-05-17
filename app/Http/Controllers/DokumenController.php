<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Node\Block\Document;

class DokumenController extends Controller
{
    public function getDocument(Request $request)
    {
        $data = Dokumen::where('instrument_id', $request->id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Detail Document',
            'data' => $data
        ], 200);
    }

    public function get(Request $request)
    {
        $data = Dokumen::where('id', $request->id)->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Detail Document',
            'data' => $data
        ], 200);
    }

    public function uploadFile(Request $request)
    {
        // return "OK";
        $request->validate([
            'keterangan' => 'required',
            'file' => 'mimes:doc,docx,pdf,zip,rar|max:2048',
        ]);

        $data = new Dokumen;
        if ($request->file == null) {
            if ($request->link != null) {
                $fileName = $request->link;
            } else {
                $fileName = null;
            }

            // $request->file->move(public_path('file'), $fileName);
            // $request->file('file')->storeAs('public', $fileName);

            // $data = Dokumen::create(['nama' => $fileName, 'keterangan' => $request->keterangan]);
            $data->nama = $fileName;
            $data->keterangan = $request->keterangan;
            $data->save();
            return response()->json([
                'status' => 'success',
                'message' => 'File Uploaded',
                'data' => $data
            ], 200);
        } else {
            $fileName = time() . '.' . $request->file->extension();

            // $request->file->move(public_path('file'), $fileName);
            $request->file('file')->storeAs('public/fileDocument', $fileName);

            // $data = Dokumen::create(['nama' => $fileName, 'keterangan' => $request->keterangan]);
            $data->nama = $fileName;
            $data->keterangan = $request->keterangan;
            $data->save();
            return response()->json([
                'status' => 'success',
                'message' => 'File Uploaded',
                'data' => $data
            ], 200);
        }
    }

    public function uploadFileEdit(Request $request)
    {
        // return "OK";
        $request->validate([
            'keterangan_edit' => 'required',
            'file_edit' => 'mimes:doc,docx,pdf,zip,rar|max:2048',
        ]);

        $data = Dokumen::firstWhere('id', $request->id_edit);

        // return $data;
        if ($request->file_edit == null) {
            // if ($data->nama == null) {
            if ($request->link_edit != null) {
                if ($data->nama != null) {
                    Storage::delete('public/fileDocument/' . $data->nama);
                }
                $fileName = $request->link_edit;
            } else {
                $fileName = null;
            }
            // }

            $data->nama = $fileName;
            $data->keterangan = $request->keterangan_edit;
            $data->update();
        } else {
            Storage::delete('public/fileDocument/' . $data->nama);

            $fileName = time() . '.' . $request->file_edit->extension();

            $request->file('file_edit')->storeAs('public/fileDocument', $fileName);
            $data->nama = $fileName;
            $data->keterangan = $request->keterangan_edit;
            $data->update();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'File Uploaded',
            'data' => $data
        ], 200);
    }

    public function destroy(Request $request)
    {
        $data = Dokumen::findOrFail($request->id);
        // dd($data);
        // unlink($data->nama);
        Storage::delete('public/fileDocument/' . $data->nama);
        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Dokumen Deleted',
            'data' => null
        ], 201);
    }
}

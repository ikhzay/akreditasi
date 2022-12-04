<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function list_menu()
    {
        $title = "Daftar Menu";
        $dataMenu = Menu::all();
        // dd($dataMenu);
        return view("fitur.list_menu", compact("dataMenu", "title"));
    }

    public function tambah_menu(Request $req)
    {
        // dd($req);
        $this->validate(
            $req,
            ['nama_menu' => 'required|unique:menus,nama_menu'],
            ['nama_menu.unique' => 'Nama menu telah tersedia!']
        );

        $hasil = [
            'nama_menu' => $req['nama_menu'],
            'link' => $req['link'],
        ];

        Menu::create($hasil);
        return redirect('/menu')->with('success', 'Data Berhasil Ditambah');
    }


    public function edit_menu(Request $req)
    {
        // dd($req);
        $data = Menu::findOrFail($req['id']);

        if ($data->nama_menu != $req['nama_menu']) {
            $this->validate(
                $req,
                ['nama_menu' => 'required|unique:menus,nama_menu'],
                ['nama_menu.unique' => 'Nama menu telah tersedia!']
            );
        }

        $hasil = [
            'nama_menu' => $req['nama_menu'],
            'link' => $req['link'],
        ];

        Menu::all()->where('id_menu', $req['id'])->first()->update($hasil);

        return redirect('/menu')->with('success', 'Data Berhasil Diubah');
    }

    public function hapus_menu(Request $req)
    {
        $data = Menu::findOrFail($req['id']);
        DB::table('sub_menus')->where('id_menu', $req['id'])->delete();
        $data->delete();

        return redirect('/menu')->with('success', 'Data Berhasil Dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubMenuController extends Controller
{
    public function list_submenu() {
        $title = "Daftar Sub menu";
        $dataMenu = Menu::all();
        $dataSubmenu = DB::table('sub_menus')
        ->select(['menus.nama_menu','sub_menus.*'])
        ->leftJoin('menus', 'sub_menus.id_menu', '=', 'menus.id_menu')
        ->get();
        // DB::select('SELECT sub_menus.*, menus.nama_menu FROM sub_menus LEFT JOIN menus ON sub_menus.id_menu = menus.id_menu');
        

        // dd($dataSubmenu);
        return view("fitur.list_submenu",[
            'dataMenu' => $dataMenu,
            'dataSubmenu' => $dataSubmenu,
            'title' => $title
        ]);
    }
    
    public function tambah_submenu(Request $req)
    {
        // dd($req);
        $this->validate(
            $req,
            ['nama_submenu' => 'required|unique:sub_menus,nama_submenu'],
            ['nama_submenu.unique' => 'Nama sub menu telah tersedia!']
        );
        
        $hasil = [
            'id_menu' => $req['id_menu'],
            'nama_submenu' => $req['nama_submenu'],
            'link_submenu' => $req['link_submenu'],
        ];

        SubMenu::create($hasil);
        return redirect('/submenu')->with('success', 'Data Berhasil Ditambah');
    }


    public function edit_submenu(Request $req)
    {
        // dd($req);
        $data = SubMenu::findOrFail($req['id']);

        if ($data->nama_submenu != $req['nama_submenu']) {
            $this->validate(
                $req,
                ['nama_submenu' => 'required|unique:sub_menus,nama_submenu'],
                ['nama_submenu.unique' => 'Nama sub menu telah tersedia!']
            );
        }


        $hasil = [
            'id_menu' => $req['id_menu'],
            'nama_submenu' => $req['nama_submenu'],
            'link_submenu' => $req['link_submenu'],
        ];

        SubMenu::all()->where('id_submenu', $req['id'])->first()->update($hasil);

        return redirect('/submenu')->with('success', 'Data Berhasil Diubah');
    }

    public function hapus_submenu(Request $req)
    {
        $data = SubMenu::findOrFail($req['id']);
        $data->delete();

        return redirect('/submenu')->with('success', 'Data Berhasil Dihapus');
    }

}

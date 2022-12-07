<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Kriteria;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $dataMenu = Menu::all();
        $dataSubmenu = SubMenu::all();
        $data = DB::select('SELECT menus.* FROM menus LEFT JOIN sub_menus ON menus.id_menu = sub_menus.id_menu');
        
        return view('home2',[
            'title' => 'Link - Tree',
            'data' => $data,
            'dataMenu' => $dataMenu,
            'dataSubmenu' => $dataSubmenu
        ]);
    }

    public function mainpage(){
        $data = Kriteria::with('instrument')->get();
        // return response()->json([
        //     'data' => $data
        // ], 200);
         
        return view('mainpage',[
            'title' => 'Main Page',
            'data' => $data
        ]);
    }

    public function tampil_profil()
    {
        $loc = "";
        return view('fitur.profil',[
            'loc' => $loc
        ]);
    }

    public function tampil_login()
    {
        return view('Auth.login',[
            'title' => 'login page'
        ]);
    }

    public function login(Request $request)
    {
        $data = [
            'username'     => $request->input('username'),
            'password'  => $request->input('password'),
        ];


        Auth::attempt($data);
        // dd(Auth::user());
        // echo Auth::user()->username;
        if (Auth::attempt($data)) { // true sekalian session field di users nanti bisa dipanggil via Auth
            // echo "Login Success";
            return redirect('/menu');
        } else { // false
            //Login Fail
            return redirect('/login')->with('message', 'Username atau password salah');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login')->with('success', 'Berhasil Logout!');
    }
    
}

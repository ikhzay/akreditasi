<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Kriteria;
use App\Models\Menu;
use App\Models\SubMenu;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function ss(){
        $client = new Client();
        $response = $client->request('GET', 'https://prasarana.unram.ac.id/index.php/api/sia/ruang?number=-1&__csrf=P25sigHhPqKyeo');
        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        
        $kode = [];
        $f_nama = [];
        foreach($data as $dd){
            array_push($kode, $dd->fakultas_kode);
            array_push($f_nama, $dd->_fakultas_nama);
        }

        $u_kode = array_unique($kode);
        $u_nama = array_unique($f_nama);
        $kk = [];
        $nm = [];
        foreach($u_kode as $k){
            array_push($kk,$k);
        }

        foreach($u_nama as $n){
            array_push($nm,$n);
        }

        $jml_arr = count($nm);
        $object = [];
        for($i=0 ; $i<$jml_arr ; $i++){
            $object[] = (object) [
                'kode' => $kk[$i],
                'nama' => $nm[$i],
              ];
        }
        return $object;
    }

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
            'title' => 'PSTI',
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
            return redirect('/kriteria');
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

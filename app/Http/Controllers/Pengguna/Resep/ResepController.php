<?php

namespace App\Http\Controllers\Pengguna\Resep;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use function GuzzleHttp\json_encode;

class ResepController extends Controller
{
    // public function index(Request $request) {

    //     $data = NULL;

    //     if($request->session()->exists('id_resep')) {

    //         $data = DB::table('tbl_resep')->where('id_resep', session('id_resep'))->first();

    //     }

    //     return view('pengguna.resep.resep', ['data_resep' => (!is_null($data) ? $data : null)]);
    // }

    public function index() {


        //if(session()->has('email_pengguna'))
        {
            $resep = DB::table('tbl_resep')->get();
            //dd($resep);
            return view('pengguna.resep.resep', [
                'resep' => $resep,
            ]);

        } //else {

            //return redirect()->route('login')->withErrors('Harus Login Terlebih Dahulu');

        //}

     }
    // public function index(){
    //     return view ('pengguna.resep.resep');
    // echo "ghjjk";}


    public function delete(Request $request, $id_resep){

        if($request->has('simpan')) {

            $data = DB::table('tbl_resep')->where([
                ['id_resep', $id_resep],
            ]);

            if($data->exists()){

                $data->delete();

                return back()->with('success', 'menu berhasil di hapus dari resep');

            } else {

                return back()->withErrors('Terjadi kesalahan saat menyimpan, menu tidak ditemukan!');

            }
        }

    }

}

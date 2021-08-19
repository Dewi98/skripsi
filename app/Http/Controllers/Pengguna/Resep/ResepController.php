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

    public function index(Request $request) {


        //if(session()->has('email_pengguna'))
        {
            DB::table('resep')
                ->join('tbl_resep as resep', '=',  'resep.resep_id')
                ->select('resep.nama', 'resep.bahan', 'resep.id_resep')
                ->where('resep.id_resep', '=', $id_resep)// 'resep.nama' session('id_resep'))
                ->get();

                // DB::table('tbl_resep')
                // ->join('tbl_resep as resep', 'resep.id')
                // ->select('resep.*')
                // ->get();

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

<?php

namespace App\Http\Controllers\Admin\Resep;

use DateTime;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ResepController extends Controller
{
    public function index(Request $request) {

        if($request->session()->exists('email_admin')) {

            $data = DB::table('tbl_resep')->get();

            return view('admin.resep.resep', ['data_resep' => $data]);

        } else {

            return redirect()->route('login_admin');

        }
    }

    public function tambah_resep(Request $request) {

        if($request->has('simpan')) {

            $validasi = Validator::make($request->all(), [
                'nama_resep' => 'required|regex:/^[a-zA-Z\s]*$/|max:30'
            ]);

            if ($validasi->fails()) {

                return back()->withErrors($validasi);

            }

            if(DB::table('tbl_resep')->where('nama_resep', $request->input('nama_resep'))->exists() == false) {

                DB::table('tbl_resep')->insert([
                    'id_resep'   => $this->set_id_resep(),
                    'nama_resep' => $request->input('nama_resep'),
                ]);

                return redirect()->route('resep')->with('success', 'resep Berhasil Di Tambah');

            } else {

                return back()->withErrors('resep tidak dapat di gunakan karna telah tersedia');

            }

        } else {

            return back()->withErrors('Terjadi Kesalahan Saat Menyimpan Harap Gunakan Tombol Simpan Untuk Menyimpan Data');

        }

    }

    public function edit_resep(Request $request, $id_resep) {

        if($request->has('simpan')) {

            $validasi = Validator::make($request->all(), [
                'nama_resep' => 'required|regex:/^[a-zA-Z\s]*$/|max:30'
            ]);

            if ($validasi->fails()) {

                return back()->withErrors($validasi);

            }

            if(DB::table('tbl_resep')->where('nama_resep', $request->input('nama_resep'))->exists() == false) {

                DB::table('tbl_resep')->where('id_resep', $id_resep)
                    ->update(['nama_resep' => $request->input('nama_resep')]);

                return redirect()->route('resep')->with('success', 'Resep Berhasil Di Rubah');

            } else {

                return redirect()->route('resep')->withErrors('Resep tidak dapat di gunakan karna telah tersedia');

            }

        } else {

            return back()->withErrors('Terjadi Kesalahan Saat Menyimpan Harap Gunakan Tombol Simpan Untuk Menyimpan Data');

        }
    }

    public function hapus_resep(Request $request, $id_resep) {

        if($request->has('simpan')) {

            DB::table('tbl_resep')->where('id_resep', $id_resep)->delete();

            return redirect()->route('resep')->with('success', 'Resep Berhasil Di Hapus');

        } else {

            return back()->withErrors('Terjadi Kesalahan Saat Menyimpan Harap Gunakan Tombol Simpan Untuk Menyimpan Data');

        }

    }

    public function get_resep(Request $request) {

        $id_resep = $request->input('id_resep');

        $data = DB::table('tbl_resep')->where('id_resep', $id_resep)->first();

        return response()->json($data);
    }

    protected function set_id_resep() {
        $data = DB::table('tbl_resep')->max('id_resep');

        if(!empty($data)) {

            $no_urut = substr($data, 9, 3) + 1;

            return 'RSP'.(new Datetime)->format('ymd').$no_urut;
        } else {
            return 'RSP'.(new Datetime)->format('ymd').'1';
        }
    }
}

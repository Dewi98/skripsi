<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Midtrans extends Model
{
    protected $table = 'tbl_midtrans';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = ['id_pembayaran', 'nama','telepon', 'alamat', 'total', 'status'];
    public $incrementing = false;
    public $timestamps = false;
}

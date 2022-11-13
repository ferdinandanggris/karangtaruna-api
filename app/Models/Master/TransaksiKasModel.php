<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKasModel extends Model
{
    use HasFactory;

    protected $table = "m_transaksi_kas";
    protected $primaryKey = "id";
    protected $fillable = ["tanggal", "keterangan", "tipe", "total"];
}

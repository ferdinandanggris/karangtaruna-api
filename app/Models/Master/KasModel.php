<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasModel extends Model
{
    use HasFactory;

    protected $table = "m_kas";
    protected $primaryKey = "id";
    protected $fillable = ['nama', 'total'];
}

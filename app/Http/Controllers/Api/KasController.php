<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Master\KasModel;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index()
    {
        return response()
            ->json(
                [
                    "status" => true,
                    "data" => KasModel::all()
                ]
            );
    }
}

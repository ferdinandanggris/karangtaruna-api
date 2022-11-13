<?php

namespace App\Http\Controllers\Api;

use App\Helpers\TransaksiKasHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\TransaksiKasModel;
use App\Http\Requests\TransaksiKas\CreateRequest;
use App\Http\Requests\TransaksiKas\UpdateRequest;

class TransaksiKasController extends Controller
{
    protected $transaksiKasModel;
    protected $transaksiKasHelper;

    public function __construct()
    {
        $this->transaksiKasModel = new TransaksiKasModel();
        $this->transaksiKasHelper = new TransaksiKasHelper();
    }

    public function index()
    {
        return response(
            [
                'status' => true,
                'data' => TransaksiKasModel::all()
            ]
        );
    }

    public function store(CreateRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response($request->validator->errors(), 422);
        }
        $dataInput = $request->only(['tanggal', 'tipe', 'keterangan', 'total']);
        return $this->transaksiKasHelper->create($dataInput);
    }

    public function update(UpdateRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response($request->validator->errors(), 422);
        }

        $dataInput = $request->only(['tanggal', 'tipe', 'keterangan', 'total']);
        return $this->transaksiKasHelper->update($dataInput, $id);
    }

    public function show($id)
    {
        $data = $this->transaksiKasModel->find($id);
        if ($data) {
            return response(
                [
                    'status' => true,
                    'data' => $this->transaksiKasModel->find($id)
                ]
            );
        }
        return response(
            [
                'status' => false,
                'message' => 'data tidak ditemukan!'
            ],
            422
        );
    }

    public function destroy($id)
    {
        return $this->transaksiKasHelper->delete($id);
    }
}

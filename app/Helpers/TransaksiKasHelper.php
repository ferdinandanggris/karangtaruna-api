<?php

namespace App\Helpers;

use Exception;
use App\Models\Master\KasModel;
use App\Models\Master\TransaksiKasModel;

class TransaksiKasHelper
{
    protected $transaksiKasModel;

    public function __construct()
    {
        $this->transaksiKasModel = new TransaksiKasModel();
    }

    public function create(array $payload)
    {
        try {
            $saldo = (KasModel::all())[0]['total'];
            $saldoNew =  $saldo + ($payload['tipe'] == 'masuk' ? $payload['total'] : -$payload['total']);
            if ($saldoNew < 0) {
                throw new Exception("Saldo kas tidak cukup !", 1);
            }
            (new KasModel())->find(1)->update(['total' => $saldoNew]);
            $data = $this->transaksiKasModel->create($payload);
            return response([
                'status' => true,
                'message' => 'Berhasil menambahkan data!',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'status' => 'false',
                'message' => $th->getMessage()
            ], 422);
        }
    }

    public function update(array $payload, $id)
    {
        try {
            $oldTransaksi = $this->transaksiKasModel->find($id);
            if (!$oldTransaksi) {
                throw new Exception("Data tidak ditemukan!", 1);
            }
            $saldo = (KasModel::all())[0]['total'];
            $saldoNew =  $saldo + ($oldTransaksi['tipe'] == 'masuk' ? -$oldTransaksi['total'] : $oldTransaksi) + ($payload['tipe'] == 'masuk' ? $payload['total'] : -$payload['total']);
            if ($saldoNew < 0) {
                throw new Exception("Saldo kas tidak cukup !", 1);
            }
            (new KasModel())->find(1)->update(['total' => $saldoNew]);
            $data = $this->transaksiKasModel->find($id)->update($payload);
            return response([
                'status' => true,
                'message' => 'Berhasil mengupdate data!',
                'data' => $this->transaksiKasModel->find($id)
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'status' => 'false',
                'message' => $th->getMessage()
            ], 422);
        }
    }

    public function delete($id)
    {
        try {
            $oldTransaksi = $this->transaksiKasModel->find($id);
            if ($oldTransaksi == null) {
                throw new Exception("Data tidak ditemukan!", 1);
            }
            $saldo = (KasModel::all())[0]['total'];
            $saldoNew =  $saldo + ($oldTransaksi['tipe'] == 'masuk' ? -$oldTransaksi['total'] : $oldTransaksi['total']);
            if ($saldoNew < 0) {
                throw new Exception("Saldo kas tidak cukup !", 1);
            }
            (new KasModel())->find(1)->update(['total' => $saldoNew]);
            $this->transaksiKasModel->destroy($id);
            return response(
                [
                    'status' => true,
                    'message' => 'Berhasil menghapus data!'
                ]
            );
        } catch (\Throwable $th) {
            return response(
                [
                    'status' => false,
                    'message' => $th->getMessage()
                ],
                422
            );
        }
    }
}

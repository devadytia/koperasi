<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKoperasiRequest;
use Illuminate\Http\Request;
use App\Models\Cooperative;

class KoperasiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Cooperative::query();

            if ($request->has('date_transaction')) {
                $query->whereDate('tanggal_transaksi', $request->query('date_transaction'));
            }

            if ($request->has('name')) {
                $query->where('npk', 'like', '%' . $request->query('name') . '%');
            }

            if ($request->has('type') && $request->type != "") {
                $query->where('bayar', $request->query('type'));
            }

            $data = $query->get();

            return response()->json([
                'status' => true,
                'messages' => 'Berhasil ambil data koperasi',
                'data'   => $data,
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'messages' => $e->getMessage(),
                'data'   => [],
            ]);
        }
    }

    public function store(StoreKoperasiRequest $request)
    {
        try {
            $cooperative = new Cooperative;
            $cooperative->qty = $request->qty;
            $cooperative->tanggal_transaksi = now();
            $cooperative->harga = $request->harga;
            $cooperative->bayar = $request->bayar;
            $cooperative->npk = $request->npk;
            $cooperative->kode = $request->itemCode;
            $cooperative->save();

            return response()->json([
                'status' => true,
                'messages' => 'Berhasil store data koperasi',
                'data'   => $request->all(),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'messages' => $e->getMessage(),
                'data'   => [],
            ]);
        }
    }

    public function update(StoreKoperasiRequest $request, $code)
    {
        try {
            $cooperative = Cooperative::find($code);
            $cooperative->qty = $request->qty;
            $cooperative->tanggal_transaksi = now();
            $cooperative->harga = $request->harga;
            $cooperative->bayar = $request->bayar;
            $cooperative->npk = $request->npk;
            $cooperative->kode = $request->itemCode;
            $cooperative->save();

            return response()->json([
                'status' => true,
                'messages' => 'Berhasil update data koperasi',
                'data'   => $request->all(),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'messages' => $e->getMessage(),
                'data'   => [],
            ]);
        }
    }

    public function find($code) {
        try {
            $cooperative = Cooperative::find($code);

            if (! $cooperative) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan',
                    'data' => [],
                ], 404);
            }

            return response()->json([
                'status' => true,
                'messages' => 'Berhasil store data koperasi',
                'data'   => $cooperative,
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'messages' => $e->getMessage(),
                'data'   => [],
            ]);
        }
    }

    public function delete($code) {
        try {

            $cooperative = Cooperative::find($code);

            if (!$cooperative) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan',
                    'data' => [],
                ], 404);
            }

            $cooperative->delete();

            return response()->json([
                'status' => true,
                'messages' => 'Berhasil store data koperasi',
                'data'   => [],
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'messages' => $e->getMessage(),
                'data'   => [],
            ]);
        }
    }
}

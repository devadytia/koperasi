<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => true,
                'messages' => 'Berhasil ambil data karyawan',
                'data'   => Employee::select('id', 'nama', 'npk')->get(),
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

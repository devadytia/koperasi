<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status' => true,
                'messages' => 'Berhasil ambil data item',
                'data'   => Item::get(),
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

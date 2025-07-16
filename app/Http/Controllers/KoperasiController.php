<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKoperasiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KoperasiController extends Controller
{
    public function index(Request $request) {
        try {
            $koperasi = Http::acceptJson()->get(route('api.koperasi.index'), [                             // query parameters
                'date_transaction'   => $request->query('date_transaction'),
                'name' => $request->query('name'),
                'type' => $request->query('type'),
            ])->throw();
    
            $koperasi = $koperasi->json('data');

            $employee = Http::acceptJson()->get(route('api.employee.index'))->throw();
    
            $employee = $employee->json('data');

            return view('pages.koperasi.index', compact('koperasi', 'employee'));
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function create(Request $request) {
        try {
            $item = Http::acceptJson()->get(route('api.item.index'))->throw();
    
            $dataItem = $item->json('data');

            $employee = Http::acceptJson()->get(route('api.employee.index'))->throw();
    
            $employee = $employee->json('data');

            return view('pages.koperasi.create', compact('employee', 'dataItem'));
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function edit(Request $request, $code) {
        try {
            $item = Http::acceptJson()->get(route('api.koperasi.edit', ['code' => $code]))->throw();
    
            $dataItem = $item->json('data');

            $item = Http::acceptJson()->get(route('api.item.index'))->throw();
    
            $dataItem = $item->json('data');

            $employee = Http::acceptJson()->get(route('api.employee.index'))->throw();
    
            $employee = $employee->json('data');

            return view('pages.koperasi.create', compact('employee', 'dataItem'));
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }

}

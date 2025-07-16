@extends('layouts.master')

@section('content')
<div class="relative overflow-x-auto  sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <div class="flex items-center justify-between">
            <div class="py-5 text-lg font-semibold text-left rtl:text-right text-gray-900  ">
                Koperasi Index
            </div>
            <a href="{{ route('create') }}" class="text-sm/6 font-semibold px-4 py-2 rounded-md bg-blue-600 text-white">+ Tambah Transaksi</a>
        </div>

        <form class=" space-y-2">
            <div class="flex items-center ">
                <div class="w-24">
                    <label class="text-xs ">Tanggal</label>
                </div>
                <input type="date" name="date_transaction" value="{{ request()->query('date_transaction') }}" class="col-start-1 row-start-1 w-36 appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-xs/6">
            </div>
            <div class="flex items-center ">
                <div class="w-24">
                    <label class="text-xs">Name</label>
                </div>
                <select name="name" autocomplete="name" class="col-start-1 row-start-1 w-36 appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-xs/6">
                    <option default value="" selected>Pilih Nama</option>
                    @foreach($employee as $item)
                        <option value="{{ $item['npk'] }}" @if(request()->query('name') == $item['npk']) selected @endif>{{ $item['npk'] .' - '. $item['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center w-full">
                <div class="w-24">
                    <label class="text-xs ">Type Bayar</label>
                </div>
                <select name="type" autocomplete="type" class="col-start-1 row-start-1 w-36 appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-xs/6">
                    <option default value="" selected>Pilih Type Bayar</option>
                    <option value="1"  @if(request()->query('type') == 1) selected @endif>Bayar</option>
                    <option value="0"  @if(request()->query('type') != "" && request()->query('type') == 0) selected @endif>Cicil</option>
                </select>
            </div>

            <div class="pr-8 mt-2 mb-6 flex items-center justify-end w-68  gap-x-3">
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Search</button>
                @if(request()->query())
                <a href="{{ route('index') }}" class="text-sm/6 font-semibold text-gray-900 border border-gray-300 px-3 py-2 rounded-md">Clear</a>
                @endif
              </div>
        </form>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50  dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    NPK
                </th>
                <th scope="col" class="px-6 py-3">
                    Tanggal Transaksi
                </th>
                <th scope="col" class="px-6 py-3">
                    Kode
                </th>
                <th scope="col" class="px-6 py-3">
                    Qty
                </th>
                <th scope="col" class="px-6 py-3">
                    Harga
                </th>
                <th scope="col" class="px-6 py-3">
                    Bayar
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($koperasi as $item)
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item['npk'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ date($item['tanggal_transaksi']) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item['kode'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item['qty'] }}
                    </td>
                    <td class="px-6 py-4">
                       Rp {{ number_format($item['harga'], 0,  ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item['bayar'] ? '1' : '0' }}
                    </td>
                    <td class="px-6 py-4 text-right gap-8">
                        <a href="{{ route('edit', $item['id']) }}" class="font-medium text-blue-600 pr-4 hover:underline">Edit</a>
                        <a href="{{ route('api.koperasi.delete', $item['id']) }}" class="font-medium text-red-600  hover:underline">Delete</a>
                    </td>
                </tr>
            @empty
            <tr class="bg-white border-b border-gray-200">
                <td colspan="8" class="px-6 py-4 text-center">
                    Belum ada data
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
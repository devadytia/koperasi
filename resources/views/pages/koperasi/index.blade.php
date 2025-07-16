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
                    <td class="px-6 py-4 text-left gap-8">
                        <a href="{{ route('edit', $item['id']) }}" class="font-medium text-blue-600 pr-4 hover:underline">Edit</a>
                        <button type="button" onclick="setUriDelete('{{ $item['id'] }}')" class="font-medium text-red-600  hover:underline">Delete</a>
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


<div class="hidden" id="popup-modal">
  <button class="rounded-md bg-gray-950/5 px-2.5 py-1.5 text-sm font-semibold text-gray-900 hover:bg-gray-950/10">Open dialog</button>

  <div role="dialog" aria-modal="true" aria-labelledby="dialog-title" class="relative z-10">
    <div aria-hidden="true" class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-red-600">
                  <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Are you sure delete ?</h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">Are you sure you want to delete data? Your data will be permanently deleted. This action cannot be undone.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 flex justify-end  sm:px-6">
            <a href="#" id="uri-delete" class="mt-3 inline-flex w-full mr-2 justify-center rounded-md bg-red-500 text-white px-3 py-2 text-sm font-semibold shadow-xs ring-1 ring-red-300 ring-inset hover:bg-red-300 sm:mt-0 sm:w-auto">Delete</a>
            <button type="button" onclick="removePopup()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    function setUriDelete(id) {
        let baseUrl = "{{ route('delete', ['code' => ':id']) }}";
        let finalUrl = baseUrl.replace(':id', id);
        document.getElementById('uri-delete').href = finalUrl;

        document.getElementById("popup-modal").classList.remove('hidden');
    }

    function removePopup() {
        document.getElementById("popup-modal").classList.add('hidden');
    }
</script>
@endsection

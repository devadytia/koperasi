@extends('layouts.master')

@section('content')
<div id="error-container" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"></div>

<form id="form-transaksi">
    <div class="relative overflow-x-auto  sm:rounded-lg">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Transaksi</h2>
            <p class="mt-1 text-sm/6 text-gray-600">Form transaksi koperasi</p>
            
            <div id="success-box" class="hidden bg-green-100 mt-4 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm font-semibold">
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Tanggal</label>
                    <div class="mt-2">
                        {{ date("d M Y") }}
                    </div>
                </div>
                  
              <div class="sm:col-span-3">
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                <div class="mt-2">
                    <select id="name" name="name" autocomplete="name" onchange="setName(this)" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option default value="" selected>Pilih Nama</option>
                        @foreach($employee as $item)
                            <option value="{{ $item['id'] }}" id="name-{{ $item['id'] }}" data-code='{{ $item['npk'] }}'>{{ $item['npk'] .' - '. $item['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
    
              <div class="sm:col-span-3">
                <label for="item" class="block text-sm/6 font-medium text-gray-900">Item</label>
                <div class="mt-2">
                    <select id="item" name="item" autocomplete="item" onchange="setItem(this)" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option default value="" selected>Pilih Item</option>
                        @foreach($dataItem as $item)
                            <option value="{{ $item['id'] }}" id="item-{{ $item['id'] }}" data-code="{{ $item['kode'] }}" data-target="{{ $item['harga'] }}">{{ $item['kode'] .' - '. $item['nama_item'] }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
    
              <div class="sm:col-span-3">
                <label for="harga" class="block text-sm/6 font-medium text-gray-900">Harga</label>
                <div class="mt-2">
                  <input id="harga" name="harga" type="text" readonly disabled value="0" autocomplete="harga" placeholder="20000" class="block w-full rounded-md bg-gray-300 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
              </div>
      
              <div class="sm:col-span-3">
                <label for="qty" class="block text-sm/6 font-medium text-gray-900">Qty</label>
                <div class="mt-2">
                  <input type="number" name="qty" id="qty" autocomplete="qty" onchange="setQty(this)" min="1" max="999" value="1" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
              </div>
    
              <div class="sm:col-span-3">
                <label for="total" class="block text-sm/6 font-medium text-gray-900">Total</label>
                <div class="mt-2">
                  <input type="text" id="total" disabled readonly value="0" class="block w-full rounded-md bg-gray-300 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
              </div>
    
              <div class="sm:col-span-3">
                <fieldset>
                    <legend class="text-sm/6 font-semibold text-gray-900">Bayar</legend>
                    <div class="mt-3 flex items-center gap-8">
                      <div class="flex items-center gap-x-3">
                        <input id="lunas" name="bayar" type="radio" value="1" checked class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden" />
                        <label for="lunas" class="block text-sm/6 font-medium text-gray-900">Lunas</label>
                      </div>
                      <div class="flex items-center gap-x-3">
                        <input id="cicil" name="bayar" type="radio" value="0" class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden" />
                        <label for="cicil" class="block text-sm/6 font-medium text-gray-900">Cicil</label>
                      </div>
                    </div>
                  </fieldset>
              </div>
      
            </div>
          </div>
    
    
          <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('index') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
          </div>
    </div>
</form>

<script>
    let itemCode;
    let npkCode;
    let priceTemp = 0;
    let qtyItem = 1;
    let totalPrice;

    function setItem(el) {
        const item = document.getElementById(`item-${el.value}`);
        priceTemp = item.getAttribute('data-target');
        itemCode = item.getAttribute('data-code');
        setTotalPrice();
    }

    function setQty(el) {
        qtyItem = el.value;
        setTotalPrice();
    }

    function setName(el) {
        const item = document.getElementById(`name-${el.value}`);
        npkCode = item.getAttribute('data-code');
    }

    function setTotalPrice() {
        const formattedPrice = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(priceTemp);

        document.getElementById('harga').value = formattedPrice;
        
        const totalPrice = qtyItem * priceTemp;

        const formattedTotal = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(totalPrice);

        document.getElementById('total').value = formattedTotal;
    }

    document.getElementById('form-transaksi').addEventListener('submit', async function(e) {
        e.preventDefault();

        const data = {
            name: document.getElementById('name').value,
            item: document.getElementById('item').value,
            qty: document.getElementById('qty').value,
            npk:npkCode,
            itemCode:itemCode,
            harga: priceTemp,
            total:totalPrice,
            bayar:document.querySelector('input[name="bayar"]:checked').value
        };

        try {
            const res = await fetch('/api/koperasi/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });
    
            const result = await res.json();

            console.log(result);
            if (res.status === 422) {
                let messages = Object.values(result.errors)
                    .map(errList => `<li>${errList.join(', ')}</li>`)
                    .join('');

                const errorDiv = document.getElementById('error-container');
                errorDiv.innerHTML = `<ul>${messages}</ul>`;
                errorDiv.classList.remove('hidden');
                return;
            }

            resetFormTransaksi();
        } catch (err) {
            alert('Terjadi kesalahan: ' + err.message);
        }
    });
    
    function resetFormTransaksi() {
        const successBox = document.getElementById('success-box');
        successBox.innerHTML = '<strong>Berhasil:</strong> Data koperasi berhasil disimpan.';
        successBox.classList.remove('hidden');

        const form = document.getElementById('form-transaksi');
        form.reset();

        document.getElementById('harga').value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(0);

        document.getElementById('total').value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(0);

        document.getElementById('lunas').checked = true;

        itemCode = null;
        npkCode = null;
        priceTemp = 0;
        qtyItem = 1;
        totalPrice = 0;
    }

</script>
@endsection
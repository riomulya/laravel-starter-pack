@if (session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

@if (session('error'))
    <x-alert type="error" :message="session('error')" />
@endif

@extends('layout.main')

@section('content')
    <div class="overflow-x-auto m-20">
        <h1 class="mb-5 text-center text-3xl font-mono font-bold text-info">Barang Keluar</h1>

        <div class="stats shadow mx-auto w-full px-10 mb-10 bg-secondary">

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="stat-title">Outgoing Products</div>
                <div class="stat-value">{{ $outgoing->count() }}</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                        </path>
                    </svg>
                </div>
                <div class="stat-title">Total Product</div>
                <div class="stat-value">{{ $outgoing->sum('Jumlah') }}</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                </div>
                <div class="stat-title">Total Price Product</div>
                <div class="stat-value">RP {{ $outgoing->sum('Jumlah') * $outgoing->sum('HargaPerItem') }}</div>
            </div>

        </div>
        <form action="/outgoing">
            <div class="col-2 flex justify-between">
                <label class="input col input-bordered flex items-center w-full me-6 gap-2 mb-5">
                    <input type="text" class="grow" placeholder="Search" name="search" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="w-4 h-4 opacity-70">
                        <path fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </label>
                <button type="submit" class="btn btn-outline flex col">Search</button>
            </div>
        </form>
        <button class="btn btn-outline mb-5 w-full " onclick="insertModal.showModal()">Tambah Data</button>
        <table class="table table-zebra">
            <!-- head -->
            <thead>
                <tr>
                    <th>Transaksi ID</th>
                    <th>Sales Transaksi ID</th>
                    <th>Tanggal</th>
                    <th>Item ID</th>
                    <th>Jumlah</th>
                    <th>Harga Per Item</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($outgoing as $out)
                    <tr>
                        <th>{{ $out->TransaksiID }}</th>
                        <td>{{ $out->SalesTransaksiID }}</td>
                        <td>{{ $out->Tanggal }}</td>
                        <td>{{ $out->ItemID }}</td>
                        <td>{{ $out->Jumlah }}</td>
                        <td>{{ $out->HargaPerItem }}</td>
                        <td class="text-center">
                            <button class="btn btn-outline btn-primary cursor-pointer"
                                onclick="editModal{{ $out->OutgoingID }}.showModal()">Edit</button>
                            <dialog id="editModal{{ $out->OutgoingID }}" class="modal">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                    <h3 class="font-bold text-lg">Edit Data</h3>
                                    <form method="POST" action="/outgoing/{{ $out->OutgoingID }}/update" class="my-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="mx-auto">
                                            <div class="label">
                                                <span class="label-text">Transaksi Penjualan (customer)</span>
                                            </div>
                                            <select name="TransaksiID" class="select mb-2 select-primary w-full" required>
                                                <option value="{{ $out->salesTransaction->TransaksiID }}" selected>
                                                    {{ $out->salesTransaction->TransaksiID . ' - ' . $out->salesTransaction->Tanggal . ' - ' . $out->salesTransaction->TotalHarga . ' - ' . $out->salesTransaction->customer->Nama }}
                                                </option>
                                                @foreach ($sales as $s)
                                                    <option value="{{ $s->TransaksiID }}">
                                                        {{ $s->TransaksiID . ' - ' . $s->Tanggal . ' - ' . $s->TotalHarga . ' - ' . $s->customer->Nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="label">
                                                <span class="label-text">Transaksi Pembelian (Pembelian barang dari
                                                    supplier)</span>
                                            </div>
                                            <select name="SalesTransaksiID" class="select my-2 select-primary w-full"
                                                required>
                                                <option value="{{ $out->TransaksiID }}" selected>
                                                    {{ $out->TransaksiID . ' - ' . $out->purchaseTransaction->Tanggal . ' - ' . $out->purchaseTransaction->TotalHarga . ' - ' . $out->purchaseTransaction->supplier->Nama }}
                                                </option>
                                                @foreach ($purchase as $p)
                                                    <option value="{{ $p->TransaksiID }}">
                                                        {{ $p->TransaksiID . ' - ' . $p->Tanggal . ' - ' . $p->TotalHarga . ' - ' . $p->supplier->Nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="label">
                                                <span class="label-text">Barang / Produk</span>
                                            </div>
                                            <select name="ItemID" class="select my-2 select-primary w-full" required>
                                                <option value="{{ $out->item->ItemID }}" selected>
                                                    {{ $out->item->ItemID . ' - ' . $out->item->Nama }}
                                                </option>
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->ItemID }}">
                                                        {{ $item->ItemID . ' - ' . $item->Nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="label">
                                                <span class="label-text">Jumlah Stok</span>
                                            </div>
                                            <input type="number" min="1" name="Jumlah" placeholder="Jumlah"
                                                class="input my-2 input-bordered w-full" required
                                                value="{{ $out->Jumlah }}" />
                                            <div class="label ">
                                                <span class="label-text">Harga Per Item</span>
                                            </div>
                                            <input type="number" minlength="1" name="HargaPerItem"
                                                placeholder="Harga Per Item" class="input my-2 input-bordered w-full"
                                                required value="{{ $out->HargaPerItem }}" />
                                            <div class="label ">
                                                <span class="label-text">Tanggal</span>
                                            </div>
                                            <input type="date" name="Tanggal" placeholder="Harga Per Item"
                                                class="input my-2 input-bordered w-full" required
                                                value="{{ $out->Tanggal }}" />
                                        </div>
                                        <button class="btn btn-secondary block my-2" type="submit">Submit</button>
                                    </form>
                                </div>
                                <form method="dialog" class="modal-backdrop">
                                    <button>close</button>
                                </form>
                            </dialog>
                            <button class="btn btn-outline btn-error cursor-pointer"
                                onclick="{{ 'deleteModal' . $out->OutgoingID }}.showModal()">Delete</button>
                            <dialog id="{{ 'deleteModal' . $out->OutgoingID }}" class="modal ">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                    <h3 class="font-bold text-lg">Menghapus Data Ini?
                                    </h3>
                                    <p class="py-4">Press ESC key or click outside to close</p>
                                    <form action="/outgoing/{{ $out->OutgoingID }}/delete" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline btn-error" type="submit">Confirm</button>
                                    </form>
                                </div>
                                <form method="dialog" class="modal-backdrop">
                                    <button>close</button>
                                </form>
                            </dialog>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <dialog id="insertModal" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-lg">Tambah Data</h3>
                <form method="POST" action="/outgoing/insert" class="my-2">
                    @csrf
                    @method('POST')
                    <div class="mx-auto">
                        <div class="label">
                            <span class="label-text">Transaksi Penjualan (customer)</span>
                        </div>
                        <select name="TransaksiID" class="select mb-2 select-primary w-full" required>
                            <option disabled selected>
                                Pilih Transaksi Penjualan
                            </option>
                            @foreach ($sales as $s)
                                <option value="{{ $s->TransaksiID }}">
                                    {{ $s->TransaksiID . ' - ' . $s->Tanggal . ' - ' . $s->TotalHarga . ' - ' . $s->customer->Nama }}
                                </option>
                            @endforeach
                        </select>
                        <div class="label">
                            <span class="label-text">Transaksi Pembelian (Pembelian barang dari
                                supplier)</span>
                        </div>
                        <select name="SalesTransaksiID" class="select my-2 select-primary w-full" required>
                            <option selected disabled>
                                Pilih Transaksi Pembelian
                            </option>
                            @foreach ($purchase as $p)
                                <option value="{{ $p->TransaksiID }}">
                                    {{ $p->TransaksiID . ' - ' . $p->Tanggal . ' - ' . $p->TotalHarga . ' - ' . $p->supplier->Nama }}
                                </option>
                            @endforeach
                        </select>
                        <div class="label">
                            <span class="label-text">Barang / Produk</span>
                        </div>
                        <select name="ItemID" class="select my-2 select-primary w-full" required>
                            <option disabled selected>
                                Pilih Barang
                            </option>
                            @foreach ($items as $item)
                                <option value="{{ $item->ItemID }}">
                                    {{ $item->ItemID . ' - ' . $item->Nama }}
                                </option>
                            @endforeach
                        </select>
                        <div class="label">
                            <span class="label-text">Jumlah Stok</span>
                        </div>
                        <input type="number" min="1" name="Jumlah" placeholder="Jumlah"
                            class="input my-2 input-bordered w-full" required />
                        <div class="label ">
                            <span class="label-text">Harga Per Item</span>
                        </div>
                        <input type="number" minlength="1" name="HargaPerItem" placeholder="Harga Per Item"
                            class="input my-2 input-bordered w-full" required />
                        <div class="label ">
                            <span class="label-text">Tanggal</span>
                        </div>
                        <input type="date" name="Tanggal" placeholder="Harga Per Item"
                            class="input my-2 input-bordered w-full" required />
                    </div>
                    <button class="btn btn-secondary block my-2" type="submit">Submit</button>
                </form>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </div>
@endsection

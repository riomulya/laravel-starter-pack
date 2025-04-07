@if (session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

@if (session('error'))
    <x-alert type="error" :message="session('error')" />
@endif


@extends('layout.main')

@section('content')
    <div class="overflow-x-auto m-20">
        <div class="stats shadow mx-auto w-full px-10 mb-10 bg-secondary">

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="stat-title">Jumlah Transaksi Pembelian Product</div>
                <div class="stat-value">{{ $pTransactions->count() }}</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                </div>
                <div class="stat-title">Harga Total Pembelian</div>
                <div class="stat-value">RP {{ $pTransactions->sum('TotalHarga') }}</div>
            </div>

        </div>
        <form action="/purchase-transaction">
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
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                    <th>Nama Supplier</th>
                    <th>Alamat Supplier</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pTransactions as $p)
                    <tr>
                        <th>{{ $p->TransaksiID }}</th>
                        <td>{{ $p->Tanggal }}</td>
                        <td>RP {{ $p->TotalHarga }}</td>
                        <td>{{ $p->supplier->Nama }}</td>
                        <td>{{ $p->supplier->Alamat }}</td>
                        <td class="text-center">
                            <!-- Edit Button -->
                            <button class="btn btn-outline btn-primary cursor-pointer"
                                onclick="editModal{{ $p->TransaksiID }}.showModal()">Edit</button>
                            <!-- Edit Modal -->
                            <dialog id="editModal{{ $p->TransaksiID }}" class="modal">
                                <div class="modal-box">
                                    <form method="dialog" class="modal-backdrop">
                                        <button
                                            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 text-white">✕</button>
                                    </form>
                                    <form method="POST" action="{{ route('purchase.update', $p->TransaksiID) }}">
                                        @csrf
                                        @method('PUT')
                                        <h3 class="font-bold text-lg">Update Data</h3>
                                        <div class="mx-auto">
                                            <div class="label ">
                                                <span class="label-text">Total Harga</span>
                                            </div>
                                            <input type="number" minlength="1" name="TotalHarga"
                                                placeholder="Harga Per Item" class="input my-2 input-bordered w-full"
                                                value="{{ $p->TotalHarga }}" required />

                                            <div class="label ">
                                                <span class="label-text">Tanggal</span>
                                            </div>
                                            <input type="date" name="Tanggal" placeholder="Total Harga"
                                                class="input my-2 input-bordered w-full" required
                                                value="{{ $p->Tanggal }}" />

                                            <select name="SupplierID" class="select my-2 select-primary w-full" required>
                                                <option value="{{ $p->SupplierID }}" selected>
                                                    {{ $p->SupplierID . ' - ' . $p->supplier->Nama }}
                                                </option>
                                                @foreach ($supplier as $s)
                                                    <option value="{{ $s->SupplierID }}">
                                                        {{ $s->SupplierID . ' - ' . $s->Nama }}
                                                    </option>
                                                @endforeach
                                            </select>


                                        </div>
                                        <button class="btn btn-secondary block my-2" type="submit">Submit</button>
                                    </form>
                                </div>
                            </dialog>

                            <button class="btn btn-outline btn-error cursor-pointer"
                                onclick="{{ 'deleteModal' . $p->TransaksiID }}.showModal()">Delete</button>
                            <dialog id="{{ 'deleteModal' . $p->TransaksiID }}" class="modal ">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                    <h3 class="font-bold text-lg">Apakah Yakin Anda Ingin Menghapus
                                    </h3>
                                    <p class="py-4">Press ESC key or click outside to close</p>
                                    <form action="{{ route('purchase.destroy', $p->TransaksiID) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-error" type="submit">Confirm</button>
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
                <form method="dialog" class="modal-backdrop">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 text-white">✕</button>
                </form>
                <form method="POST" action="{{ route('purchase.store') }}">
                    @csrf
                    @method('POST')
                    <h3 class="font-bold text-lg">Insert Data</h3>
                    <div class="mx-auto">
                        <select name="SupplierID" class="select my-2 select-primary w-full" required>
                            <option disabled selected>
                                Pilih Supplier
                            </option>
                            @foreach ($supplier as $s)
                                <option value="{{ $s->SupplierID }}">
                                    {{ $s->SupplierID . ' - ' . $s->Nama }}
                                </option>
                            @endforeach
                        </select>
                        <div class="label ">
                            <span class="label-text">Total Harga</span>
                        </div>
                        <input type="number" minlength="1" name="TotalHarga" placeholder="Total Harga"
                            class="input my-2 input-bordered w-full" required />
                        <div class="label ">
                            <span class="label-text">Tanggal</span>
                        </div>
                        <input type="date" name="Tanggal" placeholder="Total Harga"
                            class="input my-2 input-bordered w-full" required />
                    </div>
                    <button class="btn btn-secondary block my-2" type="submit">Submit</button>
                </form>
            </div>
        </dialog>
    </div>
@endsection

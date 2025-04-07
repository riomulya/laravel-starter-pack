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
                <div class="stat-title">Products</div>
                <div class="stat-value">{{ $items->count() }}</div>
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
                <div class="stat-title">Stok</div>
                <div class="stat-value">{{ $items->sum('JumlahStok') }}</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                </div>
                <div class="stat-title">Asset</div>
                <div class="stat-value">
                    RP
                    {{ $items->sum(function ($i) {
                        return $i->JumlahStok * $i->Harga;
                    }) }}
                </div>
            </div>

        </div>
        <form action="/product">
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
                    <th></th>
                    <th>Name</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <th>{{ $item->ItemID }}</th>
                        <td>{{ $item->Nama }}</td>
                        <td>{{ $item->Deskripsi }}</td>
                        <td>RP {{ $item->Harga }}</td>
                        <td>{{ $item->JumlahStok }}</td>
                        <td class="text-center">
                            <button class="btn btn-outline btn-primary cursor-pointer"
                                onclick="editModal{{ $item->ItemID }}.showModal()">Edit</button>
                            <dialog id="editModal{{ $item->ItemID }}" class="modal">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                    <h3 class="font-bold text-lg">Edit Data</h3>
                                    <form method="POST" action="/products/{{ $item->ItemID }}" class="my-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="mx-auto">
                                            <input type="text" name="Nama" placeholder="Nama"
                                                class="input my-2 input-bordered w-full" required
                                                value="{{ $item->Nama }}" />
                                            <input type="text" name="Deskripsi" placeholder="Deskripsi"
                                                class="input my-2 input-bordered w-full" required
                                                value="{{ $item->Deskripsi }}" />
                                            <input type="number" min="1" name="Harga" placeholder="Harga"
                                                class="input my-2 input-bordered w-full" required
                                                value="{{ $item->Harga }}" />
                                            <input type="number" minlength="1" name="JumlahStok" placeholder="Jumlah Stok"
                                                class="input my-2 input-bordered w-full" required
                                                value="{{ $item->JumlahStok }}" />
                                            <select name="SupplierID" class="select my-2 select-primary w-full" required>
                                                <option value="{{ $item->SupplierID }}" selected>
                                                    {{ $item->SupplierID . ' ' . $item->Nama }}
                                                </option>
                                                @foreach ($suppliers as $s)
                                                    <option value="{{ $s->SupplierID }}">
                                                        {{ $s->SupplierID . ' ' . $s->Nama }}</option>
                                                @endforeach
                                            </select>
                                            <select name="KategoriID" class="select mb-2 select-primary w-full" required>
                                                <option value="{{ $item->KategoriID }}" selected>
                                                    {{ $item->KategoriID . ' ' . $item->NamaKategori }}
                                                </option>
                                                @foreach ($itemKategori as $i)
                                                    <option value="{{ $i->KategoriID }}">
                                                        {{ $i->KategoriID . ' ' . $i->NamaKategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn btn-secondary block my-2" type="submit">Submit</button>
                                    </form>
                                </div>
                                <form method="dialog" class="modal-backdrop">
                                    <button>close</button>
                                </form>
                            </dialog>
                            <button class="btn btn-outline btn-error cursor-pointer"
                                onclick="{{ 'deleteModal' . $item->ItemID }}.showModal()">Delete</button>
                            <dialog id="{{ 'deleteModal' . $item->ItemID }}" class="modal ">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                    <h3 class="font-bold text-lg">Apakah Yakin Anda Ingin Menghapus {{ $s->Nama }}?
                                    </h3>
                                    <p class="py-4">Press ESC key or click outside to close</p>
                                    <form action="{{ route('items.destroy', $item->ItemID) }}" method="post">
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
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-lg">Insert Data</h3>
                <form method="POST" action="{{ route('items.store') }}" class="my-2">
                    @csrf
                    <div class="mx-auto">
                        <input type="text" name="Nama" placeholder="Nama" class="input my-2 input-bordered w-full"
                            required />
                        <input type="text" name="Deskripsi" placeholder="Deskripsi"
                            class="input my-2 input-bordered w-full" required />
                        <input type="number" min="1" name="Harga" placeholder="Harga"
                            class="input my-2 input-bordered w-full" required />
                        <input type="number" minlength="1" name="JumlahStok" placeholder="Jumlah Stok"
                            class="input my-2 input-bordered w-full" required />

                        <select name="SupplierID" class="select my-2 select-primary w-full" required>
                            <option disabled selected>Pilih Suplier</option>
                            @foreach ($suppliers as $s)
                                <option value="{{ $s->SupplierID }}">{{ $s->SupplierID . ' ' . $s->Nama }}</option>
                            @endforeach
                        </select>
                        <select name="KategoriID" class="select mb-2 select-primary w-full" required>
                            <option disabled selected>Pilih Kategori</option>
                            @foreach ($itemKategori as $i)
                                <option value="{{ $i->KategoriID }}">{{ $i->KategoriID . ' ' . $i->NamaKategori }}
                                </option>
                            @endforeach
                        </select>
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

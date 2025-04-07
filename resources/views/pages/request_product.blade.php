@if (session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

@if (session('error'))
    <x-alert type="error" :message="session('error')" />
@endif

@extends('layout.main')

@section('content')
    <div class="overflow-x-auto m-10">
        <div class="stats shadow mx-auto w-full px-10 mb-5 bg-secondary ">

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="stat-title">Request</div>
                <div class="stat-value">{{ $itemRequests->count() }}</div>
                {{-- <div class="stat-desc">Jan 1st - Feb 1st</div>  --}}
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
                <div class="stat-title">Total Barang</div>
                <div class="stat-value">{{ $itemRequests->sum('Jumlah') }}</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                </div>
                <div class="stat-title">Total Harga</div>

                <div class="stat-value">
                    RP
                    {{ $itemRequests->sum(function ($i) {
                        return $i->Jumlah * $i->item->Harga;
                    }) }}
                </div>
            </div>

        </div>
        <form action="/product-request">
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
        <button class="btn btn-outline mb-5 w-full" onclick="insertModal.showModal()">Tambah Data</button>
        <div class="-z-50 w-full mx-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Tanggal</th>
                        <th>Harga Per Item</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        @role(['staff', 'admin', 'manager'])
                            <th class="text-center">Action</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($itemRequests as $ir)
                        <tr>
                            <th>{{ $ir->RequestID }}</th>
                            <td>{{ $ir->Tanggal }}</td>
                            <td>RP {{ $ir->customer->Nama }}</td>
                            <td>{{ $ir->item->Nama }}</td>
                            <td>{{ $ir->Tanggal }}</td>
                            <td>RP {{ $ir->item->Harga }}</td>
                            <td>{{ $ir->Jumlah }}</td>
                            <td>RP {{ $ir->Jumlah * $ir->item->Harga }}</td>
                            @role(['staff', 'admin', 'manager'])
                                <td class="text-center">
                                    <!-- Edit Button -->
                                    <button class="btn btn-outline btn-primary cursor-pointer"
                                        onclick="editModal{{ $ir->RequestID }}.showModal()">Edit</button>
                                    <!-- Edit Modal -->
                                    <dialog id="editModal{{ $ir->RequestID }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog" class="modal-backdrop">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 text-white">✕</button>
                                            </form>
                                            <form method="POST" action="/product-request/{{ $ir->RequestID }}">
                                                @csrf
                                                @method('PUT')
                                                <h3 class="font-bold text-lg">Update Data</h3>
                                                <div class="mx-auto">
                                                    <input type="text" name="Jumlah" placeholder="Jumlah"
                                                        class="input my-2 input-bordered w-full" value="{{ $ir->Jumlah }}"
                                                        required />
                                                    <div class="label ">
                                                        <span class="label-text">Tanggal</span>
                                                    </div>
                                                    <input type="date" name="Tanggal" placeholder="Total Harga"
                                                        class="input my-2 input-bordered w-full" required
                                                        value="{{ $ir->Tanggal }}" />
                                                    <select name="CustomerID" class="select my-2 select-primary w-full"
                                                        required>
                                                        <option value="{{ $ir->CustomerID }}" selected>
                                                            {{ $ir->CustomerID . ' - ' . $ir->customer->Nama }}
                                                        </option>
                                                        @foreach ($customers as $c)
                                                            <option value="{{ $c->CustomerID }}">
                                                                {{ $c->CustomerID . ' - ' . $c->Nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <select name="ItemID" class="select my-2 select-primary w-full" required>
                                                        <option value="{{ $ir->item->ItemID }}" selected>
                                                            {{ $ir->item->ItemID . ' - ' . $ir->item->Nama }}
                                                        </option>
                                                        @foreach ($items as $item)
                                                            <option value="{{ $item->ItemID }}">
                                                                {{ $item->ItemID . ' - ' . $item->Nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button class="btn btn-secondary block my-2" type="submit">Submit</button>
                                            </form>
                                        </div>
                                    </dialog>
                                    <button class="btn btn-outline btn-info cursor-pointer"
                                        onclick="{{ 'acceptRequest' . $ir->RequestID }}.showModal()">Accept</button>
                                    <dialog id="{{ 'acceptRequest' . $ir->RequestID }}" class="modal ">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <h3 class="font-bold text-lg">Terima Request?
                                            </h3>
                                            <p class="py-4">Press ESC key or click outside to close</p>
                                            <form action="/product-request/accept/{{ $ir->RequestID }}" method="post">
                                                @csrf
                                                @method('POST')
                                                <div class="mt-2 mb-5 text-center">
                                                    <p>Customer : {{ $ir->customer->Nama }}</p>
                                                    <p>Jumlah : {{ $ir->Jumlah }}</p>
                                                    <p>Total Harga :
                                                        RP {{ $ir->Jumlah * $ir->item->Harga }}
                                                    </p>
                                                    <p>Barang : {{ $ir->item->Nama }}</p>
                                                    <input type="hidden" name="TotalHarga"
                                                        value="{{ $ir->Jumlah * $ir->item->Harga }}">
                                                    <input type="hidden" name="CustomerID" value="{{ $ir->CustomerID }}">
                                                </div>
                                                <button class="btn btn-outline btn-success" type="submit">Confirm</button>
                                            </form>
                                        </div>
                                        <form method="dialog" class="modal-backdrop">
                                            <button>close</button>
                                        </form>
                                    </dialog>
                                    <button class="btn btn-outline btn-error cursor-pointer"
                                        onclick="{{ 'deleteModal' . $ir->RequestID }}.showModal()">Delete</button>
                                    <dialog id="{{ 'deleteModal' . $ir->RequestID }}" class="modal ">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <h3 class="font-bold text-lg">Apakah Yakin Anda Ingin Menghapus
                                            </h3>
                                            <p class="py-4">Press ESC key or click outside to close</p>
                                            <form action="/product-request/{{ $ir->RequestID }}" method="post">
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
                            @endrole
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <dialog id="insertModal" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-lg">Insert Data</h3>
                <form method="POST" action="/product-request" class="my-2">
                    @csrf
                    <div class="mx-auto">
                        <input type="text" name="Jumlah" placeholder="Jumlah"
                            class="input my-2 input-bordered w-full" required />
                        <div class="label ">
                            <span class="label-text">Tanggal</span>
                        </div>
                        <input type="date" name="Tanggal" placeholder="Total Harga"
                            class="input my-2 input-bordered w-full" required />
                        <select name="CustomerID" class="select my-2 select-primary w-full" required>
                            <option disabled selected>
                                Pilih Customer
                            </option>
                            @foreach ($customers as $c)
                                <option value="{{ $c->CustomerID }}">
                                    {{ $c->CustomerID . ' - ' . $c->Nama }}
                                </option>
                            @endforeach
                        </select>
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

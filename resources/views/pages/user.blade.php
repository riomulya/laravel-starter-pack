@if (session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

@if (session('error'))
    <x-alert type="error" :message="session('error')" />
@endif

@extends('layout.main')
@section('content')
<div class="overflow-x-auto m-20">
    <!-- Search and Add Button -->
    <div class="col-2 flex justify-between mb-5">
        <form action="/users" class="w-full me-6">
            <label class="input input-bordered flex items-center gap-2">
                <input type="text" class="grow" placeholder="Search" name="search" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
                    <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                </svg>
            </label>
        </form>
        <button class="btn btn-outline" onclick="insertModal.showModal()">+ Tambah User</button>
    </div>

    <!-- User Table -->
    <table class="table table-zebra">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td class="text-center">
                    <!-- Edit Button -->
                    <button class="btn btn-outline btn-primary cursor-pointer"
                        onclick="editModal{{ $user->id }}.showModal()">Edit</button>
                    
                    <!-- Edit Modal -->
                    <dialog id="editModal{{ $user->id }}" class="modal">
                        <div class="modal-box">
                            <form method="dialog" class="modal-backdrop">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <form method="POST" action="{{ route('users.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <h3 class="font-bold text-lg">Edit User</h3>
                                <div class="mx-auto space-y-2 mt-4">
                                    <div class="form-control">
                                        <input type="text" name="name" placeholder="Nama"
                                            class="input input-bordered w-full" value="{{ $user->name }}" required />
                                    </div>
                                    <div class="form-control">
                                        <input type="email" name="email" placeholder="Email"
                                            class="input input-bordered w-full" value="{{ $user->email }}" required />
                                    </div>
                                    <div class="form-control">
                                        <input type="password" name="password" placeholder="Password Baru (Opsional)"
                                            class="input input-bordered w-full" />
                                    </div>
                                    <div class="form-control">
                                        <select name="role" class="select select-bordered w-full">
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                            <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-action">
                                    <button class="btn btn-secondary" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </dialog>

                    <!-- Delete Button -->
                    <button class="btn btn-outline btn-error cursor-pointer ml-2"
                        onclick="deleteModal{{ $user->id }}.showModal()">Hapus</button>
                    
                    <!-- Delete Modal -->
                    <dialog id="deleteModal{{ $user->id }}" class="modal">
                        <div class="modal-box">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3 class="font-bold text-lg">Konfirmasi Hapus User</h3>
                            <p class="py-4">Apakah yakin ingin menghapus {{ $user->name }}?</p>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-action">
                                    <button class="btn btn-error" type="submit">Hapus</button>
                                </div>
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

    <!-- Create Modal -->
    <dialog id="insertModal" class="modal">
        <div class="modal-box">
            <form method="dialog" class="modal-backdrop">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <h3 class="font-bold text-lg">Tambah User Baru</h3>
                <div class="mx-auto space-y-2 mt-4">
                    <div class="form-control">
                        <input type="text" name="name" placeholder="Nama"
                            class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control">
                        <input type="email" name="email" placeholder="Email"
                            class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control">
                        <input type="password" name="password" placeholder="Password"
                            class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control">
                        <input type="password" name="password_confirmation" 
                               placeholder="Konfirmasi Password"
                               class="input input-bordered w-full" required />
                    </div>
                    <div class="form-control">
                        <select name="role" class="select select-bordered w-full">
                            <option value="admin">Admin</option>
                            <option value="user" selected>User</option>
                            <option value="staff">Staff</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                </div>
                <div class="modal-action">
                    <button class="btn btn-secondary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
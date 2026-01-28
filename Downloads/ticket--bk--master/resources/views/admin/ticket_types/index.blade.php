<x-layouts.admin title="Manajemen Tipe Tiket">

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="toast toast-bottom toast-center">
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 3000)
        </script>
    @endif
    {{-- /Notifikasi Sukses --}}

    <div class="container p-10 mx-auto">
        <div class="flex">
            <h1 class="mb-4 text-3xl font-semibold">Manajemen Tipe Tiket</h1>
            <button class="ml-auto btn btn-primary" onclick="add_modal.showModal()">Tambah Tipe Tiket</button>
        </div>

        <div class="p-5 overflow-x-auto bg-white shadow-xs rounded-box">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="w-3/4">Nama Tipe Tiket</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $index => $type)
                        <tr>
                            <th>{{ $index + 1 }}</th>
                            <td>{{ $type->nama }}</td>
                            <td>
                                <button class="mr-2 btn btn-sm btn-primary" onclick="openEditModal(this)"
                                    data-id="{{ $type->id }}" data-nama="{{ $type->nama }}">
                                    Edit
                                </button>
                                <button class="text-white bg-red-500 btn btn-sm" onclick="openDeleteModal(this)"
                                    data-id="{{ $type->id }}">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada tipe tiket tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah Tipe Tiket --}}
    <dialog id="add_modal" class="modal">
        <form method="POST" action="{{ route('admin.ticket-types.store') }}" class="modal-box">
            @csrf
            <h3 class="mb-4 text-lg font-bold">Tambah Tipe Tiket</h3>
            <div class="w-full mb-4 form-control">
                <label class="mb-2 label">
                    <span class="label-text">Nama Tipe Tiket</span>
                </label>
                <input type="text" name="nama" class="w-full input input-bordered"
                    placeholder="Contoh: Reguler, VIP, Early Bird" required />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn" onclick="add_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>
    {{-- /Modal Tambah Tipe Tiket --}}

    {{-- Modal Edit Tipe Tiket --}}
    <dialog id="edit_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('PUT')

            <input type="hidden" name="ticket_type_id" id="edit_ticket_type_id">

            <h3 class="mb-4 text-lg font-bold">Edit Tipe Tiket</h3>
            <div class="w-full mb-4 form-control">
                <label class="mb-2 label">
                    <span class="label-text">Nama Tipe Tiket</span>
                </label>
                <input type="text" name="nama" id="edit_ticket_type_name" class="w-full input input-bordered"
                    placeholder="Masukkan nama tipe tiket" required />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn" onclick="edit_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>
    {{-- /Modal Edit Tipe Tiket --}}

    {{-- Modal Hapus Tipe Tiket --}}
    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('DELETE')

            <input type="hidden" name="ticket_type_id" id="delete_ticket_type_id">

            <h3 class="mb-4 text-lg font-bold">Hapus Tipe Tiket</h3>
            <p>Apakah Anda yakin ingin menghapus tipe tiket ini?</p>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Hapus</button>
                <button class="btn" onclick="delete_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>
    {{-- /Modal Hapus Tipe Tiket --}}

    <script>
        function openEditModal(button) {
            const name = button.dataset.nama;
            const id = button.dataset.id;
            const form = document.querySelector('#edit_modal form');

            document.getElementById('edit_ticket_type_name').value = name;
            document.getElementById('edit_ticket_type_id').value = id;

            // Set action dengan parameter ID
            form.action = `/admin/ticket-types/${id}`;

            edit_modal.showModal();
        }

        function openDeleteModal(button) {
            const id = button.dataset.id;
            const form = document.querySelector('#delete_modal form');

            document.getElementById('delete_ticket_type_id').value = id;

            // Set action dengan parameter ID
            form.action = `/admin/ticket-types/${id}`;

            delete_modal.showModal();
        }
    </script>

</x-layouts.admin>

<x-layouts.admin title="Manajemen Tipe Pembayaran">

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
            <h1 class="mb-4 text-3xl font-semibold">Manajemen Tipe Pembayaran</h1>
            <button class="ml-auto btn btn-primary" onclick="add_modal.showModal()">Tambah Tipe Pembayaran</button>
        </div>

        <div class="p-5 overflow-x-auto bg-white shadow-xs rounded-box">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="w-3/4">Nama Tipe Pembayaran</th>
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
                            <td colspan="3" class="text-center">Tidak ada tipe pembayaran tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah Tipe Pembayaran --}}
    <dialog id="add_modal" class="modal">
        <form method="POST" action="{{ route('admin.payment-types.store') }}" class="modal-box">
            @csrf
            <h3 class="mb-4 text-lg font-bold">Tambah Tipe Pembayaran</h3>
            <div class="w-full mb-4 form-control">
                <label class="mb-2 label">
                    <span class="label-text">Nama Tipe Pembayaran</span>
                </label>
                <input type="text" name="nama" class="w-full input input-bordered"
                    placeholder="Contoh: Transfer Bank, E-Wallet, Cash" required />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn" onclick="add_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>
    {{-- /Modal Tambah Tipe Pembayaran --}}

    {{-- Modal Edit Tipe Pembayaran --}}
    <dialog id="edit_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('PUT')

            <input type="hidden" name="payment_type_id" id="edit_payment_type_id">

            <h3 class="mb-4 text-lg font-bold">Edit Tipe Pembayaran</h3>
            <div class="w-full mb-4 form-control">
                <label class="mb-2 label">
                    <span class="label-text">Nama Tipe Pembayaran</span>
                </label>
                <input type="text" name="nama" id="edit_payment_type_name" class="w-full input input-bordered"
                    placeholder="Masukkan nama tipe pembayaran" required />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn" onclick="edit_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>
    {{-- /Modal Edit Tipe Pembayaran --}}

    {{-- Modal Hapus Tipe Pembayaran --}}
    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('DELETE')

            <input type="hidden" name="payment_type_id" id="delete_payment_type_id">

            <h3 class="mb-4 text-lg font-bold">Hapus Tipe Pembayaran</h3>
            <p>Apakah Anda yakin ingin menghapus tipe pembayaran ini?</p>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Hapus</button>
                <button class="btn" onclick="delete_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>
    {{-- /Modal Hapus Tipe Pembayaran --}}

    <script>
        function openEditModal(button) {
            const name = button.dataset.nama;
            const id = button.dataset.id;
            const form = document.querySelector('#edit_modal form');

            document.getElementById('edit_payment_type_name').value = name;
            document.getElementById('edit_payment_type_id').value = id;

            // Set action dengan parameter ID
            form.action = `/admin/payment-types/${id}`;

            edit_modal.showModal();
        }

        function openDeleteModal(button) {
            const id = button.dataset.id;
            const form = document.querySelector('#delete_modal form');

            document.getElementById('delete_payment_type_id').value = id;

            // Set action dengan parameter ID
            form.action = `/admin/payment-types/${id}`;

            delete_modal.showModal();
        }
    </script>

</x-layouts.admin>

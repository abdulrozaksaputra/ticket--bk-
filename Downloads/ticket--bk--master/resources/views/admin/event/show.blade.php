<x-layouts.admin title="Detail Event">
    <div class="container p-10 mx-auto">
        @if (session('success'))
            <div class="z-50 toast toast-bottom toast-center">
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
        <div class="shadow-sm card bg-base-100">
            <div class="card-body">
                <h2 class="mb-6 text-2xl card-title">Detail Event</h2>

                <form id="eventForm" class="space-y-4" method="post"
                    action="{{ route('admin.events.update', $event->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Nama Event -->
                    <div class="form-control">
                        <label class="label">
                            <span class="font-semibold label-text">Judul Event</span>
                        </label>
                        <input type="text" name="judul" placeholder="Contoh: Konser Musik Rock"
                            class="w-full input input-bordered" value="{{ $event->judul }}" disabled required />
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-control">
                        <label class="label">
                            <span class="font-semibold label-text">Deskripsi</span>
                        </label>
                        <br>
                        <textarea name="deskripsi" placeholder="Deskripsi lengkap tentang event..."
                            class="w-full h-24 textarea textarea-bordered" disabled
                            required>{{ $event->deskripsi }}</textarea>
                    </div>

                    <!-- Tanggal & Waktu -->
                    <div class="form-control">
                        <label class="label">
                            <span class="font-semibold label-text">Tanggal & Waktu</span>
                        </label>
                        <input type="datetime-local" name="tanggal_waktu" class="w-full input input-bordered"
                            value="{{ $event->tanggal_waktu->format('Y-m-d\TH:i') }}" disabled required />
                    </div>

                    <!-- Lokasi -->
                    <div class="form-control">
                        <label class="label">
                            <span class="font-semibold label-text">Lokasi</span>
                        </label>
                        <input type="text" name="lokasi" placeholder="Contoh: Stadion Utama"
                            class="w-full input input-bordered" value="{{ $event->lokasiEvent?->nama ?? '-' }}" disabled
                            required />
                    </div>

                    <!-- Kategori -->
                    <div class="form-control">
                        <label class="label">
                            <span class="font-semibold label-text">Kategori</span>
                        </label>
                        <select name="kategori_id" class="w-full select select-bordered" required disabled>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $event->kategori_id ? 'selected' : '' }}>
                                    {{ $category->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="form-control">
                        <label class="label">
                            <span class="font-semibold label-text">Gambar Event</span>
                        </label>
                        <input type="file" name="gambar" accept="image/*" class="w-full file-input file-input-bordered"
                            disabled />
                        <label class="label">
                            <span class="label-text-alt">Format: JPG, PNG, max 5MB</span>
                        </label>
                    </div>

                    <!-- Preview Gambar -->
                    <div id="imagePreview" class="overflow-hidden {{ $event->gambar ? '' : 'hidden' }}">
                        <label class="label">
                            <span class="font-semibold label-text">Preview Gambar</span>
                        </label>
                        <br>
                        <div class="max-w-sm avatar">
                            <div class="w-full rounded-lg">
                                @if ($event->gambar)
                                    <img id="previewImg" src="{{ asset('assets/img/events/' . $event->gambar) }}"
                                        alt="Preview">
                                @else
                                    <img id="previewImg" src="" alt="Preview">
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-10">
            <div class="flex">
                <h1 class="mb-4 text-3xl font-semibold">List Ticket</h1>
                <button onclick="add_ticket_modal.showModal()" class="ml-auto btn btn-primary">Tambah Ticket</button>
            </div>
            <div class="p-5 overflow-x-auto bg-white shadow-xs rounded-box">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="w-1/3">tipe</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $index => $ticket)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $ticket->ticketType->nama }}</td>
                                <td>{{ $ticket->harga }}</td>
                                <td>{{ $ticket->stok }}</td>
                                <td>
                                    <button class="mr-2 btn btn-sm btn-primary" onclick="openEditModal(this)"
                                        data-id="{{ $ticket->id }}" data-ticket-type-id="{{ $ticket->ticket_type_id }}"
                                        data-harga="{{ $ticket->harga }}" data-stok="{{ $ticket->stok }}">Edit</button>
                                    <button class="text-white bg-red-500 btn btn-sm" onclick="openDeleteModal(this)"
                                        data-id="{{ $ticket->id }}">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada ticket tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Ticket Modal -->
    <dialog id="add_ticket_modal" class="modal">
        <form method="POST" action="{{ route('admin.tickets.store') }}" class="modal-box">
            @csrf

            <h3 class="mb-4 text-lg font-bold">Tambah Ticket</h3>

            <input type="hidden" name="event_id" value="{{ $event->id }}">

            <div class="mb-4 form-control">
                <label class="label">
                    <span class="font-semibold label-text">Tipe Ticket</span>
                </label>
                <select name="ticket_type_id" id="edit_ticket_type_id" class="w-full select select-bordered" required>
                    <option value="" disabled>Pilih Tipe Ticket</option>
                    @foreach ($ticketTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->nama }}</option>
                    @endforeach
                </select>

            </div>
            <div class="mb-4 form-control">
                <label class="label">
                    <span class="font-semibold label-text">Harga</span>
                </label>
                <input type="number" name="harga" placeholder="Contoh: 50000" class="w-full input input-bordered"
                    required />
            </div>
            <div class="mb-4 form-control">
                <label class="label">
                    <span class="font-semibold label-text">Stok</span>
                </label>
                <input type="number" name="stok" placeholder="Contoh: 100" class="w-full input input-bordered"
                    required />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Tambah</button>
                <button class="btn" onclick="add_ticket_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <!-- Edit Ticket Modal -->
    <dialog id="edit_ticket_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('PUT')

            <input type="hidden" name="ticket_id" id="edit_ticket_id">

            <h3 class="mb-4 text-lg font-bold">Edit Ticket</h3>

            <div class="mb-4 form-control">
                <label class="label">
                    <span class="font-semibold label-text">Tipe Ticket</span>
                </label>
                <select name="ticket_type_id" id="edit_ticket_type_id" class="w-full select select-bordered" required>
                    <option value="" disabled selected>Pilih Tipe Ticket</option>
                    @foreach ($ticketTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 form-control">
                <label class="label">
                    <span class="font-semibold label-text">Harga</span>
                </label>
                <input type="number" name="harga" id="edit_harga" placeholder="Contoh: 50000"
                    class="w-full input input-bordered" required />
            </div>
            <div class="mb-4 form-control">
                <label class="label">
                    <span class="font-semibold label-text">Stok</span>
                </label>
                <input type="number" name="stok" id="edit_stok" placeholder="Contoh: 100"
                    class="w-full input input-bordered" required />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn" onclick="edit_ticket_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <!-- Delete Ticket Modal -->
    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('DELETE')

            <input type="hidden" name="ticket_id" id="delete_ticket_id">

            <h3 class="mb-4 text-lg font-bold">Hapus Ticket</h3>
            <p>Apakah Anda yakin ingin menghapus ticket ini?</p>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Hapus</button>
                <button class="btn" onclick="delete_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>



    <script>
        const form = document.getElementById('eventForm');
        const fileInput = form.querySelector('input[type="file"]');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const successAlert = document.getElementById('successAlert');

        // Preview gambar saat dipilih
        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle reset
        form.addEventListener('reset', function () {
            imagePreview.classList.add('hidden');
            successAlert.classList.add('hidden');
        });

        function openDeleteModal(button) {
            const id = button.dataset.id;
            const form = document.querySelector('#delete_modal form');
            document.getElementById("delete_ticket_id").value = id;

            // Set action dengan parameter ID
            form.action = `/admin/tickets/${id}`;
            delete_modal.showModal();
        }

        function openEditModal(button) {
            const id = button.dataset.id;
            const ticketTypeId = button.dataset.ticketTypeId;
            const harga = button.dataset.harga;
            const stok = button.dataset.stok;

            const form = document.querySelector('#edit_ticket_modal form');
            document.getElementById("edit_ticket_id").value = id;
            document.getElementById("edit_ticket_type_id").value = ticketTypeId;
            document.getElementById("edit_harga").value = harga;
            document.getElementById("edit_stok").value = stok;

            form.action = `/admin/tickets/${id}`;
            edit_ticket_modal.showModal();
        }
    </script>
</x-layouts.admin>
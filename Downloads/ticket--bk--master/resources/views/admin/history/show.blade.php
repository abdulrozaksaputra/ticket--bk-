<x-layouts.admin title="Detail Pemesanan">
    <section class="max-w-4xl px-6 py-12 mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Detail Pemesanan</h1>
            <div class="text-sm text-gray-500">Order #{{ $order->id }} •
                {{ $order->order_date->format('d M Y H:i') }}
            </div>
        </div>

        <div class="shadow-md card bg-base-100">
            <div class="lg:flex ">
                <div class="p-4 lg:w-1/3">
                    <img src="{{ $order->event?->gambar ? asset('assets/img/events/' . $order->event->gambar) : 'https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp' }}"
                        alt="{{ $order->event?->judul ?? 'Event' }}" class="object-cover w-full mb-2" />
                    <h2 class="text-lg font-semibold">{{ $order->event?->judul ?? 'Event' }}</h2>
                    <p class="mt-1 text-sm text-gray-500">{{ $order->event?->lokasiEvent?->nama ?? '' }}</p>
                </div>
                <div class="card-body lg:w-2/3">


                    <div class="space-y-3">
                        @foreach ($order->detailOrders as $d)
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-bold">{{ $d->tiket->tipe }}</div>
                                    <div class="text-sm text-gray-500">Qty: {{ $d->jumlah }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold">Rp {{ number_format($d->subtotal_harga, 0, ',', '.') }}</div>
                                </div>
                                <div class="text-sm text-gray-500">
                                    Metode Pembayaran: {{ $d->paymentType->nama ?? '-' }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="divider"></div>

                    <div class="flex items-center justify-between">
                        <span class="font-bold">Total</span>
                        <span class="text-lg font-bold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>

                    </div>
                    <div class="flex gap-2 mx-auto mt-3 sm:ml-auto sm:mt-auto sm:mr-0">
                        <a href="{{ route('admin.histories.index') }}" class="btn btn-primary">Kembali ke Riwayat</a>
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-layouts.admin>
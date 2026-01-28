<x-layouts.app>
    <section class="max-w-6xl px-6 py-12 mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Riwayat Pembelian</h1>
        </div>

        <div class="space-y-4">
            @forelse($orders as $order)
                <article class="overflow-hidden shadow-md card lg:card-side bg-base-100">
                    <figure class="lg:w-48">
                        <img src="{{ $order->event?->gambar ? asset('assets/img/events/' . $order->event->gambar) : 'https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp' }}"
                            alt="{{ $order->event?->judul ?? 'Event' }}" class="object-cover w-full h-full" />
                    </figure>

                    <div class="flex justify-between card-body ">
                        <div>
                            <div class="font-bold">Order #{{ $order->id }}</div>
                            <div class="mt-1 text-sm text-gray-500">
                                {{ $order->order_date->translatedFormat('d F Y, H:i') }}
                            </div>
                            <div class="mt-2 text-sm">{{ $order->event?->judul ?? 'Event' }}</div>
                        </div>

                        <div class="text-right">
                            <div class="text-lg font-bold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </div>
                            <a href="{{ route('orders.show', $order) }}" class="mt-3 text-white btn btn-primary">Lihat
                                Detail</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="alert alert-info">Anda belum memiliki pesanan.</div>
            @endforelse
        </div>
    </section>
</x-layouts.app>
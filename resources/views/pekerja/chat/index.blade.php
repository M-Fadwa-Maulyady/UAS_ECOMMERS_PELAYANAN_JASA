<x-layoutJasa title="Chat Pelanggan">

<div style="max-width:800px;margin:30px auto">

    <h3 style="margin-bottom:20px">💬 Daftar Chat Pelanggan</h3>

    @forelse($orders as $order)
        <a href="{{ route('pekerja.chat.show', $order->id) }}"
           style="display:block;
                  padding:16px;
                  margin-bottom:12px;
                  border-radius:12px;
                  background:#fff;
                  box-shadow:0 4px 14px rgba(0,0,0,.06);
                  text-decoration:none;
                  color:#222">

            <strong>{{ $order->user->name }}</strong><br>
            <small>
                {{ $order->jasa->judul ?? 'Order #' . $order->id }}
            </small>
        </a>
    @empty
        <div style="padding:20px;background:#fff;border-radius:12px">
            Belum ada chat masuk 📭
        </div>
    @endforelse

</div>

</x-layoutJasa>

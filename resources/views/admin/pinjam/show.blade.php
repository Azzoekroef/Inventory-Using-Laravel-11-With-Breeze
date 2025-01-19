
@extends('layouts.tempadmin')

@section('admin')
<div class="content">
</div>
<div class="rightside">
  @include('layouts.navbaradmin')

@if (session('error'))
    <div class="bg-red-500 text-white p-4 rounded-md mb-4">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
        {{ session('success') }}
    </div>
@endif

    <div class="table-container flex-col">

    <div class="flex flex-1">
        
    <div class="p-5 rounded-xl flex-1 mx-4 h-auto" style="background-color:#fffdcc;">
    <h3 class=" text-2xl font-happy pb-2">Detail Pinjaman</h3>
    <p class="py-2 text-xl">User: {{ $userminjam->user->name }}</p>
    <p class="py-2 text-xl">Tanggal Pinjam: {{ $createdAt->format('d-m-Y') }}</p>

    <h4 class="py-2 text-xl">Barang yang Dipinjam:</h4>
    <form method="POST" action="{{ route('admin.barang.updateAll') }}">
        @csrf
        <ul>
            @foreach($pinjaman as $pinjam)
                <li class="py-2 text-xl">
                    - {{ $pinjam->barang->spesifikasi }} ({{ $pinjam->qty }} pcs), Yang dipunya saat ini {{ $pinjam->barang->qty }}
                    <input type="hidden" name="barang_id[]" value="{{ $pinjam->barang->id }}">
                    <input type="hidden" name="qty[]" value="{{ $pinjam->qty }}">
                </li>
            @endforeach
        </ul>
        <input type="hidden" name="user_id" value="{{ $userminjam->user->id }}">
        <input type="hidden" name="created_at" value="{{ $createdAt->toDateTimeString() }}">

        <div class="mt-4 flex gap-2 justify-end">
            <button type="submit" name="action" value="accept" class="text-lg edit-btn w-40 border border-solid rounded-full border-stone-950" style="background-color: #a7c87a;">
                Terima
            </button>
            <button type="submit" name="action" value="reject" class="text-lg edit-btn w-40 border border-solid rounded-full border-stone-950" style="background-color: #f26464;">
                Tolak
            </button>
            <button type="submit" name="action" value="return" class="text-lg edit-btn w-40 border border-solid rounded-full border-stone-950" style="background-color: #7895cb;">
                Kembalikan
            </button>
        </div>
    </form>
</div>

    </div>

    </div>


  
</div>

@endsection


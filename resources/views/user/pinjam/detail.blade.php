
@extends('layouts.tempuser')

@section('user')
<div class="content">
</div>
<div class="rightside">
  @include('layouts.navbaruser')

    <div class="table-container flex-col">

    <div class="flex flex-1">
        
    <div class="p-5 rounded-xl flex-1 mx-4 h-auto" style="background-color:#fffdcc;">
    <h3 class=" text-2xl font-happy pb-2">Detail Pinjaman</h3>
    <p class="py-2 text-xl">User: {{ $userminjam->user->name }}</p>
    <p class="py-2 text-xl">Tanggal Pinjam: {{ $createdAt->format('d-m-Y') }}</p>

    <h4 class="py-2 text-xl">Barang yang Dipinjam:</h4>
        <ul>
            @foreach($pinjaman as $pinjam)
                <li class="py-2 text-xl">
                    - {{ $pinjam->barang->spesifikasi }} ({{ $pinjam->qty }} pcs)
                    <input type="hidden" name="barang_id[]" value="{{ $pinjam->barang->id }}">
                    <input type="hidden" name="qty[]" value="{{ $pinjam->qty }}">
                </li>
            @endforeach
        </ul>

</div>

    </div>

    </div>


  
</div>

@endsection


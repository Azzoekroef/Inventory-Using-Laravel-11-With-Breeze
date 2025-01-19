
@extends('layouts.tempadmin')

@section('admin')
<div class="content">
</div>
<div class="rightside">
  @include('layouts.navbaradmin')

  <div class="table-container">
  <table class="custom-table">
    <thead>
      <tr>
      <th>No</th>
        <th>Nama User</th>
        <th>Qty</th>
        <th>Tanggal Peminjaman</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @php
        $index = 1;
      @endphp
      @foreach($peminjam as $item)
      <tr>
        <td>{{ $index }}</td>
        <td>{{ $item->user->name }}</td>
        <td>{{ $item->total_qty }}</td>
        <td>{{ $item->created_at->format('d-m-Y') }}</td>
        <td>@if($item->status == 0)
                <span class="text-yellow-500">Pending</span>
            @elseif($item->status == 1)
                <span class="text-green-500">Diterima</span>
            @elseif($item->status == 3)
                <span class="text-blue-500">Dikembalikan</span>
            @elseif($item->status == 2)
                <span class="text-red-500">Ditolak</span>
            @endif
        </td>
        <td>
          <a href="{{ route('admin.pinjam.show', [$item->user->id, $item->created_at->format('Y-m-d H:i:s')]) }}"><button class=" text-lg  edit-btn w-40 border border-solid rounded-full border-stone-950">Detail</button></a>
          
        </td>
      </tr>
      @php
        $index ++;
      @endphp
      @endforeach
      <!-- Tambahkan baris sesuai kebutuhan -->
    </tbody>
  </table>
</div>


  
</div>

@endsection


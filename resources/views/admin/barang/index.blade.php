
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
        <th>Kelompok</th>
        <th>Kategori</th>
        <th>Qty</th>
        <th>Spesifikasi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @php
        $index = 1;
      @endphp
      @foreach($barangs as $item)
      <tr>
        <td>{{ $index }}</td>
        <td>{{ $item->kelompok }}</td>
        <td>{{ $item->kategori }}</td>
        <td>{{ $item->qty }}</td>
        <td>{{ $item->spesifikasi }}</td>
        <td>
          <a href="{{ route('admin.barang.edit', $item->id) }}"><button class=" text-lg  edit-btn w-40 border border-solid rounded-full border-stone-950">edit</button></a>
          <form action="{{ route('admin.barang.destroy', $item->id) }}" method="POST" class="inline">
              @csrf
              @method('DELETE')
              <button class="text-lg hapus-btn w-40 ms-4 border border-solid rounded-full border-stone-950">hapus</button>
          </form>
          
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


<a href="{{ route ('admin.barang.create')}}"><button class=" text-lg w-40 border border-solid rounded-2xl border-stone-950 h-10" style="margin-left: 60px; background-color:#a7c87a">Tambah</button>
</a>
  
</div>

@endsection


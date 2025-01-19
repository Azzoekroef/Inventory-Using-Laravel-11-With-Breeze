@extends('layouts.tempuser')

@section('user')
<div class="content">
</div>
<div class="rightside">
  @include('layouts.navbaruser')

  <div class="table-container">
    <table class="custom-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kelompok</th>
          <th>Kategori</th>
          <th>Qty</th>
          <th>Spesifikasi</th>
          <th>Pilih Jumlah</th> <!-- Kolom untuk memilih jumlah -->
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
            <!-- Input untuk memilih jumlah barang -->
            <input type="number" class="selectJumlah" data-id="{{ $item->id }}" data-nama="{{ $item->kelompok }}" data-qty="{{ $item->qty }}" min="1" max="{{ $item->qty }}" value="1">
            <button type="button" class="add-to-cart-btn" data-id="{{ $item->id }}">Tambah ke Keranjang</button>
          </td>
        </tr>
        @php
          $index++;
        @endphp
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="keranjang-container mx-16 flex" >
    <div style="background-color: #fbf5e6; flex: 2 1 0;">
        <h3>Keranjang Peminjaman</h3>
        <ul id="keranjangList"></ul>
        <p>Total Jumlah Barang: <span id="totalQty">0</span></p>
    </div>
    <div style="flex: 4 1 0;">
        
        </div>
    </div>
    <button class="mx-16 mt-4 px-12 py-1 border border-solid rounded-xl border-stone-950" onclick="pinjamBarang()" style="background-color:#7895cb">Pinjam Sekarang</button>


</div>
<script>
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
  button.addEventListener('click', function() {
    let idBarang = this.getAttribute('data-id');
    let jumlahBarang = parseInt(document.querySelector(`input[data-id="${idBarang}"]`).value); // Mengambil jumlah barang
    let namaBarang = document.querySelector(`input[data-id="${idBarang}"]`).getAttribute('data-nama');
    let stokBarang = parseInt(document.querySelector(`input[data-id="${idBarang}"]`).getAttribute('data-qty'));

    // Validasi bahwa jumlah barang tidak melebihi stok yang tersedia
    if (jumlahBarang <= 0 || jumlahBarang > stokBarang) {
      alert(`Jumlah yang dipilih tidak valid atau melebihi stok yang tersedia! Stok yang tersedia: ${stokBarang}`);
      document.querySelector(`input[data-id="${idBarang}"]`).value = stokBarang; // Mengembalikan jumlah ke stok yang tersedia
      return;
    }

    // Menambahkan barang ke keranjang
    addToKeranjang(idBarang, namaBarang, jumlahBarang);
    updateKeranjang();
  });
});

let keranjang = [];

function addToKeranjang(id, nama, qty) {
  let existingItem = keranjang.find(item => item.id === id);

  if (existingItem) {
    // Jika barang sudah ada, tambahkan jumlahnya, pastikan tidak melebihi stok
    if (existingItem.qty + qty <= document.querySelector(`input[data-id="${id}"]`).getAttribute('data-qty')) {
      existingItem.qty += qty;
    } else {
      alert("Jumlah barang melebihi stok yang tersedia.");
      return;
    }
  } else {
    keranjang.push({ id, nama, qty });
  }
}

function updateKeranjang() {
  const keranjangList = document.getElementById('keranjangList');
  keranjangList.innerHTML = '';

  let totalQty = 0;
  keranjang.forEach(item => {
    const listItem = document.createElement('li');
    listItem.textContent = `${item.nama} - Jumlah: ${item.qty}`;
    keranjangList.appendChild(listItem);
    totalQty += item.qty;
  });

  document.getElementById('totalQty').textContent = `Jumlah Barang: ${totalQty}`;
}

function pinjamBarang() {
  if (keranjang.length === 0) {
    alert("Keranjang Anda kosong. Silakan pilih barang untuk dipinjam.");
  } else {
    // Kirim data keranjang ke server
    fetch('/user/meminjam', { // Pastikan URL ini benar dan sesuai dengan route di server Anda
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Menambahkan CSRF token
      },
      body: JSON.stringify({ barang: keranjang }) // Mengirimkan data keranjang dalam format JSON
    })
    .then(response => {
      // Cek jika response bukan OK (status selain 200)
      if (!response.ok) {
        throw new Error('Gagal meminjam barang. Silakan coba lagi.');
      }
      return response.json(); // Parse JSON response
    })
    .then(data => {
      if (data.status == "success") {
        alert("Barang berhasil dipinjam!");
        keranjang = []; // Kosongkan keranjang setelah berhasil meminjam
        updateKeranjang(); // Memperbarui tampilan keranjang
      } else {
        alert("Terjadi kesalahan: " + data.status); // Menangani kesalahan dari server
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert("Terjadi kesalahan saat mengirim data. Silakan coba lagi.");
    });
  }
}


</script>
@endsection


@extends('layouts.tempadmin')

@section('admin')
<div class="content">
</div>
<div class="rightside">
  @include('layouts.navbaradmin')

    <div class="table-container flex">
        <div class="p-5 rounded-xl flex-1 mx-4" style="background-color:#fffdcc;">
        <form method="POST" class="flex-row" action="{{ route('admin.barang.update', $barang->id) }}">
            @csrf
            @method('PUT')
            <!-- Nama Barang -->
            <div class="flex flex-row p-4 pe-80 justify-between items-center">
                <label class="text-xl flex-1" for="kelompok">Kelompok :</label>
                <select class="text-lg font-medium p-3" style="flex: 4 1 0;" name="kelompok" id="kelompok">
                    <option value="" disabled>Pilih kelompok Barang</option>
                    @foreach ($kelompok as $item)
                        <option value="{{ $item->kelompok }}" {{ $barang->kelompok === $item->kelompok ? 'selected' : '' }}>
                            {{ $item->kelompok }}
                        </option>
                    @endforeach
                    <option value="add_new">+ Tambah kelompok Barang</option>
                </select>
            </div>
        
            <!-- Kategori -->
            <div class="flex flex-row p-4 pe-80 justify-between items-center">
                <label class="text-xl flex-1" for="kategori">Kategori :</label>
                <select class="text-lg font-medium p-3" style="flex: 4 1 0;" name="kategori" id="kategori">
                    <option value="" disabled>Pilih Kategori</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->kategori }}" {{ $barang->kategori === $item->kategori ? 'selected' : '' }}>
                            {{ $item->kategori }}
                        </option>
                    @endforeach
                    <option value="add_new">+ Tambah Kategori</option>
                </select>
            </div>
        
            <!-- Spesifikasi -->
            <div class="flex flex-row p-4 pe-80 justify-between items-center">
                <label class="text-xl flex-1" for="spesifikasi">Spesifikasi :</label>
                <select class="text-lg font-medium p-3" style="flex: 4 1 0;" name="spesifikasi" id="spesifikasi">
                    <option value="" disabled>Pilih Spesifikasi</option>
                    @foreach ($spesifikasi as $item)
                        <option value="{{ $item->spesifikasi }}" {{ $barang->spesifikasi === $item->spesifikasi ? 'selected' : '' }}>
                            {{ $item->spesifikasi }}
                        </option>
                    @endforeach
                    <option value="add_new">+ Tambah Spesifikasi</option>
                </select>
            </div>
        
            <!-- Qty -->
            <div class="flex flex-row p-4 pe-80 items-center">
                <label style="flex: 7 1 0;" class="text-xl" for="qty">Qty :</label>
                <input class="text-lg font-medium p-3" style="flex: 2 1 0;" type="number" name="qty" value="{{ $barang->qty }}" placeholder="Qty">
                <div style="flex: 20 1 0;"></div>
            </div>
        
            <!-- Submit Button -->
            <div class="flex flex-col">
                <button class="text-lg w-40 border border-solid rounded-2xl border-stone-950 h-10 place-self-end" style="background-color:#7895cb" type="submit">
                    Update
                </button>
            </div>
        </form>

        </div>
    </div>

  
</div>


<script>
    // Nama Barang
    document.getElementById('kelompok').addEventListener('change', function () {
        if (this.value === 'add_new') {
            const namaBaru = prompt("Masukkan Nama Barang Baru:");
            if (namaBaru) {
                const newOption = document.createElement('option');
                newOption.value = namaBaru;
                newOption.textContent = namaBaru;
                this.appendChild(newOption);
                this.value = namaBaru; // Pilih opsi baru
            } else {
                this.value = ""; // Reset pilihan
            }
        }
    });

    // Kategori
    document.getElementById('kategori').addEventListener('change', function () {
        if (this.value === 'add_new') {
            const kategoriBaru = prompt("Masukkan Kategori Baru:");
            if (kategoriBaru) {
                const newOption = document.createElement('option');
                newOption.value = kategoriBaru;
                newOption.textContent = kategoriBaru;
                this.appendChild(newOption);
                this.value = kategoriBaru; // Pilih opsi baru
            } else {
                this.value = ""; // Reset pilihan
            }
        }
    });

    // Spesifikasi
    document.getElementById('spesifikasi').addEventListener('change', function () {
        if (this.value === 'add_new') {
            const spesifikasiBaru = prompt("Masukkan Spesifikasi Baru:");
            if (spesifikasiBaru) {
                const newOption = document.createElement('option');
                newOption.value = spesifikasiBaru;
                newOption.textContent = spesifikasiBaru;
                this.appendChild(newOption);
                this.value = spesifikasiBaru; // Pilih opsi baru
            } else {
                this.value = ""; // Reset pilihan
            }
        }
    });
</script>
@endsection

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inventaris Digikom</title>
    <link href="https://fonts.cdnfonts.com/css/kg-happy" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
// Fungsi untuk toggle dropdown
function toggleDropdown(event) {
  event.preventDefault();
  
  // Referensi ke dropdown dan sidebar
  const dropdownContent = document.getElementById("dropdown-content");
  const dropdownBtn = document.getElementById("dropdown-btn");
  const sidebar = document.querySelector(".sidebar");

  // Cek apakah dropdown sudah terbuka atau belum
  const isVisible = dropdownContent.style.display === "block";

  // Toggle visibilitas dropdown dan adjust sidebar
  if (isVisible) {
    dropdownContent.style.display = "none";
    sidebar.classList.remove("open-dropdown"); // Menghapus kelas jika dropdown ditutup
  } else {
    dropdownContent.style.display = "block";
    sidebar.classList.add("open-dropdown"); // Menambahkan kelas untuk memberi ruang
  }

  // Toggle class untuk mengubah arah panah dropdown
  dropdownBtn.classList.toggle("active");
}

// Menutup dropdown jika klik di luar area dropdown
window.onclick = function (event) {
  if (!event.target.closest(".dropdown")) {
    const dropdownContent = document.getElementById("dropdown-content");
    const dropdownBtn = document.getElementById("dropdown-btn");
    const sidebar = document.querySelector(".sidebar");

    dropdownContent.style.display = "none";
    sidebar.classList.remove("open-dropdown"); // Mengembalikan ruang ke posisi semula

    dropdownBtn.classList.remove("active");
  }
};

</script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    />
    <style>
     /* Sidebar Styling */

     .font-happy {
    font-family: 'KG Happy', sans-serif;
  }

.sidebar {
  position: relative;
  width: 250px;  /* Atur lebar sesuai kebutuhan */
  background-color: #ffffff;
  color: white;
  padding-top: 20px;
  padding-bottom: 20px;
  display: flex;
  flex-direction: column;
}

/* Dropdown Container */
.dropdown {
  position: relative;
  display: block;
  margin-bottom: 0;
  margin-top: 15px; /* Menambahkan sedikit ruang di atas dropdown */
}

/* Dropdown Content */
.dropdown-content {
  display: none; /* Hidden by default */
  position: absolute;
  left: 0;
  background-color: #403c38;
  width: 100%; /* Pastikan dropdown memanjang sesuai lebar sidebar */
  z-index: 10;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  border-radius: 5px;
}

/* Link dalam dropdown */
.dropdown-content a {
  display: block;
  padding: 10px 15px;
  color: white;
  text-decoration: none;
}

.dropdown-content a:hover {
  background-color: #555;
}

/* Menambah sedikit animasi ketika dropdown terbuka */
#dropdown-btn.active i.fas.fa-chevron-down {
  transform: rotate(180deg); /* Rotasi chevron saat dropdown terbuka */
}

/* Styling untuk item sidebar lainnya */
.sidebar a {
  padding: 10px 15px;
  margin-bottom: 8px; /* Memberikan jarak antar item */
  color: white;
  text-decoration: none;
}

/* Tambahkan margin atau padding untuk memberi ruang saat dropdown terbuka */
.sidebar.open-dropdown .dropdown-content {
  display: block;
  margin-bottom: 10px; /* Menambahkan ruang ekstra setelah dropdown */
}

      body {
        margin: 0;
        padding: 0;
        font-family: "Roboto", sans-serif;
      }

      header {
        position: fixed;
        background: #393422e6;
        padding: 20px;
        width: 100%;
        height: 30px;
      }

      img {
        display: block;
        margin-left: auto;
        margin-right: auto;
      }

      .left_area span {
        color: #89d99a;
      }

      .left_area h3 {
        color: #fff;
        margin: 0;
        text-transform: uppercase;
        font-size: 24px;
        font-weight: 900;
      }

      .sidebar {
        background: #403c38;
        padding-top: 30px;
        position: fixed;
        left: 0;
        width: 20vw; /* Menyesuaikan lebar sidebar */
        height: 100%;
      }

      .sidebar .profile_image {
        width: 80px; /* Menyesuaikan ukuran gambar profil */
        height: 80px;
        border-radius: 50%;
        margin-bottom: 10px;
      }

      .sidebar h4 {
        color: #393422e6;
        margin-top: 0;
        margin-bottom: 20px;
      }

      .sidebar a {
        color: #ffffff;
        display: block;
        width: 100%;
        line-height: 50px; /* Mengurangi jarak antar navigasi */
        text-decoration: none;
        padding-left: 30px; /* Mengurangi padding kiri */
        box-sizing: border-box;
        transition: 0.5s;
        transition-property: background;
      }

      .sidebar a:hover {
        background: #dfba9b;
      }

      .sidebar i {
        padding-right: 10px;
      }

      .content {
        background:linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url("{{ asset('img/bg.jpeg') }}");
        background-position: center;
        background-size: cover;
        height: 100vh;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        z-index: -1;
      }

      .rightside {
        background: transparent;
        margin-left: 20vw; /* Menyesuaikan lebar sidebar */
        padding: 20px;

        overflow-y: auto; /* Menambahkan scroll jika konten terlalu panjang */  
      }

      .navbar {

        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

    table {
    width: 100%;
    margin: 25px 0;
    
    font-size: 18px;
    text-align: left;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  /* Container tabel */
.table-container {
  margin: 20px;
  padding: 40px;
  padding-bottom: 0;
  display: flex;
}

/* Tabel */
.custom-table thead th {
  background-color: #ab9b76; /* Coklat semi transparan */
  font-weight: bold;
  position: relative;
  text-align: center;
  padding: 10px;
}

/* Sel data */
.custom-table tbody td {
  background-color: #fbf5e6;
  text-align: center;
  padding: 10px;
  position: relative;
}

/* Garis pemisah transparan (menggunakan pseudo-element) */
.custom-table tbody td::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 1px;
  background: rgba(0, 0, 0, 0.1); /* Garis tipis transparan */
}

/* Hapus border default */
.custom-table th,
.custom-table td {
  padding: 10px;
  text-align: left;
  border: 5px solid transparent;
}
.transparent-border-table th {
  background-color: #f8f8f8; /* Opsional: memberikan latar belakang berbeda untuk header */
  border-bottom: 2px solid transparent; /* Border bawah transparan pada th */
}

/* Tombol aksi */
.edit-btn,
.hapus-btn {

  cursor: pointer;
}

.edit-btn {
  background-color: #fffbcc; /* Kuning pucat */
  color: #333;
}

.hapus-btn {
  background-color: #f36e6e; /* Merah lembut */
  color: #fff;
}

.edit-btn:hover {
  background-color: #f8eaa4;
}

.hapus-btn:hover {
  background-color: #e05555;
}

.backcolor{
  
}

    </style>
  </head>

  <body>
    @include('layouts.sidebar')


  @yield('admin')

  </body>
  </html>
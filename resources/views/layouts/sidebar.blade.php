<div class="sidebar flex flex-col">
  <center>
    <img src="{{ asset('img/davi.png') }}" class="h-60 rounded-full mt-6 mb-3" alt="davi" />
    <h2 class="text-xl">Welcome,<span class=" font-bold"> Ananda Vianny Haliza</span></h2>
  </center>

  <!-- Profil Dropdown -->
  <div class="dropdown">
    <a class="" href="#" id="dropdown-btn" onclick="toggleDropdown(event)">
      <div class="flex align-middle"><i class="fas fa-desktop self-center"></i><span>Dashboard</span><i class="fas fa-chevron-down ms-auto self-center"></i></div>
    </a>
    <div class="dropdown-content" id="dropdown-content">
      <a href="{{ route ('admin.barang') }}">Barang</a>
      <a href="{{ route ('admin.pinjam') }}">Persetujuan</a>
    </div>
  </div>

  <!-- Other Links -->
  <a href="{{ route('admin.profile.edit') }}"><i class=" fa fa-people-ul"></i><span>Profil</span></a>

  
  <!-- Logout -->
  <form class=" mt-auto" method="POST" action="{{ route('logout') }}">
    @csrf
    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
      <i class="fas fa-sign-out-alt"></i><span>{{ __('Log Out') }}</span>
    </a>
  </form>
</div>

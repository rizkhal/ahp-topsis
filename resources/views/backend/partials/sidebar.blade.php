<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{route('admin.dashboard')}}">Small Title</a>
    </div>
    <ul class="sidebar-menu">
      <li class="{{active("admin/dashboard*")}}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
      <li class="menu-header">Perhitungan</li>
      <li class="{{ active('admin/calculate*') }}"><a class="nav-link" href="{{ route('admin.calculate.create') }}"><i class="fas fa-fire"></i> <span>Buat Perhitungan</span></a></li>
      <li class="#"><a class="nav-link" href="#"><i class="fas fa-fire"></i> <span>Hasil Perhitungan</span></a></li>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> Tentang Applikasi
      </a>
    </div>
  </aside>
</div>

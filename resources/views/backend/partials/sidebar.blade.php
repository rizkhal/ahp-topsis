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
      <li class="{{ active('admin/ahp') }}"><a class="nav-link" href="{{ route('admin.ahp.index') }}"><i class="fas fa-fire"></i> <span>AHP</span></a></li>
      <li class="#"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>Topsis</span></a></li>
      <li class="#"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>AHP - Topsis</span></a></li>
      <li class="menu-header">Pengujian</li>
      <li class="#"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>Hamming Distance</span></a></li>
      <li class="menu-header">Data Master</li>
      <li class="{{active('admin/criteria')}}"><a class="nav-link" href="{{ route('admin.criteria.index') }}"><i class="fas fa-fire"></i> <span>Criteria</span></a></li>
      <li class="{{active('admin/alternative')}}"><a class="nav-link" href="{{ route('admin.alternative.index') }}"><i class="fas fa-fire"></i> <span>Alternative</span></a></li>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> Tentang Applikasi
      </a>
    </div>
  </aside>
</div>

<div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
    <div>
      <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{ url('') }}/assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark" src="{{ url('') }}/assets/images/logo/logo_dark.png" alt=""></a>
        <div class="back-btn"><i class="fa-solid fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      </div>
      <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{ url('') }}/assets/images/logo/logo-icon.png" alt=""></a></div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn"><a href="index.html"><img class="img-fluid" src="{{ url('') }}/assets/images/logo/logo-icon.png" alt=""></a>
              <div class="mobile-back text-end"><span>Back</span><i class="fa-solid fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="pin-title sidebar-main-title">
              <div> 
                <h6>Pinned</h6>
              </div>
            </li>
            <li class="sidebar-main-title">
              <div>
                <h6 class="lan-1">General</h6>
              </div>
            </li>
            <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
              <a class="sidebar-link sidebar-title" href="{{ url('dashboard') }}">
                <svg class="stroke-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#stroke-home"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#fill-home"></use>
                </svg><span class="lan-3">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-main-title">
              <div>
                <h6>Master Data</h6>
              </div>
            </li>
            <li class="sidebar-list">
              <i class="fa-solid fa-thumbtack"></i>
              <a class="sidebar-link sidebar-title" href="{{ url('karyawan') }}">
                <svg class="stroke-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#stroke-user"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#fill-user"></use>
                </svg><span>Data Karyawan</span>
              </a>
            </li>
            <li class="sidebar-list">
              <i class="fa-solid fa-thumbtack"></i>
              <a class="sidebar-link sidebar-title" href="{{ url('jabatan') }}">
                <svg class="stroke-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#stroke-user"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#fill-user"></use>
                </svg><span>Data Jabatan</span>
              </a>
            </li>
            <li class="sidebar-list">
              <i class="fa-solid fa-thumbtack"></i>
              <a class="sidebar-link sidebar-title" href="{{ url('shift-karyawan') }}">
                <svg class="stroke-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#stroke-user"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#fill-user"></use>
                </svg><span>Data Shift</span>
              </a>
            </li>
            <li class="sidebar-main-title">
              <div>
                <h6>Absensi</h6>
              </div>
            </li>
            <li class="sidebar-list">
              <i class="fa-solid fa-thumbtack"></i>
              <a class="sidebar-link sidebar-title" href="{{ url('absensi/create') }}">
                <svg class="stroke-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#stroke-form"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#fill-form"> </use>
                </svg><span>Check In Absensi</span>
              </a>
            </li>
            <li class="sidebar-list">
              <i class="fa-solid fa-thumbtack"></i>
              <a class="sidebar-link sidebar-title" href="{{ url('absensi') }}">
                <svg class="stroke-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#stroke-table"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ url('') }}/assets/svg/icon-sprite.svg#fill-table"></use>
                </svg><span>Data Absensi</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
</div>
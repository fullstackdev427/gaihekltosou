<header id="header" class="sticky-top">
  <div class="d-flex bg-topbar justify-content-center">
    <div class="topbar-center" style="text-align:center;">
      <a class="text-white page-title" href="#">@yield('title')</a>
    </div>
    <div class="topbar-right">
      <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#header-toggle-menu" aria-controls="header-toggle-menu" aria-expanded="false">
        <i class="fa fa-bars"></i>
      </button>
    </div>
  </div>

  <div class="collapse navbar-collapse" id="header-toggle-menu">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('painter.login') }}">ログイン</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('painter.entry') }}">新規登録</a>
      </li>
    </ul>
  </div>
</header>
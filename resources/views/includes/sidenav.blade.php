<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/ml_logo.png') }}" class="navbar-brand-img" />
            </a>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                @foreach(session('parentmenu') as $parentmenus)
                  <h6 class="navbar-heading p-0 text-muted">
                      <span class="docs-normal"><i class="ni ni-single-copy-04"></i> {{ $parentmenus->label }}</span>
                  </h6>
                  <ul class="navbar-nav mb-md-3">
                      @foreach(session('childmenu') as $childmenus)
                          @if($parentmenus->id == $childmenus->parent)
                              <li class="nav-item">
                                  <a class="nav-link loading" href="{{ $childmenus->link }}">
                                      {{-- <i class="ni ni-spaceship"></i> --}}
                                      <span class="nav-link-text">{{$childmenus->label}}</span>
                                  </a>
                              </li>
                          @endif
                      @endforeach
                  </ul>
                @endforeach
            </div>
        </div>
    </div>
</nav>
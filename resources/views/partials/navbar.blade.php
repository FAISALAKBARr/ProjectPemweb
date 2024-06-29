<nav class="navbar shadow-sm navbar-expand sticky-top" id="navbar">
    <div class="logo_details">
        @if(!Request::is('profile'))
            <i class="bi bi-list" id="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="@lang('navbar.Toggle Menu')"></i>
        @endif
        <div class="logo_name">
            <a href="{{ ("/") }}" class="text-decoration-none">
                <img src="{{ asset('img/internet-cafe.png') }}" class="mb-1" alt="Internet Cafe Logo" width="20" height="20">
                Todo-List
            </a>
        </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle rounded py-1" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Settings">
                    <i class="bi bi-gear"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li class="mb-1">
                        <div class="form-check form-switch mx-3">
                            <label class="form-check-label" for="themeSwitch">
                                <i id="themeIcon" class="bi bi-moon"></i>
                            </label>
                            <input class="form-check-input" type="checkbox" role="switch" id="themeSwitch" checked>
                        </div>
                    </li>
                    <li class="mb-1">
                        <form action="{{ route('profile') }}">
                            @csrf
                            <button type="submit" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="left" title="Profile"><i class="bi bi-person"></i> Profile</button>
                        </form>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="left" title="Log Out"><i class="bi bi-box-arrow-right"></i> Log Out</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<script>
    // JavaScript to open language dropdown on hover
    document.getElementById("languageDropdown").addEventListener("mouseenter", function () {
        this.classList.add("show");
        this.querySelector(".dropdown-menu").classList.add("show");
    });

    document.getElementById("languageDropdown").addEventListener("mouseleave", function () {
        this.classList.remove("show");
        this.querySelector(".dropdown-menu").classList.remove("show");
    });
</script>
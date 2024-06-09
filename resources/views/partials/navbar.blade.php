<nav class="navbar bg-light shadow-sm navbar-expand sticky-top" id="navbar">
    <div class="logo_details">
        <div class="logo_name">
            <a href="" class="text-decoration-none">Todo-List</a>
        </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <form class="d-flex search-form" action="" method="GET">
                    <div class="input-group" style="margin-top: 3px; margin-right: 3px;">
                        <input class="form-control border-dark-subtle rounded-start search-input" type="search" name="query" placeholder="Search tasks" aria-label="Search" required>
                        <button class="btn border-dark-subtle rounded-end search-button" type="submit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Search"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </li>
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
                        <form action="">
                            @csrf
                            <button type="submit" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="left" title="Profile"><i class="bi bi-person"></i> Profile</button>
                        </form>
                    </li>
                    <li class="dropdown mb-1" id="languageDropdown">
                        <a class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="left" title="Language"><i class="bi bi-translate"></i> Language</a>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href=""><i class="flag-icon flag-icon-id"></i> Bahasa Indonesia</a></li>
                            <li><a class="dropdown-item" href=""><i class="flag-icon flag-icon-us"></i> English</a></li>
                        </ul>
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

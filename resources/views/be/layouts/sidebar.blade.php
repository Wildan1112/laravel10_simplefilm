<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Ziu<span>UI</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">data</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Email</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/email/inbox.html" class="nav-link">Inbox</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Read</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/compose.html" class="nav-link">Compose</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('film.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="film"></i>
                    <span class="link-title">Films</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('status.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Status</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('genre.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="tag"></i>
                    <span class="link-title">Genre</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('type.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="type"></i>
                    <span class="link-title">Type</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('network.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="rss"></i>
                    <span class="link-title">Network</span>
                </a>
            </li>
            <li class="nav-item nav-category">Setting</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false"
                    aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">UI Kit</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
            </li>

        </ul>
    </div>
</nav>

<header class="header">
    <div class="container">
        <nav class="navbar">
            <a class="navbar-brand" href="{{ l_route('site.home') }}"><strong>Div</strong>Span</a>
            <button class="navbar-toggle" id="navbarToggle" type="button" aria-label="Toggle navigation">
                <span class="navbar-toggle-icon"></span>
            </button>
            <ul class="nav-list justify-content-center align-items-center" id="navbarMenu">
                <li class="nav-item"><a href="#home" class="nav-link active">{{ __('site.navbar.home') }}</a></li>
                <li class="nav-item"><a href="#portfolio" class="nav-link">{{ __('site.navbar.portfolio') }}</a></li>
                <li class="nav-item"><a href="#contact" class="nav-link">{{ __('site.navbar.contact') }}</a></li>
            </ul>
            <div class="dropdown locale-selector">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-globe me-2"></i>{{ strtoupper(app()->getLocale()) }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end locale-menu">
                    @foreach(config('translatable.locales') as $locale)
                        <li>
                            <a class="dropdown-item @if(app()->getLocale() === $locale) active @endif" 
                               href="{{ changeLocaleUrl($locale) }}" data-locale="{{ $locale }}">
                                @switch($locale)
                                    @case('en')
                                        <i class="bi bi-circle-fill me-2"></i> English
                                        @break
                                    @case('ru')
                                        <i class="bi bi-circle-fill me-2"></i> Русский
                                        @break
                                    @case('uz')
                                        <i class="bi bi-circle-fill me-2"></i> O'zbekcha
                                        @break
                                @endswitch
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</header>
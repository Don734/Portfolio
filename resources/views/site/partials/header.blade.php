<header class="header">
    <div class="container">
        <nav class="navbar">
            <a class="navbar-brand" href="{{ l_route('site.home') }}"><strong>Div</strong>Span</a>
            <ul class="nav-list justify-content-center align-items-center">
                <li class="nav-item"><a href="#home" class="nav-link active">{{ __('site.navbar.home') }}</a></li>
                <li class="nav-item"><a href="#portfolio" class="nav-link">{{ __('site.navbar.portfolio') }}</a></li>
                <li class="nav-item"><a href="#contact" class="nav-link">{{ __('site.navbar.contact') }}</a></li>
            </ul>
            <div class="dropdown locale-selector">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-globe me-2"></i>{{ strtoupper(app()->getLocale()) }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach(config('translatable.locales') as $locale)
                        <li>
                            <a class="dropdown-item @if(app()->getLocale() === $locale) active @endif" 
                               href="{{ changeLocaleUrl($locale) }}"
                               onclick="setLocale('{{ $locale }}'); return false;">
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

@push('scripts')
<script>
function setLocale(locale) {
    // Save locale in cookie for 1 year
    document.cookie = `locale=${locale}; path=/; max-age=${365 * 24 * 60 * 60}`;
    
    // Get current path without locale prefix
    let path = window.location.pathname;
    const currentLocale = '{{ app()->getLocale() }}';
    
    // Delete current locale from path if exists
    if (path.startsWith(`/${currentLocale}`)) {
        path = path.substring(currentLocale.length + 1);
    }
    if (!path.startsWith('/')) {
        path = '/' + path;
    }
    
    // Redirect to the same path with new locale
    window.location.href = `/${locale}${path}`;
}
</script>
@endpush
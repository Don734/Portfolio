<footer class="footer">
    <div class="container footer-inner">
        <div class="row align-items-center footer-content mt-5">
            <div class="col-md-4 text-md-start text-center mb-3 mb-md-0">
                <ul class="footer-menu">
                    {{-- <li><a href="#">{{ __('site.navbar.services') }}</a></li> --}}
                    <li><a href="#">{{ __('site.navbar.portfolio') }}</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <div class="footer-logo"><strong>Div</strong>Span</div>
            </div>
            <div class="col-md-4 text-md-end text-center">
                <div class="footer-socials">
                    @foreach (socialLinks() as $name => $link)
                        <a href="{{ $link }}"><i class="bi bi-{{$name}}"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="footer-bottom mt-4">
            <span>© {{now()->year}}. {{ __('site.footer-copyright') }}.</span>
        </div>
    </div>
</footer>
<footer class="footer">
    <div class="container footer-inner">
        <div class="row align-items-center footer-content mt-5">
            <div class="col-md-4 text-md-start text-center mb-3 mb-md-0">
                <ul class="footer-menu">
                    <li><a href="#">Service</a></li>
                    <li><a href="#">Portfolio</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <div class="footer-logo">DivSpan</div>
            </div>
            <div class="col-md-4 text-md-end text-center">
                <div class="footer-socials">
                    @foreach (config('meta.socials') as $social)
                        <a href="{{$social['link']}}"><i class="{{$social['icon']}}"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="footer-bottom mt-4">
            <span>© {{now()->year}}. All rights reserved.</span>
        </div>
    </div>
</footer>
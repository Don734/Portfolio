<section id="banner">
    <span class="notch-card"></span>
    <div class="layout">
        <div class="card left-card"></div>
        <div class="center-shape"></div>
        <div class="card right-card"></div>
    </div>
    <div class="row align-items-center position-relative z-1">
        <!-- LEFT -->
        <div class="col-lg-7 banner-left">
            <div class="d-flex align-items-center">
                <span class="badge banner-badge corner-badge full">
                    <span></span>
                    Welcome To My World
                </span>
                <div class="banner-socials ms-4">
                    @foreach (config('meta.socials') as $social)
                        <a href="{{$social['link']}}"><i class="{{$social['icon']}}"></i></a>
                    @endforeach
                </div>
            </div>
            <h1 class="banner-title">
                I Design & Build <br>
                <span>Unique Product.</span>
            </h1>
            {{-- <div class="banner-actions mt-4">
                <a href="#" class="btn btn-primary">
                    Download CV <i class="bi bi-download ms-1"></i>
                </a>
            </div> --}}
            <a href="#portfolio" class="btn scroll-down mt-5">
                <span>Scroll Down</span>
                <i class="bi bi-arrow-down-circle"></i>
            </a>
        </div>
        <!-- RIGHT -->
        <div class="col-lg-5 d-none d-lg-block">
            <div class="banner-image-placeholder"></div>
        </div>
    </div>
</section>
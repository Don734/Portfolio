<section id="portfolio">
    <div class="section-header">
        <div class="badge corner-badge full">
            <span></span>
            My Portfolio
        </div>
        <h4 class="section-title">My Recent Works</h4>
    </div>
    <ul class="nav nav-tabs" id="portfolioTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button 
                class="nav-link active" 
                data-bs-toggle="tab" 
                data-bs-target="#all-tab-pane"
                type="button" 
                role="tab" 
                data-category="all"
            >
                All Projects
            </button>
        </li>
        @foreach ($categories as $category)
            <li class="nav-item" role="presentation">
                <button 
                    class="nav-link" 
                    data-bs-toggle="tab"
                    data-bs-target="#html-{{ $category->slug }}"
                    type="button" 
                    role="tab" 
                    data-category="{{ $category->slug }}"
                >
                    {{$category->title}}
                </button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="portfolioTab">
        <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel">
            @include('site.partials.projects', ['projects' => $projects])
        </div>
        @foreach ($categories as $category)
            <div 
                class="tab-pane fade" 
                id="html-{{$category->slug}}" 
                role="tabpanel" 
                data-loaded="false"
                data-skeleton='@json(view("site.partials.skeleton")->render())'
            ></div>
        @endforeach
    </div>
</section>

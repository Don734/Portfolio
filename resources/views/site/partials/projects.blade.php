<div class="row row-cols-1 row-cols-md-2 g-3">
    @foreach ($projects as $project)
        <div class="col">
            <div class="card">
                <div class="card-image">
                    <img src="./assets/img/works/seccamera.png" class="card-img-top" alt="{{$project->slug}}">
                </div>
                <div class="card-body">
                    <small class="tag">{{__('enums.project_type.'.$project->type->value)}}</small>
                    <h5 class="card-title">
                        <a href="#">{{$project->title}}</a>
                    </h5>
                </div>
            </div>
        </div>
    @endforeach
</div>
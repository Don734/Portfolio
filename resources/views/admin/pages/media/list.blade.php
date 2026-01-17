@extends('layouts.admin')

@section('title', 'Media')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Media',
        'list' => [
            [
                'name' => 'Media',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
<div class="container">
    @if ($media->count())
        <div class="row row-cols-1 row-cols-md-5 g-4 mt-4">
            @foreach ($media as $item)
                <div class="col">
                    <div class="card card-media">
                        <img src="{{ $item->getUrl() }}" class="card-img-top object-fit-contain" alt="media">
                        <div class="card-body">
                            <p class="card-text small">{{ $item->name }}</p>
                            <small class="text-muted">{{ $item->collection_name }}</small>
                        </div>
                        <div class="card-footer">
                            {{-- <a href="{{ dashboard_route(config("admin.route_name_prefix").'media.show', ['media'=>$item->id]) }}" class="btn btn-sm btn-info">View</a> --}}
                            <form action="{{ dashboard_route(config("admin.route_name_prefix").'media.destroy', ['media'=>$item->id]) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $media->links() }}
    @else
        <div class="alert alert-info">No media files</div>
    @endif
</div>
@endsection
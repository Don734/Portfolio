@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Settings',
        'list' => [
            [
                'name' => 'Settings',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
    <div class="container-fluid py-4">
        <form action="{{ dashboard_route(config("admin.route_name_prefix").'settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs mb-4" role="tablist">
                @foreach($settings as $group => $groupSettings)
                    <li class="nav-item">
                        <button 
                            class="nav-link @if($loop->first) active @endif" 
                            type="button" 
                            role="tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#tab-{{ $group }}"
                        >
                            <i class="fas fa-cog me-2"></i>
                            {{ ucfirst($group) }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
                @foreach($settings as $group => $groupSettings)
                    <div class="tab-pane fade @if($loop->first) show active @endif" id="tab-{{ $group }}">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">{{ ucfirst($group) }} Settings</h5>
                            </div>
                            <div class="card-body">
                                @foreach($groupSettings as $key => $setting)
                                    @include('admin.pages.settings.components.form-field', [
                                        'group' => $group,
                                        'key' => $key,
                                        'setting' => $setting,
                                        'definition' => $config[$group][$key] ?? [],
                                    ])
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="btn btn-form">@lang('admin.save')</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    // Bootstrap form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            let forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endpush
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
            <div class="col mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <ul class="nav nav-tabs" role="tablist">
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
                            <div class="btn-group gap-2" role="group">
                                <button type="submit" class="btn btn-form">@lang('admin.save')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                @foreach($settings as $group => $groupSettings)
                    <div class="tab-pane fade @if($loop->first) show active @endif" id="tab-{{ $group }}">
                        @foreach($groupSettings as $key => $setting)
                            <div class="card card-form mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">@lang('admin.info')</h5>
                                    <p class="card-subtitle">Here you can change general information</p>
                                </div>
                                <div class="card-body">
                                    @include('admin.pages.settings.components.form-field', [
                                        'group' => $group,
                                        'key' => $key,
                                        'setting' => $setting,
                                        'definition' => $settingsDefinitions[$group][$key] ?? [],
                                    ])
                                </div>
                            </div>
                        @endforeach
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">{{ ucfirst($group) }} Settings</h5>
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                @endforeach
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
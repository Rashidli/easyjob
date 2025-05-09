@include('admin.includes.header')
<style>
    .card {
        border-radius: 8px;
        border: 1px solid #e3e6f0;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        padding: 15px 20px;
        background-color: #007bff;
        color: white;
    }

    .nav-tabs .nav-link {
        color: #007bff;
        border: 1px solid #dee2e6;
        margin-right: 5px;
        border-radius: 4px;
    }

    .nav-tabs .nav-link.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .form-control {
        border-radius: 4px;
        border: 1px solid #ced4da;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .text-danger {
        font-size: 0.875rem;
    }

    .pagination {
        justify-content: center;
    }

</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">Əlavə et</h4>
                    </div>

                    <div class="card-body">
                        <!-- Language Tabs -->
                        <ul class="nav nav-tabs mb-4" id="languageTab" role="tablist">
                            @foreach(['az', 'en', 'ru'] as $lang)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if($loop->first) active @endif" id="{{ $lang }}-tab" data-bs-toggle="tab" href="#{{ $lang }}" role="tab" aria-controls="{{ $lang }}" aria-selected="true">
                                        {{ strtoupper($lang) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="languageTabContent">
                            @foreach(['az', 'en', 'ru'] as $lang)
                                <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $lang }}" role="tabpanel" aria-labelledby="{{ $lang }}-tab">
                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-md-6">
                                            <h5 class="mb-3">Başlıq və Mətn</h5>

                                            <!-- Title -->
                                            <div class="mb-3">
                                                <label class="col-form-label">Başlıq* {{ $lang }}</label>
                                                <input class="form-control" type="text" value="{{ old($lang . '_title') }}" name="{{ $lang }}_title">
                                                @error("{$lang}_title")
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Description -->
                                            <div class="mb-3">
                                                <label class="col-form-label">Text* {{ $lang }}</label>
                                                <textarea id="editor_{{ $lang }}" class="form-control" name="{{ $lang }}_description">{{ old($lang . '_description') }}</textarea>
                                                @error("{$lang}_description")
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <h5 class="mb-3">Şəkil Etiketləri</h5>

                                            <!-- Image Title Tag -->
                                            <div class="mb-3">
                                                <label class="col-form-label">Title tag {{ $lang }}</label>
                                                <input class="form-control" type="text" name="{{ $lang }}_img_title" value="{{ old($lang . '_img_title') }}">
                                                @error("{$lang}_img_title")
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Image Alt Tag -->
                                            <div class="mb-3">
                                                <label class="col-form-label">Alt tag {{ $lang }}</label>
                                                <input class="form-control" type="text" name="{{ $lang }}_img_alt" value="{{ old($lang . '_img_alt') }}">
                                                @error("{$lang}_img_alt")
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <h5 class="mb-3">Meta Tags</h5>

                                            <!-- Meta Title -->
                                            <div class="mb-3">
                                                <label class="col-form-label">Meta title {{ $lang }}</label>
                                                <input class="form-control" type="text" name="{{ $lang }}_meta_title" value="{{ old("{$lang}_meta_title") }}">
                                                @error("{$lang}_meta_title")
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Meta Description -->
                                            <div class="mb-3">
                                                <label class="col-form-label">Meta description {{ $lang }}</label>
                                                <textarea class="form-control" name="{{ $lang }}_meta_description">{{ old("{$lang}_meta_description") }}</textarea>
                                                @error("{$lang}_meta_description")
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="col-form-label">Meta keywords {{ $lang }}</label>
                                                <textarea class="form-control" name="{{ $lang }}_meta_keywords">{{ old("{$lang}_meta_keywords") }}</textarea>
                                                @error("{$lang}_meta_keywords")
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Image Upload and Save Button -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Şəkil</label>
                                    <input class="form-control" type="file" name="image">
                                    @error('image')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 text-end">
                                    <button class="btn btn-primary">Yadda saxla</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.includes.footer')

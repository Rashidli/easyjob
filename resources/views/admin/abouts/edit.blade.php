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
            <!-- Success Message -->
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <!-- Blog Update Form -->
            <form action="{{ route('abouts.update', $about->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}

                <div class="card">
                    <div class="card-body">
                        <!-- Breadcrumb Navigation -->
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb bg-light p-3 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('abouts.index') }}">Siyahı</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $about->translate('az')?->title }}</li>
                            </ol>
                        </nav>

                        <!-- Language Tabs -->
                        <ul class="nav nav-tabs" id="langTabs" role="tablist">
                            @foreach(['az', 'en', 'ru'] as $lang)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $lang }}-tab" data-bs-toggle="tab" href="#{{ $lang }}" role="tab" aria-controls="{{ $lang }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ strtoupper($lang) }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Language Content -->
                        <div class="tab-content mt-4" id="langTabsContent">
                            @foreach(['az', 'en', 'ru'] as $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $lang }}" role="tabpanel" aria-labelledby="{{ $lang }}-tab">
                                    <div class="row">
                                        <!-- Title Section -->
                                        <div class="col-md-6">
                                            <div class="card mb-3">
                                                <div class="card-header">Başlıq</div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Başlıq* {{ $lang }}</label>
                                                        <input type="text" class="form-control" name="{{ $lang }}_title" value="{{ $about->translate($lang)->title }}">
                                                        @error($lang.'_title')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Description Section -->
                                        <div class="col-md-6">
                                            <div class="card mb-3">
                                                <div class="card-header">Mətn</div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Text* {{ $lang }}</label>
                                                        <textarea id="editor_{{ $lang }}" class="form-control" name="{{ $lang }}_description">{{ $about->translate($lang)->description }}</textarea>
                                                        @error($lang.'_description')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Alt & Title Tags Section -->
                                        <div class="col-md-6">
                                            <div class="card mb-3">
                                                <div class="card-header">Alt və Title Taglar</div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Alt tag {{ $lang }}</label>
                                                        <input type="text" class="form-control" name="{{ $lang }}_img_alt" value="{{ $about->translate($lang)->img_alt }}">
                                                        @error($lang.'_img_alt')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Title tag {{ $lang }}</label>
                                                        <input type="text" class="form-control" name="{{ $lang }}_img_title" value="{{ $about->translate($lang)->img_title }}">
                                                        @error($lang.'_img_title')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <!-- Image Section -->
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header">Şəkil</div>
                                    <div class="card-body">
                                        <div class="mb-3 text-center">
                                            <img src="{{ asset('storage/' . $about->image) }}" style="width: 100px; height: 100px;" class="uploaded_image" alt="{{ $about->image }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Şəkil</label>
                                            <input type="file" name="image" class="form-control">
                                            @error('image')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Status Section -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Active</label>
                                    <select name="is_active" class="form-control">
                                        <option value="1" {{ old('is_active', $about->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $about->is_active) == 0 ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.includes.footer')


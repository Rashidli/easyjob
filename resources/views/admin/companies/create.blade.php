@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">əlavə et</h4>

                        <!-- Language Tabs -->
                        <ul class="nav nav-tabs" id="langTabs" role="tablist">
                            @foreach(['az', 'en', 'ru'] as $lang)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $lang }}-tab" data-bs-toggle="tab" href="#{{ $lang }}" role="tab" aria-controls="{{ $lang }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ strtoupper($lang) }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="langTabsContent">
                            @foreach(['az', 'en', 'ru'] as $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $lang }}" role="tabpanel" aria-labelledby="{{ $lang }}-tab">
                                    <div class="mb-3">
                                        <label class="col-form-label">Qısa text {{ strtoupper($lang) }}</label>
                                        <input class="form-control" type="text" value="{{ old($lang . '_short_title') }}" name="{{ $lang }}_short_title">
                                        @if($errors->first("{$lang}_short_title"))
                                            <small class="form-text text-danger">{{ $errors->first("{$lang}_short_title") }}</small>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Text* {{ strtoupper($lang) }}</label>
                                        <textarea id="editor_{{ $lang }}" class="form-control" name="{{ $lang }}_description">{{ old($lang . '_description') }}</textarea>
                                        @error("{$lang}_description")
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Company Name and Image -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Şirkət adı</label>
                                    <input class="form-control" type="text" name="title" value="{{ old('title') }}">
                                    @error('title')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Əlaqə nömrəsi</label>
                                    <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Şəkil</label>
                                    <input class="form-control" type="file" name="image">
                                    @error('image')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Select Categories</label>
                                <select name="categories[]" class="form-control js-example-basic-single" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('categories')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Email</label>
                                    <input class="form-control" type="email" name="email">
                                    @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" name="password">
                                    @error('password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>

                        <!-- Submit Button -->
                        <div class="mb-3">
                            <button class="btn btn-primary">Yadda saxla</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.includes.footer')

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

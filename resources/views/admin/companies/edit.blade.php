@include('admin.includes.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <form action="{{ route('companies.update', $company->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb" style="margin-bottom: 20px;">
                            <ol class="breadcrumb bg-light p-3 rounded">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Siyahı</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $company->translate('az')?->title }}</li>
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

                        <div class="tab-content" id="langTabsContent">
                            @foreach(['az', 'en', 'ru'] as $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $lang }}" role="tabpanel" aria-labelledby="{{ $lang }}-tab">
                                    <div class="mb-3">
                                        <label class="col-form-label">Qısa text {{ strtoupper($lang) }}</label>
                                        <input class="form-control" type="text" name="{{ $lang }}_short_title" value="{{ $company->translate($lang)?->short_title }}">
                                        @if($errors->first("{$lang}_short_title"))
                                            <small class="form-text text-danger">{{ $errors->first("{$lang}_short_title") }}</small>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Text* {{ strtoupper($lang) }}</label>
                                        <textarea id="editor_{{ $lang }}" class="form-control" name="{{ $lang }}_description">{{ $company->translate($lang)?->description }}</textarea>
                                        @error("{$lang}_description")
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Şirkət adı</label>
                                            <input type="text" name="title" class="form-control" value="{{$company->title}}">
                                            @error('title')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Əlaqə nömrəsi</label>
                                            <input type="text" name="phone" class="form-control" value="{{$company->phone}}">
                                            @error('phone')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" value="{{$company->email}}">
                                            @error('image')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control">
                                            @error('password')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Image Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header">Şəkil</div>
                                    <div class="card-body">
                                        <div class="mb-3 text-center">
                                            <img src="{{ asset('storage/' . $company->image) }}" style="width: 100px; height: 100px;" class="uploaded_image" alt="{{ $company->image }}">
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
                        <div class="form-group">
                            <label>Select Categories</label>
                            <select name="categories[]" class="form-control js-example-basic-single" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ in_array($category->id, $company->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
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

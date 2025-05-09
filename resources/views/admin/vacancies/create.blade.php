@include('admin.includes.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="{{ route('vacancies.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Vacancy əlavə et</h4>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Vakansiya adı</label>
                                    <input class="form-control" type="text" name="vacancy_name" value="{{ old('vacancy_name') }}">
                                    @if($errors->first('vacancy_name')) <small class="form-text text-danger">{{ $errors->first('vacancy_name') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Şirkət adı</label>
                                    <input class="form-control " type="text" name="company_name" placeholder="Opsional" value="{{ old('company_name') }}">
                                    @if($errors->first('company_name')) <small class="form-text text-danger">{{ $errors->first('company_name') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Şirkət Logo</label>
                                    <input class="form-control" type="file" name="company_logo">
                                    @if($errors->first('company_logo')) <small class="form-text text-danger">{{ $errors->first('company_logo') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Kateqoriya</label>
                                    <select class="form-control js-example-basic-single" name="category_id">
                                        <option selected disabled>Seçin</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('category_id')) <small class="form-text text-danger">{{ $errors->first('category_id') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Şirkət seçin</label>
                                    <select class="form-control js-example-basic-single" name="company_id">
                                        <option value="">Seçin</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->title }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('company_id')) <small class="form-text text-danger">{{ $errors->first('company_id') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Vəzifə Öhdəlikləri</label>
                                    <textarea id="editor_az" class="form-control" name="job_responsibilities">{{ old('job_responsibilities') }}</textarea>
                                    @if($errors->first('job_responsibilities')) <small class="form-text text-danger">{{ $errors->first('job_responsibilities') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Tələblər</label>
                                    <textarea id="editor_en" class="form-control" name="requirements">{{ old('requirements') }}</textarea>
                                    @if($errors->first('requirements')) <small class="form-text text-danger">{{ $errors->first('requirements') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">İş Şəraiti</label>
                                    <textarea id="editor_ru" class="form-control" name="working_conditions">{{ old('working_conditions') }}</textarea>
                                    @if($errors->first('working_conditions')) <small class="form-text text-danger">{{ $errors->first('working_conditions') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Müraciət tipi</label>
                                    <select class="form-control" name="app_type">
                                        <option value="email" {{ old('app_type') == 'email' ? 'selected' : '' }}>email</option>
                                        <option value="link" {{ old('app_type') == 'link' ? 'selected' : '' }}>link</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Müraciət vasitəsi</label>
                                    <input class="form-control" type="text" name="application_method" value="{{ old('application_method') }}">
                                    @if($errors->first('application_method')) <small class="form-text text-danger">{{ $errors->first('application_method') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Maaş (Opsional)</label>
                                    <input class="form-control" type="text" name="salary" placeholder="Opsional" value="{{ old('salary') }}">
                                    @if($errors->first('salary')) <small class="form-text text-danger">{{ $errors->first('salary') }}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Razılaşma (İs razılaşma)</label>
                                    <select class="form-control" name="is_negotiable">
                                        <option value="0" {{ old('is_negotiable') == '0' ? 'selected' : '' }}>Xeyr</option>
                                        <option value="1" {{ old('is_negotiable') == '1' ? 'selected' : '' }}>Bəli</option>
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label class="col-form-label">Premium?</label>
                                    <select class="form-control" name="is_premium">
                                        <option value="0" {{ old('is_premium') == '0' ? 'selected' : '' }}>Xeyr</option>
                                        <option value="1" {{ old('is_premium') == '1' ? 'selected' : '' }}>Bəli</option>
                                    </select>
                                </div>
                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="col-form-label">Vakansiya Statusu</label>
                                    <select name="status" class="form-control" id="status_vacancy">
                                        @foreach(\App\Enums\VacancyStatus::cases() as $status)
                                            <option value="{{ $status->value }}">{{ $status->label() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Yayımlanma Tarixi</label>
                                    <input class="form-control" type="datetime-local" name="published_at" value="{{ old('published_at') }}">
                                </div>


                                <div class="mb-3">
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

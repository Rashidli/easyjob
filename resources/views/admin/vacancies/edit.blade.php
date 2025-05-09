@include('admin.includes.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="{{ route('vacancies.update', $vacancy->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $vacancy->vacancy_name }}</h4>
                        <div class="row">
                            <div class="col-6">

                                <!-- Vacancy Name -->
                                <div class="mb-3">
                                    <label class="col-form-label">Vakansiya adı</label>
                                    <input class="form-control" type="text" name="vacancy_name" value="{{ old('vacancy_name', $vacancy->vacancy_name) }}">
                                    @error('vacancy_name') <small class="form-text text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Slug -->
                                <div class="mb-3">
                                    <label class="col-form-label">Slug</label>
                                    <input class="form-control" type="text" name="slug" value="{{ old('slug', $vacancy->slug) }}">
                                    @error('slug') <small class="form-text text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Baxış sayı</label>
                                    <input class="form-control" type="number" name="views_count" value="{{ old('views_count', $vacancy->views_count) }}" placeholder="Opsional">
                                </div>
                                <!-- Company Name -->
                                <div class="mb-3">
                                    <label class="col-form-label">Şirkət adı</label>
                                    <input class="form-control" type="text" name="company_name" value="{{ old('company_name', $vacancy->company_name) }}" placeholder="Opsional">
                                </div>

                                <!-- Company Name -->


                                <!-- Company Logo -->
                                <div class="mb-3">
                                    <label class="col-form-label">Şirkət Logo</label>
                                    @if($vacancy->company_logo)
                                        <img style="width: 100px; height: 100px;" src="{{ asset('storage/' . $vacancy->company_logo) }}" class="uploaded_image">
                                    @endif
                                    <input class="form-control" type="file" name="company_logo">
                                </div>

                                <!-- Category -->
                                <div class="mb-3">
                                    <label class="col-form-label">Kateqoriya</label>
                                    <select class="form-control js-example-basic-single" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $vacancy->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Company -->
                                <div class="mb-3">
                                    <label class="col-form-label">Şirkət</label>
                                    <select class="form-control js-example-basic-single" name="company_id">
                                        <option value="">Seçin</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ $vacancy->company_id == $company->id ? 'selected' : '' }}>{{ $company->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Job Responsibilities -->
                                <div class="mb-3">
                                    <label class="col-form-label">Vəzifə öhdəlikləri</label>
                                    <textarea id="editor_az" class="form-control" name="job_responsibilities">{{ old('job_responsibilities', $vacancy->job_responsibilities) }}</textarea>
                                    @error('job_responsibilities') <small class="form-text text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Requirements -->
                                <div class="mb-3">
                                    <label class="col-form-label">Tələblər</label>
                                    <textarea id="editor_en" class="form-control" name="requirements">{{ old('requirements', $vacancy->requirements) }}</textarea>
                                    @error('requirements') <small class="form-text text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Working Conditions -->
                                <div class="mb-3">
                                    <label class="col-form-label">İş şəraiti</label>
                                    <textarea id="editor_ru" class="form-control" name="working_conditions">{{ old('working_conditions', $vacancy->working_conditions) }}</textarea>
                                    @error('working_conditions') <small class="form-text text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Application Type -->
                                <div class="mb-3">
                                    <label class="col-form-label">Müraciət tipi</label>
                                    <select name="app_type" class="form-control">
                                        <option selected disabled>Seçin</option>
                                        <option value="email" {{ $vacancy->app_type == 'email' ? 'selected' : '' }}>email</option>
                                        <option value="link" {{ $vacancy->app_type == 'link' ? 'selected' : '' }}>link</option>
                                    </select>
                                </div>

                                <!-- Application Method -->
                                <div class="mb-3">
                                    <label class="col-form-label">Müraciət vasitəsi</label>
                                    <input class="form-control" type="text" name="application_method" value="{{ old('application_method', $vacancy->application_method) }}">
                                    @error('application_method') <small class="form-text text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Salary -->
                                <div class="mb-3">
                                    <label class="col-form-label">Maaş</label>
                                    <input class="form-control" type="text" name="salary" value="{{ old('salary', $vacancy->salary) }}" placeholder="Opsional">
                                    @error('salary') <small class="form-text text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Negotiable -->
                                <div class="mb-3">
                                    <label class="col-form-label">Razılaşma</label>
                                    <select name="is_negotiable" class="form-control">
                                        <option value="1" {{ old('is_negotiable', $vacancy->is_negotiable) ? 'selected' : '' }}>Bəli</option>
                                        <option value="0" {{ !old('is_negotiable', $vacancy->is_negotiable) ? 'selected' : '' }}>Xeyr</option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="col-form-label">Vakansiya Statusu</label>
                                    <select name="status" class="form-control" id="status_vacancy">
                                        @foreach(\App\Enums\VacancyStatus::cases() as $status)
                                            <option value="{{ $status->value }}" {{ $vacancy->status === $status->value ? 'selected' : '' }}>{{ $status->label() }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Notes (Conditional Textarea) -->
                                <div class="mb-3" id="notes-section" style="display: none;">
                                    <label class="col-form-label">Qeydlər</label>
                                    <textarea class="form-control" name="notes" placeholder="Status dəyişikliyi üçün qeydlər..."></textarea>
                                </div>

                                <!-- Premium -->
                                <div class="mb-3">
                                    <label class="col-form-label">Premium</label>
                                    <select name="is_premium" class="form-control">
                                        <option value="1" {{ old('is_premium', $vacancy->is_premium) ? 'selected' : '' }}>Bəli</option>
                                        <option value="0" {{ !old('is_premium', $vacancy->is_premium) ? 'selected' : '' }}>Xeyr</option>
                                    </select>
                                </div>

                                <!-- Published At -->
                                <div class="mb-3">
                                    <label class="col-form-label">Yayımlanma Tarixi</label>
                                    <input class="form-control" type="datetime-local" name="published_at" value="{{ old('published_at', $vacancy->published_at ? $vacancy->published_at->format('Y-m-d\TH:i') : '') }}">
                                </div>

                                <!-- Created At -->
                                <div class="mb-3">
                                    <label class="col-form-label">Yaradılma Tarixi</label>
                                    <input class="form-control" type="text" name="created_at" value="{{ old('created_at', $vacancy->created_at->format('Y-m-d H:i:s')) }}" readonly>
                                </div>

                                <!-- Save Button -->
                                <div class="mb-3">
                                    <button class="btn btn-primary">Yadda saxla</button>
                                </div>

                            </div>
                            <div class="col-6">
                                @if($vacancy->notes)
                                    {{$vacancy->notes}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.includes.footer')

<script>
    document.getElementById('status_vacancy').addEventListener('change', function() {
        const notesSection = document.getElementById('notes-section');
        if (this.value === 'returned') {
            notesSection.style.display = 'block';
        } else {
            notesSection.style.display = 'none';
        }
    });
</script>

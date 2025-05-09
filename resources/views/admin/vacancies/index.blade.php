@include('admin.includes.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                            <h4 class="card-title">Vakansiyalar</h4>
                            <a href="{{ route('vacancies.create') }}" class="btn btn-primary">+</a>
                            <br><br>

                            <!-- Search Form -->
                            <form action="{{ route('vacancies.index') }}" method="GET" class="row mb-4">
                                <div class="col-md-3">
                                    <input type="text" name="title" class="form-control" placeholder="Vakansiya adı"
                                           value="{{ request('title') }}">
                                </div>
                                <div class="col-md-3">
                                    <select name="category_id" class="form-control js-example-basic-single">
                                        <option value="">Kateqoriya seçin</option>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="status" class="form-control">
                                        <option value="" {{ request('status') === null ? 'selected' : '' }}>Vakansiya
                                            Statusu
                                        </option>
                                        @foreach(\App\Enums\VacancyStatus::cases() as $status)
                                            <option
                                                value="{{ $status->value }}" {{ request('status') === $status->value ? 'selected' : '' }}>                {{ $status->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="company_id" class="form-control js-example-basic-single">
                                        <option value="">Şirkət seçin</option>
                                        @foreach($companies as $company)
                                            <option
                                                value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                                {{ $company->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="is_site" class="form-control js-example-basic-single">
                                        <option value="" selected >Seçin</option>
                                            <option
                                                value="1" {{ request('is_site') == 1 ? 'selected' : '' }}>
                                                Sayt
                                            </option>
                                            <option
                                                value="0" {{ request('is_site') == 0 ? 'selected' : '' }}>
                                                Özüm
                                            </option>
                                    </select>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Axtar</button>
                                    <a href="{{ route('vacancies.index') }}" class="btn btn-secondary">Sıfırla</a>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Vakansiya Adı</th>
                                        <th>Kateqoriya</th>
                                        <th>Şirkət</th>
                                        <th>Status</th>
                                        <th>Saytdan?</th>
                                        <th>Əməliyyat</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($vacancies as $key => $vacancy)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td style="max-width: 100px; text-wrap: wrap;">{{ $vacancy->vacancy_name }}</td>
                                            <td>{{ $vacancy->category?->title }}</td>
                                            <td>{{ $vacancy->company?->title }}</td>
                                            <td>
                                                <span class="btn " style="{{\App\Enums\VacancyStatus::from($vacancy->status)->color()}}">{{ \App\Enums\VacancyStatus::from($vacancy->status)->label() }}  </span>
                                            </td>
                                            <td>
                                                @if($vacancy->is_site)
                                                    saytdan
                                                @else
                                                    özüm
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('vacancies.edit', $vacancy->id) }}"
                                                   class="btn btn-primary">Redaktə</a>
                                                <form action="{{ route('vacancies.destroy', $vacancy->id) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Sil</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $vacancies->appends(request()->query())->links('admin.vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.includes.footer')

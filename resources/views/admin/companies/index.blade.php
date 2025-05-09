@include('admin.includes.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('message'))
                                <div class="alert alert-success">{{session('message')}}</div>
                            @endif
                            <h4 class="card-title">Şirkətlər</h4>
                            <a href="{{route('companies.create')}}" class="btn btn-primary">+</a>
                            <br>
                            <br>
                            <form action="{{ route('companies.index') }}" method="GET" class="row mb-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="title" class="form-control" placeholder="Şirkət adı"
                                               value="{{ request('title') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Axtar</button>
                                        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Sıfırla</a>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Başlıq</th>
                                        <th>Telefon</th>
                                        <th>Icon</th>
                                        <th>Status</th>
                                        <th>Əməliyyat</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($companies as $key => $company)

                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <th scope="row">{{$company->title}}</th>
                                            <th scope="row">{{$company->phone}}</th>
                                            <td><img src="{{asset('storage/'.$company->image)}}"
                                                     style="width: 100px; height: 50px" alt=""></td>
                                            <td><a class="btn {{$company->is_active ? 'btn-success' : 'btn-danger'}}" href="{{route('toggle.status', $company->id)}}">{{$company->is_active ? 'Active' : 'Deactive'}}</a></td>

                                            <td>
                                                <a href="{{route('companies.edit',$company->id)}}"
                                                   class="btn btn-primary"
                                                   style="margin-right: 15px">Edit</a>
                                                <form action="{{route('companies.destroy', $company->id)}}"
                                                      method="post" style="display: inline-block">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')"
                                                            type="submit" class="btn btn-danger">Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                                <br>
                                {{ $companies->links('admin.vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.includes.footer')

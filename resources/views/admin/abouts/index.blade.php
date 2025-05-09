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
                            <h4 class="card-title">Haqqımızda</h4>
{{--                               <a href="{{route('abouts.create')}}" class="btn btn-primary">+</a>--}}
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">

                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Başlıq</th>
                                        <th>Status</th>
                                        <th>Əməliyyat</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($abouts as $about)

                                        <tr>
                                            <th scope="row">{{$about->id}}</th>
                                            <th scope="row">{{$about->title}}</th>
                                            {{--                                                <td><img src="{{asset('storage/'.$about->image)}}" style="width: 100px; height: 50px" alt=""></td>--}}
                                            <td>{{$about->is_active == true ? 'Active' : 'Deactive'}}</td>
                                            <td>
                                                <a href="{{route('abouts.edit',$about->id)}}" class="btn btn-primary"
                                                   style="margin-right: 15px">Edit</a>

                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                                <br>
                                {{ $abouts->links('admin.vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.includes.footer')

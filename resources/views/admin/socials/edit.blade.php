@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('socials.update', $social->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$social->title}}</h4>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq</label>
                                    <input class="form-control" type="text" name="title" value="{{$social->title}}">
                                    @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Link</label>
                                    <input class="form-control" type="text" name="link" value="{{$social->link}}">
                                    @if($errors->first('link')) <small class="form-text text-danger">{{$errors->first('link')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Icon</label>
                                    <input class="form-control" type="text" name="image" value="{{$social->image}}">
                                    @if($errors->first('image')) <small class="form-text text-danger">{{$errors->first('image')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Active</label>
                                    <select name="is_active" id="" class="form-control">
                                        <option value="1" {{$social->is_active == true ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{$social->is_active == false ? 'selected' : ''}}>Deactive</option>
                                    </select>
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

{{--<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>--}}
{{--<script>--}}
{{--    ClassicEditor--}}
{{--        .create( document.querySelector( '#editor_az' ) )--}}
{{--        .catch( error => {--}}
{{--            console.error( error );--}}
{{--        } );--}}

{{--    ClassicEditor--}}
{{--        .create( document.querySelector( '#editor_en' ) )--}}
{{--        .catch( error => {--}}
{{--            console.error( error );--}}
{{--        } );--}}

{{--    ClassicEditor--}}
{{--        .create( document.querySelector( '#editor_ru' ) )--}}
{{--        .catch( error => {--}}
{{--            console.error( error );--}}
{{--        } );--}}

{{--</script>--}}

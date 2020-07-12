@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card rounded border border-dark">
                <div class="card-header text-center alert-info font-weight-bold">Editar mi imagen</div>

                <div class="card-body">

                    <form method="POST" action="{{route('image.update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="image_id" value="{{$image->id}}"/>
                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-6">
                                @if($image->user->image)
                                <div style="display: block;">
                                    <a class="navbar-brand" style="padding-top: 10px; float: left; line-height: 0px"  href="#">
                                        <img   src="{{route('image.file',['filename'=>$image->image_path])}}"  class="rounded-circle" width="90px"  alt="auto">
                                    </a>
                                </div>
                                @endif
                                <input id="image_path" type="file" name="image_path" class="form-control">

                                @if($errors->has('image_path'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image_path') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">descripcion</label>
                            <div class="col-md-6">
                                <textarea id="description" type="text" name="description" class="form-control"> {{$image->description}}
                                   
                                </textarea>

                                @if($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group row">

                            <div class="col-md-6 offset-md-3">
                                <input type="submit" class="btn btn-primary" value="Actualizar imagen"/>




                            </div>

                        </div>


                    </form>
                </div>

            </div>   


        </div>
    </div>
</div>

@endsection




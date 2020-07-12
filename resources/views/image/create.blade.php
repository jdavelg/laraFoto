@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card rounded border border-dark">
                <div class="card-header text-center alert-info font-weight-bold">Subir nueva imagen</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('image.save')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-6">
                                <input id="image_path" type="file" name="image_path" class="form-control" required>
                                
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
                                <textarea id="description" type="text" name="description" class="form-control" >
                                    
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
                                <input type="submit" class="btn btn-primary" value="guardar imagen"/>
                                    
                               
                                
                              
                            </div>

                        </div>
                        

                    </form>
                </div>

            </div>   


        </div>
    </div>
</div>

@endsection



@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes.message')
                <div class="card">
                    <div class="card-header">Editar imagen</div>
                    <div class="card-body">
                        <form action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="image_id" value="{{$image->id}}"/>
                            <div class="form-group row">
                                <label for="image_path" class="col-md-4 col-form-label text-md-right">Imagen</label>
                                <div class="col-md-5">
                                    <div class="image-container">
                                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
                                    </div>
                                    <input id="image_path" type="file" class="form-control {{ $errors->has('image_path') ? ' is-invalid' : '' }}" name="image_path" />

                                    @if ($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                    @endif

                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Descripcion</label>
                                <div class="col-md-5">
                                    <textarea id="description" name="description" class="form-control" >{{ $image->description }}</textarea>
                                    @if($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <input name="btn-guardar-imagen" type="submit" class="btn btn-primary" value="Actualizar imagen"/>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


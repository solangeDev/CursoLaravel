@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar Contacto</div>
                <div class="card-body">
                <form enctype="multipart/form-data" action="{{route('store')}}" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="">
                    </div>
                    <label for="ident">Identity</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="identity" id="fem" value="f" checked>
                        <label class="form-check-label" for="fem">
                        Femenino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="identity" id="mas" value="m" checked>
                        <label class="form-check-label" for="mas">
                        Masculino
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="custom-file mt-3">
                        <input type="file" class="custom-file-input" id="validatedCustomFile">
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
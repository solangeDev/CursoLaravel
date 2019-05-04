@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{(is_null($contact))?"Registrar Contacto":"Modificar Contacto"}}</div>
                  @if(session()->get("msj")!="")
                    <div class="alert {{session()->get("error")?'alert-danger':'alert-success'}}" role="alert">
                        {{session()->get("msj")}}
                    </div>
                  @endif
                
                <div class="card-body">
                <form enctype="multipart/form-data" action="{{(is_null($contact))?route('store'):route('updateform',$contact->id)}}" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input value="{{(!is_null($contact))?$contact->name:null}}" type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="{{(!is_null($contact))?$contact->email:null}}" type="email" name="email" id="email" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input value="{{(!is_null($contact))?$contact->phone:null}}" type="text" name="phone" id="phone" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input value="{{(!is_null($contact))?$contact->age:null}}" type="num" name="age" id="age" class="form-control" placeholder="">
                    </div>
                    <label for="ident">Identity</label>
                    <div class="form-check">
                      @php
                          $checked_f = "checked";
                          $checked_m = "";
                          if(!is_null($contact) &&$contact->identy == "m"){
                            $checked_f = "";
                            $checked_m = "checked";
                          }
                      @endphp
                        <input class="form-check-input" type="radio" name="identity" id="fem" value="f" {{$checked_f}} >
                        <label class="form-check-label" for="fem">
                        Femenino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="identity" id="mas" value="m" {{$checked_m}}>
                        <label class="form-check-label" for="mas">
                        Masculino
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="custom-file mt-3">
                        <input type="file" name="image" class="custom-file-input" id="validatedCustomFile">
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                    @csrf
                    @if(!is_null($contact))
                     <input type="hidden" name="_method" value="PUT">
                    @endif
                    <a href="{{url("/home")}}" class="btn btn-danger">Atras</a>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
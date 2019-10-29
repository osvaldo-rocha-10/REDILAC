@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                {{ __('NuevoUsuario') }} <br><br>
                <strong style="color: red;">Campos requeridos *</strong>
                
                <div class="card-body">
                   <form method="POST" action="{{ route('register') }}">
                        @csrf
                    
                     <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                          {{ __('IdUsuario') }}
                            </label>

                              <div class="col-md-6">
                                <input id="idUsuario" type="text" class="form-control{{ $errors->has('idUsuario') ? ' is-invalid' : '' }}" name="idUsuario" value="{{ old('idUsuario') }}">

                                @if ($errors->has('idUsuario'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('idUsuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                      </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                          {{ __('Nombre') }}
                            </label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}">

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                         </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}  <strong style="color: red;">*</strong> </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}  <strong style="color: red;">*</strong></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

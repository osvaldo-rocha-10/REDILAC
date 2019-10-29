@extends('layouts.app')

@section('content')

     <link href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
     <link href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}" rel="stylesheet">
     <link href="{{ asset('vendor/animate/animate.css') }}" rel="stylesheet">
     <link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet">
     <link href="{{ asset('vendor/animsition/css/animsition.min.css') }}" rel="stylesheet">
     <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">
     <link href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
     <link href="{{ asset('css/util.css') }}" rel="stylesheet">
     <link href="{{ asset('css/main.css') }}" rel="stylesheet">
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
     <script src="{{ asset('js/jquery.backstretch.min.js') }}" ></script>

  <!-- Encabezado-->
  <header class="cabeza sticky-top">
        <div class="contHeader">
            <div class="escudo">
                <img src="{{ asset('img/Logos/escudoHeaderBUAP.png') }}">   
            </div>
            <div class="title">
                
            </div>
            <div class="title">
                Sistema de Repositorio de Recursos Digitales<br>e Información de los laboratorios de aprendizaje por <br> Competencias. <br>REDILAC.
            </div>
        </div>
    </header>

      <div class="limiter" id="mislider">
          <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(img/Benito/prepa.jpg);">
                    <span class="login100-form-title-1">
                        REDILAC 
                   
                    </span>
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="wrap-input100 validate-input m-b-26" data-validate="idUsuario is required">
                        <span class="label-input100" for="idCoordinador"><b>{{ __('Coordinador') }}</b></span>
                        <input class="input100 form-control{{ $errors->has('idCoordinador') ? ' is-invalid' : '' }} " id="idCoordinador" type="text" name="idCoordinador" value="{{ old('idCoordinador') }}" placeholder="Ingresa su Id de Coordinador">
                       <!-- <span class="focus-input100">
                        </span>-->
                         @if ($errors->has('idCoordinador'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('idCoordinador') }}</strong>
                                   </span>
                          @endif
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100" for="password"><b>{{ __('Contraseña') }}</b></span>
                        <input class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Ingrese su contraseña">
                        <!-- <span class="focus-input100">
                        </span>-->
                              @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            <b>  {{ __('INGRESAR') }} </b>
                        </button>
                    </div>
                      
                </form>
            </div>

          </div>
       </div>

       <footer class="cabeza sticky-top">
              <div class="contenedorA">
                <div class="columna1">
                    <img src="img/Logos/logo_buap.png" alt="">
                </div>
                <div class="columna2">
                    Benemérita Universidad Autónoma de Puebla.<br>4 sur 104 Centro Histórico<br>C.P. 72000 <br>Teléfono (222) 2 29 55 00
                </div>
                <div class="columna3">
                    Preparatoria: "Lic. Benito Juárez García"<br>Boulevard 14 sur y Circuito Juan Pablo II <br>Col. Jardines de San Manuel 
                    <br>Teléfono (222) 2 29 55 00 ext.2453 
                </div>
              </div>
            <div style="text-align: center; color:#ffffff;background-color:#003B5C; font-size: .8vw; ">
                Copyright © 2018 | <a style="text-decoration: none" href="mailto: carma.camacho@gmail.com">Contácto</a> 
            </div>
     </footer>
   
    

      <script>
      	 jQuery("#mislider").backstretch([
               "img/Benito/Espacio1.jpg"
                ,"img/Benito/Espacio2.jpg"
                ,"img/Benito/Espacio3.jpg"
                ,"img/Benito/Espacio4.jpg"
                ,"img/Benito/Espacio5.jpg"
                ,"img/Benito/Espacio6.jpg"
          ], {duration: 1000, fade: 1000});     
      </script>

@endsection

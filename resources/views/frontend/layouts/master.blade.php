<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Bil Wifi" content="{{ config('app.name') }} by KinDev">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty ($title) ? $title .' | '. config('app.name') : config('app.name') }}  </title>
    <!-- Fonts -->
    {{-- <link href = "https://fonts.googleapis.com/css?family= Roboto " rel = "stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- Styles --}}
    {{-- <link href="{{ asset('bootstrap/css/style.css') }}" rel="stylesheet"> --}}
    <style type="text/css">
        #loader{
           position: absolute;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           z-index: 9999;
           background-image: url({{ asset('img/loaderIspt.gif') }});
           background-repeat: no-repeat; 
           /*background-color: #333;*/
           background-position: center;
           opacity: 1;

        }
        #ajaxBox_loader{

        }
    </style>

    @yield('stylesheet')

</head>

<body >


    <div id="loader" hidden></div>
    
    <div id="main_page" style="width: 100%;height: auto;" >
      {{-- Container   --}}
      @yield('container')
      {{-- Session Flash --}}
      @yield('msg_flash')
    </div>
    <footer class="footer">
    @yield('footer')
         {{-- Script Jquery --}}
    {{-- <script src={{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}></script> --}}

        <script src="{{ asset('js/app.js') }}"></script> 
        {{-- Script Parsley --}}
        {{-- <script src="{{ asset('js/parsley/parsley.min.js') }}"></script>  --}}
    </footer>
@yield('script')
<script type="text/javascript">


// Fonction d'ajout ou de suppression du "loader"
function ajaxBox_loader(pState)
{
    // Ajout d'un élement <img> d'id #ajaxBox_loader
    if (pState === true){
    $("body").css({"opacity": "0.5"});
    $('#loader').removeAttr('hidden');
    // $('#exampleModalCenter').show();
    }
    // Suppression de l'élement d'id #ajaxBox_loader
    else{

    // $('#ajaxBox_loader').remove();
    $("body").css({"opacity": "1"});
    $('#loader').attr('hidden',true);

    // $('#exampleModalCenter').hidden();
    }

}
</script>
</body>
</html>

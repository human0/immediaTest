<!DOCTYPE html>
<html>
    <head>
        <meta name="_token" content="{!! csrf_token() !!}"/>
        <title>Immedia PHP Test</title>
    </head>
    <body>
        <h1> Coffee Locations : </h1>
        <ul></ul>
    

        <script src='https://code.jquery.com/jquery-1.11.0.min.js'></script>
        <script type="text/javascript">
            $.ajaxSetup({
               headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
        </script>
        <script src="{{URL('js/myscript.js')}}"> </script>

    </body>
</html>
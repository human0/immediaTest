<!DOCTYPE html>
<html>
    <head>
        <meta name="_token" content="{!! csrf_token() !!}"/>
        <title>Immedia PHP Test</title>
    </head>
    <body>
        <h1> Coffee Locations : </h1>

        {!! Form::open(array('route' => 'route.pics')) !!}
        
        {!! Form::label('search', 'Search something') !!}
        {!! Form::text('search') !!}

        {!! Form::hidden('lan') !!}
        {!! Form::hidden('lng') !!}

        {!! Form::submit("search") !!}

        @if ($pics)
        <ul>
            @foreach ($pics as $pic)
                <li> <img scr="{{$pic.link}}"> {{$pic->name . ' (' . $pic->caption . ')' }} </li>
            @endforeach
        </ul>
        {!! $pics->links() !!}
        @endif

        <button class="btn btn-primary" onclick="getVenues()">Discover More</button>

        <ul id='new-search'></ul>
    
        <script src='https://code.jquery.com/jquery-1.11.0.min.js'></script>
        <script type="text/javascript">
            $.ajaxSetup({
               headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
        </script>
        <script src="{{URL('js/myscript.js')}}"> </script>

    </body>
</html>
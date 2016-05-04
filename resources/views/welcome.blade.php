<!DOCTYPE html>
<html>
    <head>
        <meta name="_token" content="{!! csrf_token() !!}"/>
        <title>Immedia PHP Test</title>
        <link href="{{URL('css/mystyles.css')}}" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
          <div class="row">
            <h1 class="text-center"> Find Something In Your location </h1>

            {!! Form::open(['route' => 'pic.index', 'method' => 'get', 'class' => "text-center"]) !!}
            
            {!! Form::label('search', 'Search') !!}
            {!! Form::text('search', $search) !!}

            {!! Form::hidden('lat') !!}
            {!! Form::hidden('lng') !!}

            {!! Form::submit("Search Database", ['class'=>"btn btn-default" ]) !!}

            <button class="btn btn-primary" type='button' onclick="getVenues()">Discover New</button>
            
            {!! Form::close() !!}           
           
            <div class="row" id='new-search'>
                @if (isset($pics))
                    <div class="text-center"> {!! $pics->links() !!} </div>
                    @foreach ($pics as $pic)
                        <div class="col-lg-3 col-sm-4 col-xs-6"><a title="{{$pic->caption}}" href="#{{$pic->id}}"><img class="thumbnail img-responsive" src="{{$pic->link}}"></a></div>
                    @endforeach
                
                @endif
            </div>
          </div>
        </div>
        <div class="modal" id="myModal" role="dialog">
          <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <div id="modalCarousel" class="carousel">
                  <div class="carousel-inner"></div>                  
                    <a class="carousel-control left" href="#modaCarousel" data-slide="prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                    </a>
                    <a class="carousel-control right" href="#modalCarousel" data-slide="next">
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </a>        
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
           </div>
          </div>
        </div>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script type="text/javascript">
            $.ajaxSetup({
               headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
        </script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="{{URL('js/myscript.js')}}"> </script>

    </body>
</html>
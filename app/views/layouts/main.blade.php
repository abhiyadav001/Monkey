<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title></title>
        {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css') }}
        {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js')}}
        {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js')}}
        {{ HTML::style('css/main.css')}}
    </head>
    <body>

<!--        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav navbar-nav">
                        @if(!Auth::check())
                        <li>{{ HTML::link('users/register', 'Register') }}</li>
                        <li>{{ HTML::link('users/login', 'Login') }}</li>
                        @else
                        <li>{{ HTML::link('users/logout', 'logout') }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>-->


        <div class="container">
            @if(Session::has('message'))
            <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable">{{ Session::get('message') }}               <button type="button" class="close" data-dismiss="alert"
      aria-hidden="true">
      &times;
   </button>
       <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>         </div>

            @endif

            {{ $content }}
        </div>

    </body>
</html>
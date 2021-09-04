<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        
    </head>
    <body>
        
        <div class="container">
            <div class="row" style="margin-top:90px;">
                @for ($i = 1; $i < 9; $i++)
                
                    <div class="col-md-4 mt-5" style="border:1px solid black">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Profile</h5>
                                <h5><a href="{{url('profile/' . $i)}}">view profile</a></h5>
                                <h5><a href="{{url('profile/dashboard/'. $i)}}">view dashboard</a></h5>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </body>
</html>

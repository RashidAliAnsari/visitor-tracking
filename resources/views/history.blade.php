<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container">
        <table class="table table-light">
            <thead>
                <tr>
                    <th>ip</th>
                    <th>browser</th>
                    <th>device</th>
                    <th>platfome</th>
                    <th>country</th>
                    <th>session duration</th>
                    <th>date</th>
                    <th>time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitors as $visitor)
                <tr>
                    <td>{{$visitor->ip}}</td>
                    <td>{{$visitor->browser}}</td>
                    <td>{{$visitor->device}}</td>
                    <td>{{$visitor->platfom}}</td>
                    <td>{{$visitor->country}}</td>
                    <td>{{$visitor->session_in->diff($visitor->session_out)->format('%H:%I:%S')}}</td>
                    <td>{{$visitor->created_at->format('D M Y')}}</td>
                    <td>{{$visitor->created_at->format('H:i:s')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>

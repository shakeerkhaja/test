<!DOCTYPE html>
<html>
<head>
    <title> URL SHORTENER </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />--}}
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">The Test</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link underline" href="{{ url('generate-shorten-link') }}">URL Shortener</a>
            </li>
            <li class="nav-item">
                <a class="nav-link underline" href="{{ url('generate-full-url-link') }}">Get Full URL</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-3">


    <div class="container">
        <h2>URL SHORTENER</h1>
        <div class="card">
            <div class="card-header">
                <form method="POST" action="{{ route('generate.shorten.link.post') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="link" class="form-control"  required placeholder="Enter URL"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Generate Shorten Link</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                @if(session()->has('errors'))
                    <div class="alert alert-danger">
                    {{ session()->get('errors') }}
                    </div>
                @endif

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Link</th>
                        <th>Visits</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shortLinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                            <td>{{ $row->link }}</td>
                            <td>{{ $row->visits }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
               Go to <a href="{{ url('generate-full-url-link') }}">Get Full URL using Short URL Code</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>

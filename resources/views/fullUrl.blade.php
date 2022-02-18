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
            <li class="nav-item">
                <a class="nav-link underline" href="{{ url('generate-shorten-link') }}">URL Shortener</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link underline" href="#">Get Full URL</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-3">
    <div class="container">
        <h2>GET FULL URL USING SHORT URL CODE</h2>
        <div class="card">
            <div class="card-header">
                <form method="POST" action="{{ route('get.full.url.link.post') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="code" class="form-control" placeholder="Enter Code" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Get Full URL</button>
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
                <div>
                    @if(isset($url))
                        <p class="">
                            Full URL is: {{ $url->link }}

                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>

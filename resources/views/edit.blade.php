<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stephanie's</title>
    <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,700|Mukta:500,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="is-boxed has-animations">
    <div class="body-wrap boxed-container">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
                            <a href="/">
                                <svg width="48" height="32" viewBox="0 0 48 32" xmlns="http://www.w3.org/2000/svg">
                                    <title>Stephanie</title>
                                    <defs>
                                        <linearGradient x1="0%" y1="100%" y2="0%" id="logo-a">
                                            <stop stop-color="#007CFE" stop-opacity="0" offset="0%"/>
                                            <stop stop-color="#007DFF" offset="100%"/>
                                        </linearGradient>
                                        <linearGradient x1="100%" y1="50%" x2="0%" y2="50%" id="logo-b">
                                            <stop stop-color="#FF4F7A" stop-opacity="0" offset="0%"/>
                                            <stop stop-color="#FF4F7A" offset="100%"/>
                                        </linearGradient>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <rect fill="url(#logo-a)" width="32" height="32" rx="16"/>
                                        <rect fill="url(#logo-b)" x="16" width="32" height="32" rx="16"/>
                                    </g>
                                </svg>
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <main>
          <div class="container">
             @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
 @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <h1>Edit Subscriber</h1>
    <form method="POST" action="{{ route('subscribers.update', $subscriber['id']) }}">
        @csrf
         <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $subscriber['email'] }}" readonly>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $subscriber['name'] }}" required>
        </div>
        <div class="form-group">
            <label for="country">Country</label>
           <input type="text" class="form-control" id="country" name="country" value="{{ collect($subscriber['fields'])->where('key', 'country')->first()->value ?? '' }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
            
        </main>

        <footer class="site-footer text-light">
            <div class="container">
                <div class="site-footer-inner has-top-divider">
                    <div class="brand footer-brand">
                        <a href="#">
                            <svg width="48" height="32" viewBox="0 0 48 32" xmlns="http://www.w3.org/2000/svg">
                                <title>Stephanie</title>
                                <defs>
                                    <linearGradient x1="0%" y1="100%" y2="0%" id="logo-footer-a">
                                        <stop stop-color="#007CFE" stop-opacity="0" offset="0%"/>
                                        <stop stop-color="#007DFF" offset="100%"/>
                                    </linearGradient>
                                    <linearGradient x1="100%" y1="50%" x2="0%" y2="50%" id="logo-footer-b">
                                        <stop stop-color="#FF4F7A" stop-opacity="0" offset="0%"/>
                                        <stop stop-color="#FF4F7A" offset="100%"/>
                                    </linearGradient>
                                </defs>
                                <g fill="none" fill-rule="evenodd">
                                    <rect fill="url(#logo-footer-a)" width="32" height="32" rx="16"/>
                                    <rect fill="url(#logo-footer-b)" x="16" width="32" height="32" rx="16"/>
                                </g>
                            </svg>
                        </a>
                    </div>
                   
                   
                    <div class="footer-copyright">&copy; 2023 Stephanie, all rights reserved</div>
                </div>
            </div>
        </footer>
    </div>
<script src="{{ asset('js/main.min.js') }}"></script>
</body>
</html>

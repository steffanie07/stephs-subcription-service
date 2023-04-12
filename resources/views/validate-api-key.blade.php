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
      
        <h1>Validate Your MailerLite API Key</h1>

    <form action="{{ route('validate-api-key') }}" method="post">
        @csrf
        <label for="api_key">API Key:</label>
        <input type="text" name="api_key" id="api_key" required>
        <button type="submit">Validate</button>
    </form>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

</body>
</html>
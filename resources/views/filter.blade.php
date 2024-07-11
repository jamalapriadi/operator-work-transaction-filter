<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Filter Test</title>
    <link href="{{asset('assets/dist/css/tabler.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('assets/dist/css/tabler-flags.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('assets/dist/css/tabler-payments.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('assets/dist/css/tabler-vendors.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('assets/dist/css/demo.min.css?1692870487')}}" rel="stylesheet"/>

    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="page">
        <header class="navbar navbar-expand-md d-print-none" >
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{URL::to('/')}}">
                        Laravel Test
                    </a>
                </h1>
            </div>
        </header>

        <div class="page-wrapper">
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl" id="app">

                    Source Code : https://github.com/jamalapriadi/operator-work-transaction-filter
                    
                    <app-component></app-component>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/dist/js/tabler.min.js?1692870487')}}" defer></script>
    <script src="{{asset('assets/dist/js/demo.min.js?1692870487')}}" defer></script>
</body>
</html>
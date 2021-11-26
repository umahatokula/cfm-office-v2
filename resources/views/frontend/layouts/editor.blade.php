
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    @include('frontend.imports.sommerstyles')

    <!-- Title -->
    <title>CFM OFFICE 2.0.0</title>

</head>
<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        {{-- sidebar start --}}
        @include('frontend.partials.sidebar')
        {{-- sidebar end --}}

        <div class="app-container">
            {{-- searchbar start --}}
            @include('frontend.partials.searchbar')
            {{-- searchbar end --}}

            {{-- header start --}}
            @include('frontend.partials.header')
            {{-- header end --}}

            {{-- page content start --}}
            @yield('content')
            {{-- page content end --}}
        </div>
    </div>

    @include('frontend.imports.sommernote')
    @yield('javascript')
</body>
</html>
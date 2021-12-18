
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

    @include('imports.stylesheets')

    <!-- Title -->
    <title>CFM OFFICE 2.0.0</title>

    @livewireStyles

</head>
<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        {{-- sidebar start --}}
        @include('partials.sidebar')
        {{-- sidebar end --}}

        <div class="app-container">
            {{-- searchbar start --}}
            @include('partials.searchbar')
            {{-- searchbar end --}}

            {{-- header start --}}
            @include('partials.header')
            {{-- header end --}}

            {{-- page content start --}}
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container-fluid">

                        @yield('content')
                        
                    </div>
                </div>
            </div>
            {{-- page content end --}}
        </div>
    </div>

    @include('imports.javascripts')


    @livewireScripts
    @yield('javascript')

    
    <script>
        $(document).ready(function () {

            $('body').on('click', '[data-toggle="modal"]', function () {
                url = $(this).data("remote")
                console.log(url)
                $($(this).data("bs-target") + ' .modal-body').load(url);
            });

            $('#confirmationModal').on('show.bs.modal', function (e) {
                $(this).find('.confirm').attr('href', $(e.relatedTarget).data('href'));
            });

        });
    </script>
</body>
</html>




<div class="modal fade" id="modal-center" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">&nbsp;</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                loading...
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal-large" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="exampleModalLgLabel">&nbsp;</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                loading...
            </div>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>URL SHORTNER</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- datatables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    {{-- toastr --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />





    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>

</head>

<body>
    <div class="container-xl" style="margin-top: 2%">
        <h1>URL SHORTNER</h1>
    </div>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <div class="container-xl py-5">
        <form id="saveUrl" method="post" action="javascript:void(0)">
            {{ csrf_field() }}
            <div class="row g-5">
                <div class="col-md-6">
                    <label for="url" class="form-label">ENETR URL HERE</label>
                    <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}"
                        placeholder="Enter URL here">
                    <span class="text-danger">{{ $errors->first('url') }}</span>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-info" id="save_event" style="margin-top: 2rem;">Save</button>
                </div>

            </div>
        </form>
    </div>
    <div class="container-sm">
        <div class="container">
            <div class="row g-5">
                <table id="url_shortner" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Short link</th>
                            <th>Original Links</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- Template Javascript -->

    {{-- toastr js --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    {{-- template js --}}
    <script src="{{ asset('js/main.js') }}"></script>

    {{-- server side datatable listig using ajax --}}
    <script src="{{ asset('js/links.js') }}"></script>



    <script>
        // server side success message toaster
        $(document).ready(function() {
            toastr.options.timeOut = 3000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });
    </script>
</body>

</html>

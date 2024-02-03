<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKARI</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
</head>

{{-- <body class="bg-contain" style="background-image: url('{{asset('asset/qr/back-1.jpg')}}');"> --}}

<body>

    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        @include('layouts.navbar')
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        @include('layouts.sidebar')
    </aside>

    <div class="p-4 sm:ml-64 ">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            @yield('content')
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>


    <script>
        $(document).ready(function() {
            // Periksa apakah token tersimpan di localStorage saat halaman dimuat
            const token = localStorage.getItem('token');
            if (!token) {
                // Jika tidak ada token, arahkan pengguna ke halaman login
                window.location.href = '/login';
            }

            $('.logout').click(function(event) {
                event.preventDefault();

                $.ajax({
                    url: 'http://localhost:8004/api/logout',
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    },
                    success: function(response) {
                        // Hapus token dari localStorage
                        localStorage.removeItem('token');
                        // Redirect ke halaman login atau halaman lain yang Anda inginkan
                        window.location.href = "{{ route('login') }}";
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Failed to logout');
                    }
                });
            });
        });
    </script>
</body>

</html>

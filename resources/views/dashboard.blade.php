@extends('layouts.index')
@section('content')
<div class="container">
    <div class="text-lg font-bold ">
        Dashboard
    <div>
    <div class="grid grid-cols-2 gap-4 mb-4 mt-4">
        <div class="flex flex-col items-center justify-center rounded bg-blue-500 h-28 dark:bg-gray-800">
            <div class="text-white text-4xl" id="user">0</div>
            <div class="text-white font-semibold">Pengguna Daftar</div>
        </div>
        <div class="flex flex-col items-center justify-center rounded bg-blue-500 h-28 dark:bg-gray-800">
            <div class="text-white text-4xl" id="user_active">0</div>
            <div class="text-white font-semibold">Pengguna Aktif</div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
            const url = "http://127.0.0.1:8004/api/dashboard"
            $.ajax({
                url,
                type: 'GET',
                success: function(response) {
                    $('#user').text(response.data.user)
                    $('#user_active').text(response.data.user)
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
</script>
@endsection
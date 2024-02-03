@extends('layouts.index')
@section('content')
    <div class="container h-fit">
        <div class="text-lg font-bold">Master Pengguna</div>

        <div class="flex my-2">
            <a href="{{ route('tambah') }}" role="button"
                class="bg-blue-500 rounded-lg px-4 py-2 font-semibold text-white hover:bg-blue-700">Tambah Pengguna +</a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="datatable">
                <thead class="text-xs text-white uppercase bg-blue-500 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3" width="5%">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3" width="40%">
                            Nama Pengguna
                        </th>
                        <th scope="col" class="px-6 py-3" width="40%">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="body">

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const url = "http://127.0.0.1:8004/api/list-data"
            let edit = "{{route('edit', ':user_id')}}"
            $.ajax({
                url,
                type: 'GET',
                success: function(response) {
                    let data = response.data
                    let tr = ""
                    let number = 1
                    data.forEach(element => {
                        tr += `<tr class="bg-white  dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            ${number++}
                        </td>
                        <td class="px-6 py-4">
                            ${element.user_fullname}
                        </td>
                        <td class="px-6 py-4">
                            ${element.user_email}
                        </td>
                        <td class="flex px-6 py-4 gap-2 flex justify-center">
                            <a href="${edit.replace(':user_id', element.user_id)}" class="rounded-lg px-2 py-1 font-medium text-white dark:text-blue-500 bg-yellow-300 hover:underline">Edit</a>
                            <button class="rounded-lg px-2 py-1 font-medium text-white dark:text-blue-500 bg-red-500 hover:underline delete"  data-id=${element.user_id}>Hapus</button>
                        </td>
                    </tr>`
                    });
                    $('.body').html(tr)

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
            $('#dataTable').DataTable();


        });

        $(document).on('click', '.delete', function() {
            let id = $(this).data('id');
            let row = $(this).closest('tr'); 
            $.ajax({
                url: 'http://127.0.0.1:8004/api/api-delete/' + id,
                type: 'DELETE',
                success: function(response) {
                    alert('Data berhasil dihapus');
                    row.remove(); 
                     // Reset nomor urut
                    let index = 1;
                    $('.body tr').each(function() {
                        $(this).find('td:first').text(index++);
                    });
                },
                error: function(xhr, status, error) {
                    alert(error);
                }
            });
        });
    </script>
@endsection

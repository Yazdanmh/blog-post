@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Roles</h1>
                <a href="{{ route('role.create') }}" class="btn btn-success float-right">Create Role</a>
                <br>


            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $index => $role)
                            <tr>
                                <td>{{ $roles->currentPage() * 10 - 10 + $index + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('role.edit', ['role' => $role->id]) }}">Edit</a>
                                    |
                                    <a href="#" class="delete" id="{{ $role->id }}">Delete</a>
                                    |
                                    <a href="{{ route('role.show', ['role' => $role->id]) }}">Permissions</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <tfoot>
                    {{ $roles->links() }}
                </tfoot>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.delete').click(function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).attr('id');
                    var url = 'post/' + id;
                    $.ajax({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: "DELETE",
                        datatype: 'json',
                        data: {
                            "_method": "DELETE",
                        },
                        success: function(data) {
                            location.reload();
                        }
                    })

                    Swal.fire({
                        title: "Deleted!",
                        text: "Post has been deleted.",
                        icon: "success"
                    });
                }
            });
        })
    </script>
@endsection

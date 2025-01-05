@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Users</h1>
                <a href="{{ route('users.create') }}" class="btn btn-success float-right">Create User</a>
                <br>
                <br>
                <a href="{{ route('post.trash') }}" class="btn btn-primary float-right">Trash</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Profile Pic</th>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>
                                    <img src="{{ $user->profile->profile_pic }}" alt=""
                                        style="width:30px;height:30px;border-radius:50%;">
                                </td>

                                <td>{{ $users->currentPage() * 10 - 10 + $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="{{ route('post.edit', ['post' => $user->id]) }}">Edit</a> |
                                    <a href="#" class="delete" id="{{ $user->id }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <tfoot>
                    {{ $users->links() }}
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

@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Posts</h1>
                <a href="{{ route('post.create') }}" class="btn btn-success float-right">Create Post</a>
                <br>
                <br>
                @can('forceDelete', App\Models\Post::class)
                    <a href="{{ route('post.trash') }}" class="btn btn-primary float-right">Trash</a>
                @endcan

            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Sub Title</th>
                            <th>Author</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $index => $post)
                            <tr>
                                <td>{{ $posts->currentPage() * 10 - 10 + $index + 1 }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->sub_title }}</td>
                                <td>{{ $post->profile->user->name }}</td>
                                <td>
                                    <a href="{{ route('post.edit', ['post' => $post->id]) }}">Edit</a>
                                    @can('delete', $post)
                                        |
                                        <a href="#" class="delete" id="{{ $post->id }}">Delete</a>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <tfoot>
                    {{ $posts->links() }}
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

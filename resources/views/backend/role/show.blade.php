@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Set Permissions</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('role.update', ['role' => $role_id]) }}" method="POST">
                    @csrf
                    @method('PUT');
                    <div class="row">
                        @foreach ($permissions as $persmission)
                            <div class="col-md-3">
                                {{ $persmission->name }}
                                <input type="checkbox" class="checkbox" value="{{ $persmission->id }}" name="permission[]">
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

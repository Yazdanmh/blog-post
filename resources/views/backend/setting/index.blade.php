@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Setting</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('setting.store', ['id' => $setting->id]) }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="logo"
                            value="{{ $setting->logo }}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Enter site email" class="form-control"
                                value="{{ $setting->email }}">
                            @error('email')
                                <p class="text-denger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" placeholder="Enter site phone" class="form-control"
                                value="{{ $setting->phone }}">
                            @error('phone')
                                <p class="text-denger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="address">Address</label>
                            <input type="text" name="address" placeholder="Enter site address" class="form-control"
                                value="{{ $setting->address }}">
                            @error('address')
                                <p class="text-denger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="facebook">Facebook</label>
                            <input type="url" name="facebook" placeholder="Enter site facebook" class="form-control"
                                value="{{ $setting->facebook }}">
                            @error('facebook')
                                <p class="text-denger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="twitter">Twitter</label>
                            <input type="url" name="twitter" placeholder="Enter site twitter" class="form-control"
                                value="{{ $setting->twitter }}">
                            @error('twitter')
                                <p class="text-denger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endsection

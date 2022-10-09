@extends('layout')

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-body">
                @if ($message = Session::get('success'))
                    {
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div> }
                @endif
                <form action="{{ route('users-avatar-create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="inputImage">Image:</label>
                        <input type="file" name="avatar" id="inputImage"
                            class="form-control @error('avatar') is-invalid @enderror">
                        @error('avatar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

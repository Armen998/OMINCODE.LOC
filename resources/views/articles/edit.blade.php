@extends('layout')

@section('content')
    @include('repeatitions.create-edit', ['articles' => $articles])
@endsection

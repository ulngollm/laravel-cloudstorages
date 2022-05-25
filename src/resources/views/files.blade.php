@extends('layout.layout')
@section('content')
    <div class="files">
        @foreach($files as $file)
            <x-file :file="$file"></x-file>
        @endforeach
    </div>
@endsection

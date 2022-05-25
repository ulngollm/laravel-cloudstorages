@extends('layout.layout')
@section('content')
    <div class="files">
        @foreach($files as $file)
            <x-cloud-file :file="$file"></x-cloud-file>
        @endforeach
    </div>
@endsection

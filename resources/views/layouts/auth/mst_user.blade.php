@extends('layouts.mst')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/card.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui/jquery-ui.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <style>
        blockquote {
            background: unset;
            border-color: unset;
            color: unset;
        }

        .has-feedback .form-control-feedback {
            width: 36px;
            height: 36px;
            line-height: 36px;
        }

        .image-upload > input {
            display: none;
        }

        .image-upload label {
            cursor: pointer;
            width: 100%;
        }
    </style>
@endpush
@section('content')
    <section class="none-margin" style="padding: 40px 0 40px 0">
        <div class="container">
            @yield('inner-content')
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('vendor/smooth-scrollbar/smooth-scrollbar.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
@endpush

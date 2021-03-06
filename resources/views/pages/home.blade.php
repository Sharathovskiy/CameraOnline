@extends('layouts.app')

@section('links')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')

    @if(isset($isUploaded) && $isUploaded == true)
        <div id="success-alert" class="alert alert-success">
            <strong>Success!</strong> Your photo has been uploaded!
        </div>
    @endif

    <div id="before-picture">

        <div class="row text-center">
            <h1>Take a picture of yourself!</h1>
        </div>

        <div id="image-wrapper" class="row">
            <video id="video" width="60%" height="60%" autoplay></video>
        </div>

        <div class="row text-center" style="margin-top: 10px">
            <button id="snap" onclick="snap();" class="btn btn-success">Take photo!</button>
        </div>

    </div>

    <div id="after-picture" class="row text-center">

        <div>
            <h1>Your beautiful picture!</h1>
        </div>

        <div id="canvas-wrapper" class="row">
            <canvas id="canvas" width="400" height="300"></canvas>
        </div>

        <div class="row">

            <form method="POST" action="{{route('uploadPhoto')}}" style="display:inline-block">
                {{ csrf_field() }}
                <input name="hidden_data" id="hidden_data" type="hidden">
                @if(Auth::check())
                    <input type="submit" class="btn btn-success" value="Send photo!"></input>
                @endif
            </form>

            <a href="#" id="download" class="btn btn-primary" download="My beautiful photo">Download</a>
            <button id="cancel" class="btn btn-danger">I don't like it!</button>
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        $("#success-alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });
    </script>
    <script src="{{asset("js/webcam.js")}}"></script>
    <script src="{{asset("js/photoTaker.js")}}"></script>
@endsection
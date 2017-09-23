@extends('layouts.app')

@section('links')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')

<div id="before-picture">

    <div class="row text-center">
        <h1>Take a picture of yourself!</h1>
    </div>

    <div id="image-wrapper" class="row">
        <video id="video" width="60%" height="60%" autoplay></video>
    </div>

    <form name="dataURLContainer">
    {{ csrf_field() }}
        <input name="hidden_data" id="hidden_data" type="hidden">
    </form>
    
    <div class="row text-center">
        <button onclick="snap();" class="btn btn-success">Take photo!</button>
        <a href="{{route('showPhotos')}}" class="btn btn-primary">Show photos from DB</a>
    </div>
    
</div>

<div id="after-picture">
    
    <div class="row text-center">
        <h1>Your beautiful picture!</h1>
    </div>

    <div id="canvas-wrapper" class="row">
        <canvas id="canvas" width="800" height="600"></canvas>
    </div>

    <div class="row text-center">
        <button id="send" class="btn btn-success">Send photo!</button>
        <button id="cancel" class="btn btn-danger">Nope nope nope!</button>
    </div>
    
</div>

@endsection

@section('scripts')
<script src="{{asset("js/webcam.js")}}"></script>
<script src="{{asset("js/photoTaker.js")}}"></script>
<script>
    var uploadPhotoRoute = "{{route('uploadPhoto')}}";
</script>
@endsection
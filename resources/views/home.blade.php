@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row ">
        <h1>Take a picture of yourself!</h1>
        <video id="video" width="400" height="300" autoplay></video>
        <canvas id="canvas" width="400" height="300"></canvas>
    </div>

        <form name="dataURLContainer">
            {{ csrf_field() }}
            <input name="hidden_data" id="hidden_data" type="hidden">
        </form>

    <button onclick="snap(); sendPhoto();" class="btn btn-success">Take photo!</button>
    <a href="{{route('showPhotos')}}" class="btn btn-primary">Show photos from DB</a>
</div>
@endsection

@section('scripts')
<script src="{{asset("js/webcam.js")}}"></script>
<script src="{{asset("js/photoTaker.js")}}"></script>
<script>
    var uploadPhotoRoute = "{{route('uploadPhoto')}}";
</script>
@endsection
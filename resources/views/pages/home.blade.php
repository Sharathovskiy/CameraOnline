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
    
    <div class="row text-center" style="margin-top: 10px">
        <button id="snap" onclick="snap();" class="btn btn-success">Take photo!</button>
        <a href="{{route('showPhotos')}}" class="btn btn-primary">Show photos from DB</a>
    </div>
    
</div>

<div id="after-picture" class="row text-center">
    
    <div >
        <h1>Your beautiful picture!</h1>
    </div>

    <div id="canvas-wrapper" class="row">
        <canvas id="canvas" width="800" height="600"></canvas>
    </div>
    
    <div class="row">
       
        <form method="POST" action="{{route('uploadPhoto')}}" style="display:inline-block">
        {{ csrf_field() }}
            <input name="hidden_data" id="hidden_data" type="hidden">
            <input type="submit" class="btn btn-success" value="Send photo!"></input>
        </form>
        
        <button id="cancel" class="btn btn-danger">Nope nope nope!</button>
    </div>
    
</div>

@endsection

@section('scripts')
<script src="{{asset("js/webcam.js")}}"></script>
<script src="{{asset("js/photoTaker.js")}}"></script>
@endsection
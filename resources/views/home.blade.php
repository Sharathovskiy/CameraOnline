@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row ">
        <h1>Take a picture of yourself!</h1>
        <video id="video" width="400" height="300" autoplay></video>
        <canvas id="canvas" width="400" height="300"></canvas>
    </div>
    
    <div class="row">
        <button id="snap" onClick="snap()">Snap photo</button>
    </div>
    
    <div class="row">
        <table>
            <tr id='photos'>
            </tr>
        </table>
    </div>
    
</div>
@endsection

@section('scripts')
<script src="{{asset("js/webcam.js")}}"></script>
<script src="{{asset("js/photoTaker.js")}}"></script>
@endsection
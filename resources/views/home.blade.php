@extends('layouts.app')

@section('content')
<div class="container text-center">

    <div class="row ">
        <h1>Take a picture of yourself!</h1>
    </div>
    
    <div id="camera_info" class="row">
        <div id="camera"></div> <br>
        <button id="take_snapshots" class="btn btn-success btn-sm">Take Snapshots</button>
    </div>
    
    <div class="row">
        <form>
            <input tpye="button" value="Take picture!" class="btn btn-success btn-sm" onClick="take_snapshot()">
        </form>
    </div>
    
    
</div>
@endsection

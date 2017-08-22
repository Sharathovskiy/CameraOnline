@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row ">
        <h1>Take a picture of yourself!</h1>
        <video id="video" width="400" height="300" autoplay></video>
        <canvas id="canvas" width="400" height="300"></canvas>
    </div>

        <form method="post" action='{{route('photoTaken')}}' name="form1" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="hidden_data" id="hidden_data" type="hidden">
        </form>

    <button onclick="snap(); sendPhoto();">Take photo!</button>

    <!--    <div class="row">
            <table>
                <tr id='photos'></tr>
            </table>
        </div>-->

</div>
@endsection

@section('scripts')
<script src="{{asset("js/webcam.js")}}"></script>
<script src="{{asset("js/photoTaker.js")}}"></script>
<script>
    var photoTakenRoute = "{{route('photoTaken')}}";
</script>
@endsection
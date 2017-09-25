@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h3>Photo id: <?= $photo->id ?></h3>
    <img src="data:image/png;base64, <?= $photo->image ?>"/>
    <p>Created: <?= $photo->created_at?></p>
</div>
@endsection
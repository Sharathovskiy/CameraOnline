@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row text-center">
        <h1>Your beautiful photos:</h1>
        <table>
            @for($i = 0; $i < $paginationHelper->getTotalPages(); $i++)
            <tr style="margin-bottom: 100px; text-align: center;">
                @foreach($paginationHelper->getNextPage() as $photo)
                <td style="border-bottom: 1px solid #ddd; padding: 10px">
                    <?php $imageSrc = 'data:image/png;base64,' . $photo->image?>
                    <h4>{{$photo->id}}</h4>
                    <a href="{{route('showPhoto', $photo->id)}}" target="new">
                        <image width="200" height="150" src="<?= $imageSrc ?>" />
                    </a>
                   <a href="<?= $imageSrc ?>" class="btn btn-primary" download="<?= $photo->name ?>" style="margin-top: 10px">Download</a>
                </td>
                @endforeach
            </tr>
            @endfor
        </table>
    </div>
    
</div>
@endsection
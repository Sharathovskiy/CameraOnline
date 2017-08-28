@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row ">
        <h1>Your beautiful photos:</h1>
        <table>
            @for($i = 0; $i < $paginationHelper->getTotalPages(); $i++)
            <tr>
                @foreach($paginationHelper->getNextPage() as $photo)
                <td>
                   <image width="200" height="150" src="data:image/png;base64,{{ $photo->image }}" />
                </td>
                @endforeach
            </tr>
            @endfor
        </table>
    </div>
    
</div>
@endsection
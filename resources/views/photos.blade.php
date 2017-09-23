@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row ">
        <h1>Your beautiful photos:</h1>
        <table>
            @for($i = 0; $i < $paginationHelper->getTotalPages(); $i++)
            <tr style="margin-bottom: 100px; text-align: center;">
                @foreach($paginationHelper->getNextPage() as $photo)
                <td style="border-bottom: 1px solid #ddd; padding: 10px">
                   <image width="200" height="150" src="data:image/png;base64,{{ $photo->image }}" />
                   <a href="data:image/png;base64,{{ $photo->image }}" class="btn btn-primary" download style="margin-top: 10px">Download</a>
                </td>
                @endforeach
            </tr>
            @endfor
        </table>
    </div>
    
</div>
@endsection
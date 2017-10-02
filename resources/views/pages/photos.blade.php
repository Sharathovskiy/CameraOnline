@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row text-center">
            <h1>Your beautiful photos:</h1>
            <table>
                @foreach($paginator->getNextPage() as $row)
                    <tr style="margin-bottom: 100px; text-align: center;">
                        @foreach($row as $photo)
                            <td style="border-bottom: 1px solid #ddd; padding: 10px">
                                <?php $imageSrc = 'data:image/png;base64,' . $photo->image?>
                                <h4>{{$photo->id}}</h4>
                                <a href="{{route('showPhoto', $photo->id)}}" target="new">
                                    <image width="200" height="150" src="<?= $imageSrc ?>"/>
                                </a>
                                <div style="margin-top: 10px">
                                    <a href="<?= $imageSrc ?>" class="btn btn-primary" download="<?= $photo->name ?>">Download</a>
                                    <form method="POST" action="{{route('deletePhoto', ['photoId' => $photo->id])}}"
                                          style="display:inline-block">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn btn-danger remove-btn" value="X"></input>
                                        <input name="_method" type="hidden" value="DELETE">
                                    </form>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
            <ul class="pagination">
                @for($i = 0; $i < $paginator->getTotalPages(); $i++)
                    <li class="<?= $page == $i + 1 ? 'active' : ''?>">
                        <a href="?page=<?= $i + 1 ?>"><?= $i + 1 ?></a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
@endsection
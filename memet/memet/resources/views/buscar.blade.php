@extends('plantilla')

@section('content')
    <script>
        $(document).ready(function () {
            $('#memes').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>

    <div class="pt-5 container">
        <div class="row">
            <div class="col">
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-memes" role="tabpanel" aria-labelledby="nav-new-tab">
                        <table id="memes" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                            <colgroup>
                                <col span="1" style="width: 10%;">
                                <col span="1" style="width: auto;">
                            </colgroup>
                            <thead>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($memes as $meme)
                                    <tr>
                                        <td>
                                            <a href="{{url('mostrarMeme/'.$meme->idMeme)}}">
                                                <img src="{{url('storage/memes/'.$meme->rutaMeme)}}" class="img-thumbnail" width="100" height="100">
                                            </a>
                                        </td>
                                        <td><a href="{{url('mostrarMeme/'.$meme->idMeme)}}" style="color:black">{{$meme->tituloMeme}}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

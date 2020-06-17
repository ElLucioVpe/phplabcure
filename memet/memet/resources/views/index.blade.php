@extends('plantilla')

@section('content')
    <script>
        $(document).ready(function () {
            $('#memes-new').DataTable();
            $('#memes-hot').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>


    <!-- El yield aca cambia el content -->
    <div class="pt-5 container">
        <div class="row">
            <div class="col">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-new-tab" data-toggle="tab" href="#nav-new" role="tab" aria-controls="nav-new" aria-selected="true">NEW</a>
                        <a class="nav-item nav-link" id="nav-hot-tab" data-toggle="tab" href="#nav-hot" role="tab" aria-controls="nav-hot" aria-selected="false">HOT</a>
                        <a class="nav-item nav-link" id="nav-rec-tab" data-toggle="tab" href="#nav-rec" role="tab" aria-controls="nav-rec" aria-selected="false">RECOMENDADOS</a>
                    </div>
                </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">
                            <table id="memes-new" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                <colgroup>
                                    <col span="1" style="width: 10%;">
                                    <col span="1" style="width: auto;">
                                </colgroup>
                                <thead>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($memesNEW as $meme)
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
                        <div class="tab-pane fade" id="nav-hot" role="tabpanel" aria-labelledby="nav-hot-tab">
                            <table id="memes-hot" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                <colgroup>
                                    <col span="1" style="width: 10%;">
                                    <col span="1" style="width: auto;">
                                </colgroup>
                                <thead>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($memesHOT as $meme)
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
                        <div class="tab-pane fade" id="nav-rec" role="tabpanel" aria-labelledby="nav-rec-tab">
                            <table id="memes-rec" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                <colgroup>
                                    <col span="1" style="width: 10%;">
                                    <col span="1" style="width: auto;">
                                </colgroup>
                                <thead>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($memesREC as $meme)
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
        </div>
    </div>

@endsection

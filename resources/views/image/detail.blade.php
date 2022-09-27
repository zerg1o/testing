@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('includes.message')

                <div class="card pub-image pub-image-detail">
                    <div class="card-header">


                        <div class="container-avatar">
                            @if ($image->user->image)
                                <img class="avatar" src="{{ route('user.avatar', ['filename' => $image->user->image]) }}"
                                    alt="" />
                            @endif
                        </div>
                        <div class="data-user">
                            <a href="{{ route('profile', ['id' => $image->user->id]) }}">
                                {{ $image->user->name . ' ' . $image->user->surname }}
                                <span class="nickname">{{ ' @' . $image->user->nick }}</span>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
                        </div>

                        <div class="description">
                            <span class="nickname">{{ '@' . $image->user->nick }}</span>
                            <p>{{ $image->description }}</p>
                        </div>
                        <div class="likes">
                            <?php $user_like = false; ?>
                            @foreach ($image->likes as $like)
                                @if ($like->user->id == Auth::user()->id)
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach

                            @if ($user_like)
                                <img src="{{ asset('img/hearts-red.png') }}" data-id="{{ $image->id }}" alt=""
                                    class="btn-dislike">
                            @else
                                <img src="{{ asset('img/hearts-black.png') }}" data-id="{{ $image->id }}" alt=""
                                    class="btn-like">
                            @endif
                            <span class="number-likes">{{ count($image->likes) }}</span>
                        </div>
                        @if ($image->user->id == Auth::user()->id)
                            <div class="actions">
                                <a href="{{ route('image.edit',['id'=>$image->id]) }}" class="btn btn-primary">Actualizar</a>
                                {{--<a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Eliminar</a>--}}
                                {{-- modal para eliminar imagen --}}
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Eliminar
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar imagen</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                La imagen se borrará definitivamente, ¿estás seguro de eliminarla?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Confirmar</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="clearfix"></div>
                        &nbsp;
                        <div class="comments">
                            <h2>Comentarios ( {{ count($image->comments) }} )</h2>
                            <hr>
                        </div>
                        <div class="pub-comments">
                            @foreach ($image->comments as $comment)
                                <span class="nickname"><strong>{{ $comment->user->nick }}</strong></span>
                                <span class="nickname date">{{ \FormatTime::LongTimeFilter($comment->created_at) }}</span>
                                <p>{{ $comment->content }}
                                    {{-- boton eliminar comentario --}}
                                    @if ((Auth::check() && $comment->user_id == Auth::user()->id) || $comment->image->user_id == Auth::user()->id)
                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}"
                                            class="btn btn-sm btn-danger">Eliminar</a>
                                    @endif
                                </p>
                            @endforeach
                        </div>
                        <div class="comments">
                            <form action="{{ route('comment.save') }}" method="post">
                                @csrf
                                <input name="image_id" type="hidden" value="{{ $image->id }}" />
                                <p>
                                    <textarea class="form-control content" name="content" id="" placeholder="Escribe un comentario..." required></textarea>
                                    <button type="submit" class="btn btn-success">Publicar</button>
                                <div class="clearfix"></div>
                                @if ($errors->has('content'))
                                    <span role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                                </p>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

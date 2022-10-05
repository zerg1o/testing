<div class="card pub-image">
    <div class="card-header">


        <div class="container-avatar">
            @if ($post->user->image)
                <img class="avatar" src="{{ route('user.avatar', ['filename' => $post->user->image]) }}" alt="" />
            @endif
        </div>
        <div class="data-user">
            <a href="{{ route('profile', ['id' => $post->user->id]) }}">
                {{ $post->user->name . ' ' . $post->user->surname }}

                <span class="nickname">{{ ' @' . $post->user->nick }}</span>
            </a>

        </div>
    </div>

    <div class="card-body">
        <div class="image-container">
            <a href="{{ route('image.detail', ['id' => $post->id]) }}">

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    {{-- <ol class="carousel-indicators">
                        @for ($i = 0; $i < count($post->images); $i++)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"
                                class="active"></li>
                        @endfor


                    </ol> --}}

                    <div class="carousel-inner">
                        @foreach ($post->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img class="d-block w-100"
                                    src="{{ route('image.file', ['filename' => $image->image_path]) }}"
                                    alt="First slide">
                            </div>
                        @endforeach
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </a>

        </div>

        <div class="description">
            <span class="nickname">{{ '@' . $post->user->nick }}</span>

            <p>{{ $post->description }}</p>
        </div>
        <div class="likes">
            <?php $user_like = false; ?>
            @foreach ($post->likes as $like)
                @if ($like->user->id == Auth::user()->id)
                    <?php $user_like = true; ?>
                @endif
            @endforeach

            @if ($user_like)
                <img src="{{ asset('img/hearts-red.png') }}" data-id="{{ $post->id }}" alt=""
                    class="btn-dislike">
            @else
                <img src="{{ asset('img/hearts-black.png') }}" data-id="{{ $post->id }}" alt=""
                    class="btn-like">
            @endif
            <span class="number-likes">{{ count($post->likes) }}</span>
        </div>
        <div class="comments">
            <a href="" class="btn btn-sm btn-warning btn-comments">Comentarios ( {{ count($post->comments) }}
                )</a>
        </div>
        <div class="time">
            <span class="date">{{ \FormatTime::LongTimeFilter($post->created_at) }}</span>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

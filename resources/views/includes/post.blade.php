<div class="card pub-image">
    <div class="card-header">


        <div class="container-avatar">
            @if ($post->user->image)
                <img class="avatar" src="{{ route('user.avatar', ['filename' => $post->user->image]) }}" alt="" />
            @endif
        </div>
        <div class="data-user">
            <a href="{{ route('profile',['id'=>$post->user->id]) }}">
            {{ $post->user->name . ' ' . $post->user->surname }}

            <span class="nickname">{{ ' @' . $post->user->nick }}</span>
            </a>
            
        </div>
    </div>

    <div class="card-body">
        <div class="image-container">
            <a href="{{ route('image.detail', ['id' => $post->id]) }}">
                @foreach ( $post->images as $image )
                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
                @endforeach

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

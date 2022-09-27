<div class="card pub-image">
    <div class="card-header">


        <div class="container-avatar">
            @if ($image->user->image)
                <img class="avatar" src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" alt="" />
            @endif
        </div>
        <div class="data-user">
            <a href="{{ route('profile',['id'=>$image->user->id]) }}">
            {{ $image->user->name . ' ' . $image->user->surname }}

            <span class="nickname">{{ ' @' . $image->user->nick }}</span>
            </a>

        </div>
    </div>

    <div class="card-body">
        <div class="image-container">
            <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
            </a>

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
        <div class="comments">
            <a href="" class="btn btn-sm btn-warning btn-comments">Comentarios ( {{ count($image->comments) }}
                )</a>
        </div>
        <div class="time">
            <span class="date">{{ \FormatTime::LongTimeFilter($image->created_at) }}</span>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

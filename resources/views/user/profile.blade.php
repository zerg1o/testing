@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="user-data">
                    {{-- avatar --}}
                    @if ($user->image)
                        <div class="container-avatar">

                            <img class="avatar" src="{{ route('user.avatar', ['filename' => $user->image]) }}" alt="" />

                        </div>
                    @endif
                </div>
                <div class="user-info">
                    <h1>{{ '@'.$user->nick }}</h1>
                    <h2>{{ $user->name.' '.$user->surname }}</h2>

                </div>

                <div class="clearfix"></div>
                <hr>
                @foreach ($user->images as $image)
                    @include('includes.image',['image'=>$image])
                @endforeach

                {{-- Paginacion
                <div class="clearfix"></div>
                {{ $user->images->links() }}
                --}}
            </div>
        </div>
    </div>
@endsection

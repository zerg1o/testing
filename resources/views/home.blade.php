@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @include('includes.message')

                @foreach ($posts as $post)
                    @include('includes.carrusel',['post'=>$post])
                @endforeach

                {{-- Paginacion --}}
                <div class="clearfix"></div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection

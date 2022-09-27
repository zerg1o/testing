@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @include('includes.message')

                @foreach ($images as $image)
                    @include('includes.image',['image'=>$image])
                @endforeach

                {{-- Paginacion --}}
                <div class="clearfix"></div>
                {{ $images->links() }}
            </div>
        </div>
    </div>
@endsection

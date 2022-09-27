@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1>Usuarios</h1>
                <form action="{{ route('user.index') }}" method="GET" id="buscar">

                    <div class="row">
                        <div class="form-group col">
                            <input class="form-control" type="text" id="user" />
                        </div>
                        <div class="form-group col">
                            <input class="btn btn-primary" type="submit" value="Buscar" />
                        </div>
                    </div>

                </form>
                <hr>
                @foreach ($users as $user)
                    <div class="user-data">
                        {{-- avatar --}}
                        @if ($user->image)
                            <div class="container-avatar">

                                <img class="avatar" src="{{ route('user.avatar', ['filename' => $user->image]) }}"
                                    alt="" />

                            </div>
                        @endif
                    </div>
                    <div class="user-info">
                        <h1>{{ '@' . $user->nick }}</h1>
                        <h2>{{ $user->name . ' ' . $user->surname }}</h2>
                        <a href="{{ route('profile', ['id' => $user->id]) }}" class="btn btn-success">Ver Perfil</a>
                    </div>

                    <div class="clearfix"></div>
                    <hr>
                @endforeach

                {{-- Paginacion --}}
                <div class="clearfix"></div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

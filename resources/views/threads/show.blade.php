@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel=default">
                    <div class="panel-heading">
                        <a href="#">
                            {{ $thread->creator->name }}
                        </a> Posted:
                        {{ $thread->title }}
                    </div>

                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach ( $thread->replies as $reply )
                    @include('threads.reply')
                @endforeach
            </div>
        </div>


        @if (auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form action="{{ $thread->path() . '/replies' }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea id="thread_body" name="body" class="form-control" placeholder="Have something to say?"></textarea>
                        </div>
                        <button class="btn btn-default" type="submit">Post</button>
                    </form>
                </div>
            </div>
        @else
            <p>Please <a href="{{route('login')}}">sign in</a> to participate in this discussion.</p>
        @endif
    </div>
@endsection

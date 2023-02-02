@extends('layouts.app')

@section('title', $post->name )
@section('description', $post->preview_text )
@section('author', 'Eugeny Nosenko')

@section('content')

    <!-- Post Content Column -->
    <div class="col-lg-8">
        <!-- Title -->
        <br>
        <h1 class="mt-4">{{ $post->name }}</h1>
        <!-- Author -->
        <p>
            {{trans('posts.author')}}:
            <a href="https://toprogram.ru" target="_blank">Eugeny Nosenko</a>
            <br>
            {{trans('posts.posted_at')}}:
            {{ $post->created_at }} &nbsp; <span class="fa fa-eye"></span> {{ $post->views }}
        </p>
        <hr>
        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{ $post->image_url }}" alt="{{ $post->name }}">
        <hr>
        <!-- Post Content -->
        <span v-pre>
            {!! $post->detail_text !!}
        </span>
        <hr>
        <emoji-reaction
            :default-statistics="{{ getEmojiReactionStatistics($post) }}"
            :post-id="{{ $post->id }}"
            :emojis="{{ $emojis }}"></emoji-reaction>

        @if(Session::has('message'))
            <p class="alert alert-primary">{{ Session::get('message') }}</p>
        @endif
        <!-- Comments Form -->
        <div class="card my-4">
            <h5 class="card-header">{{ trans('posts.comments.title') }}:</h5>
            <div class="card-body">
                <form method="post" action="{{route('site.comments.store', ['slug'=> $post->slug])}}">
                    <x-honeypot/>
                    <div class="form-group">
                        {{ trans('posts.comments.name') }}:
                        <input name="user_name" type="text" class="form-control"/>
                        @if($errors->has('user_name'))
                            <div class="text-danger">{{ $errors->first('user_name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ trans('posts.comments.comment') }}:
                        <textarea name="comment" class="form-control" rows="3"></textarea>
                        @if($errors->has('comment'))
                            <div class="text-danger">{{ $errors->first('comment') }}</div>
                        @endif
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-primary">{{ trans('posts.comments.send') }}</button>
                </form>
            </div>
        </div>

        <!-- Single Comment Bad style.-->
        @foreach($post->comments()->ofPublish(1)->orderBy('id','desc')->get() AS $comment)
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">{{ $comment->user_name }}</h5>
                    {{ $comment->comment }}
                    <br>
                    {{ $comment->created_at }}

                </div>
            </div>
        @endforeach

        <!-- Comment with nested comments -->
        {{-- <div class="media mb-4">
             <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
             <div class="media-body">
                 <h5 class="mt-0">Commenter Name</h5>
                 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

                 <div class="media mt-4">
                     <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                     <div class="media-body">
                         <h5 class="mt-0">Commenter Name</h5>
                         Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                     </div>
                 </div>

                 <div class="media mt-4">
                     <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                     <div class="media-body">
                         <h5 class="mt-0">Commenter Name</h5>
                         Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                     </div>
                 </div>

             </div>
         </div>--}}

    </div>
    <!-- /.row -->
    @include("site.partials.sidebar", ["categories" => $categories])
@endsection

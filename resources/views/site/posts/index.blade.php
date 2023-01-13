@extends('layouts.app')

@section('title', trans("posts.index.title"))

@section('content')
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <br>
            <h1 class="my-4">@lang("posts.index.title")
                <small>@lang("posts.index.secondTitle")</small>
            </h1>

        @foreach($posts AS $post)
            <!-- Blog Post -->
                <div class="card mb-4">
                    <img class="card-img-top" src="{{$post->image}}" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title"> {{ $post->name }}</h2>
                        <p class="card-text"> {{ $post->preview_text }} </p>
                        <a href="{{ route('site.posts.show', ['slug' => $post->slug]) }}" class="btn btn-primary">@lang("posts.index.more") &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $post->created_at }} &nbsp; <span class="fa fa-eye"></span> {{ $post->views }}
                    </div>
                </div>
        @endforeach


        <!-- Pagination -->
            {{ $posts->links() }}

        </div>

    <!-- /.row -->
    @include("site.partials.sidebar", ["categories" => $categories])
@endsection

@extends('layouts.app')

@section('title', env('APP_NAME').": ".$category->name)

@section('content')
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <br>
            <h1 class="my-4">@lang("posts.index.title")
                <small>{{ $category->name }}</small>
            </h1>

            @include('site.partials.posts', ['posts' => $posts])


        <!-- Pagination -->
            {{ $posts->links() }}

        </div>

    <!-- /.row -->
    @include("site.partials.sidebar", ["categories" => $categories])
@endsection

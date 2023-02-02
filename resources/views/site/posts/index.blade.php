@extends('layouts.app')

@section('title', trans("posts.index.title"))
@section('description', trans("posts.index.description"))

@section('content')
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <br>
            <h1 class="my-4">@lang("posts.index.title")
                <small>@lang("posts.index.secondTitle")</small>
            </h1>

            @include('site.partials.posts', ['posts' => $posts])


        <!-- Pagination -->
            {{ $posts->links() }}

        </div>

    <!-- /.row -->
    @include("site.partials.sidebar", ["categories" => $categories])
@endsection

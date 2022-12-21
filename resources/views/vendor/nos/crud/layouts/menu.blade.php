@if(auth()->check())
    <a class="list-group-item list-group-item-action @if(stristr(Route::current()->getName(), 'posts')) active @endif"
       href="{{ route('posts.index') }}">
        <span class="fa fa-text-height"></span>
        @lang('crud.post.title')
    </a>
    <a class="list-group-item list-group-item-action @if(stristr(Route::current()->getName(), 'categories')) active @endif"
       href="{{ route('categories.index') }}">
        <span class="fa fa-list"></span>
        @lang('crud.category.title')
    </a>
    <a class="list-group-item list-group-item-action @if(stristr(Route::current()->getName(), 'comments')) active @endif"
       href="{{ route('comments.index') }}">
        <span class="fa fa-user"></span>
        @lang('crud.comment.title')
    </a>
@endif

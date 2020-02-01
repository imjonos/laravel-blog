<a class="list-group-item list-group-item-action @if(Route::current()->getName() == 'posts.index') active @endif" href="{{ route('posts.index') }}">@lang('crud.post.title')</a>

<a class="list-group-item list-group-item-action @if(Route::current()->getName() == 'categories.index') active @endif" href="{{ route('categories.index') }}">@lang('crud.category.title')</a>

<a class="list-group-item list-group-item-action @if(Route::current()->getName() == 'comments.index') active @endif" href="{{ route('comments.index') }}">@lang('crud.comment.title')</a>


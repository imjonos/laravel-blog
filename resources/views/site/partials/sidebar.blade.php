<!-- Sidebar Widgets Column -->

<div class="col-md-4">
    <br>
    <!-- Search Widget -->
    <div class="card my-4">
        <h5 class="card-header">{{ trans('posts.search')}}</h5>
        <div class="card-body">
            <div class="input-group">
                <form action="{{ route("site.posts.index") }} " method="GET">
                    <div class="row">
                        <div class="col-8">
                            <input type="text" name="search" value="{{ request()->get('search', '') }}" class="form-control" placeholder="{{ trans('posts.search' )}}">
                        </div>
                        <div class="col-4">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-secondary" type="button">{{ trans('posts.find')}}</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">{{ trans('posts.categories')}}</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    @foreach($categories AS $category)
                        <a href="{{ route("site.categories.show", ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Side Widget -->
    {{--<div class="card my-4">
        <h5 class="card-header">Side Widget</h5>
        <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and
            feature
            the
            new Bootstrap 4 card containers!
        </div>
    </div>
--}}
</div>


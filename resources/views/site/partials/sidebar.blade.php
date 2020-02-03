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
    <div class="card my-4">
        <h5 class="card-header">{{ trans('posts.links')}}</h5>
        <div class="card-body">
            <ul class="nav">

                <li class="nav-item">
                    <a href="https://www.upwork.com/o/profiles/users/~01d822b7fef3889804/" target="_blank"><i class="fa fa-laptop" aria-hidden="true"></i><span>Upwork</span></a>&nbsp;&nbsp;&nbsp;
                </li>
                <li class="nav-item">
                    <a href="https://www.youtube.com/user/imnosok/featured?view_as=subscriber" target="_blank"><i class="fa fa-video" aria-hidden="true"></i><span>Youtube</span></a>&nbsp;&nbsp;&nbsp;
                </li>
                <li class="nav-item">
                    <a href="https://github.com/imjonos" target="_blank"><i class="fa fa-code" aria-hidden="true"></i><span>Github</span></a>&nbsp;&nbsp;&nbsp;
                </li>
                <li class="nav-item">
                    <a href="https://blog.coders.studio" target="_blank"><i class="fa fa-terminal" aria-hidden="true" ></i><span>Blog</span></a>&nbsp;&nbsp;&nbsp;
                </li>

            </ul>
        </div>
    </div>

</div>


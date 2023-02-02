@foreach($posts AS $post)
    <!-- Blog Post -->
    <div class="card mb-4">
        <img class="card-img-top" src="{{ $post->image_url }}" alt="{{ $post->name }}">
        <div class="card-body">
            <h2 class="card-title"> {{ $post->name }}</h2>
            <p class="card-text"> {{ $post->preview_text }} </p>
            <a href="{{ route('site.posts.show', ['slug' => $post->slug]) }}" class="btn btn-primary">@lang("posts.index.more") &rarr;</a>
        </div>
        <div class="card-footer text-muted">
            <emoji-reaction
                :default-statistics="{{ getEmojiReactionStatistics($post) }}"
                :post-id="{{ $post->id }}"
                :emojis="{{ $emojis }}"></emoji-reaction>
            <br>
            {{ $post->created_at }} &nbsp; <span class="fa fa-eye"></span> {{ $post->views }}

        </div>
    </div>
@endforeach

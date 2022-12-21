@component('nos.crud::create', [
    'componentName' => 'post'
])
    @slot('inputs')
        @include('admin.posts.form')
    @endslot
@endcomponent

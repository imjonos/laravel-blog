@component('nos.crud::edit', [
    'componentName' => 'post',
    'data' => $data
])
    @slot('inputs')
        @include('admin.posts.form')
    @endslot
@endcomponent

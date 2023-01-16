@component('nos.crud::table', [
    'componentName' => 'comment',
    'columns' => [
        ['name' => 'id', 'order' => true],
        ['name' => 'user_name', 'order' => true],
        ['name' => 'publish', 'order' => true],
        ['name' => 'comment', 'order' => true],
        ['name' => 'post_id', 'order' => true],
        ['name' => 'created_at', 'order' => true]
    ]
])
    @slot('post_id')
        <template v-if="item.post.name"> @{{ item.post.name }}</template>
    @endslot
    @slot('publish')
        <template v-if="item.publish"> @{{ trans('crud.labels.yes') }}</template>
        <template v-else> @{{ trans('crud.labels.no') }}</template>
    @endslot
@endcomponent

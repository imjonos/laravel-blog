@component('nos.crud::table', [
    'componentName' => 'post',
    'columns' => [
        ['name' => 'id', 'order' => true],
        ['name' => 'name', 'order' => true],
        ['name' => 'slug', 'order' => true],
        ['name' => 'publish', 'order' => true],
        ['name' => 'preview_text', 'order' => true],
        ['name' => 'category_id', 'order' => true],
        ['name' => 'views', 'order' => true],
        ['name' => 'created_at', 'order' => true]
    ]
])
    @slot('category_id')
        <template v-if="item.category.name"> @{{ item.category.name }}</template>
    @endslot

    @slot('publish')
        <template v-if="item.publish"> @{{ trans('crud.labels.yes') }}</template>
        <template v-else> @{{ trans('crud.labels.no') }}</template>
    @endslot
@endcomponent

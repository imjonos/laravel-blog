@component('nos.crud::table', [
    'componentName' => 'category',
    'columns' => [
        ['name' => 'id', 'order' => true],
        ['name' => 'name', 'order' => true],
        ['name' => 'slug', 'order' => true],
        ['name' => 'publish', 'order' => true],
        ['name' => 'created_at', 'order' => true],
    ]
])
    @slot('publish')
        <template v-if="item.publish"> @{{ trans('crud.labels.yes') }}</template>
        <template v-else> @{{ trans('crud.labels.no') }}</template>
    @endslot
@endcomponent

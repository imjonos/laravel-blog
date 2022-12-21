@component('nos.crud::create', [
    'componentName' => 'category'
])
    @slot('inputs')
        @component('nos.crud::fields.text', [
     'required' => 1,
     'label' => trans('crud.category.columns.name'),
     'vModel' => 'form.name',
     'name' => 'name',
     'placeholder' => trans('crud.category.columns.name')
 ])
        @endcomponent
        @component('nos.crud::fields.text', [
            'required' => 1,
            'label' => trans('crud.category.columns.slug'),
            'vModel' => 'form.slug',
            'name' => 'slug',
            'placeholder' => trans('crud.category.columns.slug')
        ])
        @endcomponent
        @component('nos.crud::fields.checkbox', [
            'required' => 0,
            'label' => trans('crud.category.columns.publish'),
            'vModel' => 'form.publish',
            'name' => 'publish'
        ])
        @endcomponent

    @endslot
@endcomponent

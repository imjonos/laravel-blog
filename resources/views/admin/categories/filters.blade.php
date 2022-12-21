@component('nos.crud::filters')
    @slot('inputs')
	    @component('nos.crud::filter')
    @slot('input')
	    @component('nos.crud::fields.number', [
	'required' => 0,
    'label' => trans('crud.category.columns.id'),
    'vModel' => 'form.id',
    'name' => 'id',
    'placeholder' => trans('crud.category.columns.id')
])
@endcomponent

    @endslot
@endcomponent
@component('nos.crud::filter')
    @slot('input')
	    @component('nos.crud::fields.text', [
	'required' => 0,
    'label' => trans('crud.category.columns.name'),
    'vModel' => 'form.name',
    'name' => 'name',
    'placeholder' => trans('crud.category.columns.name')
])
@endcomponent

    @endslot
@endcomponent
@component('nos.crud::filter')
    @slot('input')
	    @component('nos.crud::fields.text', [
	'required' => 0,
    'label' => trans('crud.category.columns.slug'),
    'vModel' => 'form.slug',
    'name' => 'slug',
    'placeholder' => trans('crud.category.columns.slug')
])
@endcomponent

    @endslot
@endcomponent
@component('nos.crud::filter')
    @slot('input')
	    @component('nos.crud::fields.checkbox', [
	'required' => 0,
	'label' => trans('crud.category.columns.publish'),
	'vModel' => 'form.publish',
	'name' => 'publish'
])
@endcomponent

    @endslot
@endcomponent

   @endslot
@endcomponent

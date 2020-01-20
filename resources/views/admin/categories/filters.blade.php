<div class="row">
	<div class="col-md-3">
	@component('codersstudio.crud::fields.number', [
	'required' => 0
])
    @slot('label')
        @lang('crud.category.columns.id')
    @endslot
    @slot('vModel')
        form.id
    @endslot
    @slot('name')
        id
    @endslot
    @slot('placeholder')
        @lang('crud.category.columns.id')
    @endslot
@endcomponent

</div>
<div class="col-md-3">
	@component('codersstudio.crud::fields.text', [
	'required' => 0
])
    @slot('label')
        @lang('crud.category.columns.name')
    @endslot
    @slot('vModel')
        form.name
    @endslot
    @slot('name')
        name
    @endslot
    @slot('placeholder')
     	@lang('crud.category.columns.name')
    @endslot
@endcomponent

</div>
<div class="col-md-3">
	@component('codersstudio.crud::fields.text', [
	'required' => 0
])
    @slot('label')
        @lang('crud.category.columns.slug')
    @endslot
    @slot('vModel')
        form.slug
    @endslot
    @slot('name')
        slug
    @endslot
    @slot('placeholder')
     	@lang('crud.category.columns.slug')
    @endslot
@endcomponent

</div>
<div class="col-md-3">
	@component('codersstudio.crud::fields.checkbox', [
	'required' => 0
])
    @slot('label')
        @lang('crud.category.columns.publish')
    @endslot
    @slot('vModel')
        form.publish
    @endslot
    @slot('name')
        publish
    @endslot
@endcomponent

</div>

</div>
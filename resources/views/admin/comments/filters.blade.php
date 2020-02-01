<div class="row">
	<div class="col-md-3">
	@component('codersstudio.crud::fields.number', [
	'required' => 0
])
    @slot('label')
        @lang('crud.comment.columns.id')
    @endslot
    @slot('vModel')
        form.id
    @endslot
    @slot('name')
        id
    @endslot
    @slot('placeholder')
        @lang('crud.comment.columns.id')
    @endslot
@endcomponent

</div>
<div class="col-md-3">
	@component('codersstudio.crud::fields.text', [
	'required' => 0
])
    @slot('label')
        @lang('crud.comment.columns.user_name')
    @endslot
    @slot('vModel')
        form.user_name
    @endslot
    @slot('name')
        user_name
    @endslot
    @slot('placeholder')
     	@lang('crud.comment.columns.user_name')
    @endslot
@endcomponent

</div>
<div class="col-md-3">
	@component('codersstudio.crud::fields.checkbox', [
	'required' => 0
])
    @slot('label')
        @lang('crud.comment.columns.publish')
    @endslot
    @slot('vModel')
        form.publish
    @endslot
    @slot('name')
        publish
    @endslot
@endcomponent

</div>
<div class="col-md-3">
	@component('codersstudio.crud::fields.text', [
	'required' => 0
])
    @slot('label')
        @lang('crud.comment.columns.comment')
    @endslot
    @slot('vModel')
        form.comment
    @endslot
    @slot('name')
        comment
    @endslot
    @slot('placeholder')
     	@lang('crud.comment.columns.comment')
    @endslot
@endcomponent

</div>
<div class="col-md-3">
	@component('codersstudio.crud::fields.select', [
    'required' => 0
])
    @slot('label')
        @lang('crud.comment.columns.post_id')
    @endslot
    @slot('vModel')
        form.post_id
    @endslot
    @slot('name')
        post_id
    @endslot
    @slot('options')
        @foreach(App\Post::all() as $value)
            <option value="{{ $value->id }}">
                {{ $value->name }}
            </option>
        @endforeach
    @endslot
@endcomponent

</div>

</div>
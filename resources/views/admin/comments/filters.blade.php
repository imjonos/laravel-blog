@component('nos.crud::filters')
    @slot('inputs')
	    @component('nos.crud::filter')
    @slot('input')
	    @component('nos.crud::fields.number', [
	'required' => 0,
    'label' => trans('crud.comment.columns.id'),
    'vModel' => 'form.id',
    'name' => 'id',
    'placeholder' => trans('crud.comment.columns.id')
])
@endcomponent

    @endslot
@endcomponent
@component('nos.crud::filter')
    @slot('input')
	    @component('nos.crud::fields.text', [
	'required' => 0,
    'label' => trans('crud.comment.columns.user_name'),
    'vModel' => 'form.user_name',
    'name' => 'user_name',
    'placeholder' => trans('crud.comment.columns.user_name')
])
@endcomponent

    @endslot
@endcomponent
@component('nos.crud::filter')
    @slot('input')
	    @component('nos.crud::fields.checkbox', [
	'required' => 0,
	'label' => trans('crud.comment.columns.publish'),
	'vModel' => 'form.publish',
	'name' => 'publish'
])
@endcomponent

    @endslot
@endcomponent
@component('nos.crud::filter')
    @slot('input')
	    @component('nos.crud::fields.text', [
	'required' => 0,
    'label' => trans('crud.comment.columns.comment'),
    'vModel' => 'form.comment',
    'name' => 'comment',
    'placeholder' => trans('crud.comment.columns.comment')
])
@endcomponent

    @endslot
@endcomponent
@component('nos.crud::filter')
    @slot('input')
	    @component('nos.crud::fields.select', [
    'required' => 0,
    'label' => trans('crud.comment.columns.post_id'),
    'vModel' => 'form.post_id',
    'name' => 'post_id'
])
    @slot('options')
        @foreach(App\Models\Post::all() as $value)
            <option value="{{ $value->id }}">
                {{ $value->name }}
            </option>
        @endforeach
    @endslot
@endcomponent

    @endslot
@endcomponent

   @endslot
@endcomponent

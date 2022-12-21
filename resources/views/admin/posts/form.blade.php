@component('nos.crud::fields.text', [
'required' => 1,
'label' => trans('crud.post.columns.name'),
'vModel' => 'form.name',
'name' => 'name',
'placeholder' => trans('crud.post.columns.name')
])
@endcomponent
@component('nos.crud::fields.text', [
    'required' => 1,
    'label' => trans('crud.post.columns.slug'),
    'vModel' => 'form.slug',
    'name' => 'slug',
    'placeholder' => trans('crud.post.columns.slug')
])
@endcomponent
@component('nos.crud::fields.checkbox', [
    'required' => 0,
    'label' => trans('crud.post.columns.publish'),
    'vModel' => 'form.publish',
    'name' => 'publish'
])
@endcomponent
@component('nos.crud::fields.text', [
    'required' => 1,
    'label' => trans('crud.post.columns.preview_text'),
    'vModel' => 'form.preview_text',
    'name' => 'preview_text',
    'placeholder' => trans('crud.post.columns.preview_text')
])
@endcomponent
@component('nos.crud::fields.editor', [
    'required' => 1,
    'label' => trans('crud.post.columns.detail_text'),
    'vModel' => 'form.detail_text',
    'name' => 'detail_text'
])
@endcomponent
@component('nos.crud::fields.select', [
    'required' => 1,
    'label' => trans('crud.post.columns.category_id'),
    'vModel' => 'form.category_id',
    'name' => 'category_id'
])
    @slot('options')
        @foreach(App\Models\Category::all() as $value)
            <option value="{{ $value->id }}">
                {{ $value->name }}
            </option>
        @endforeach
    @endslot
@endcomponent
@component('nos.crud::fields.select', [
    'required' => 1,
    'label' => trans('crud.post.columns.user_id'),
    'vModel' => 'form.user_id',
    'name' => 'user_id'
])
    @slot('options')
        @foreach(App\Models\User::all() as $value)
            <option value="{{ $value->id }}">
                {{ $value->name }}
            </option>
        @endforeach
    @endslot
@endcomponent
@component('nos.crud::fields.files', [
                                   'required' => 0
                               ])
    @slot('label')
        @lang('crud.labels.files')
    @endslot
    @slot('vModel')
        form.media_collection
    @endslot
    @slot('name')
        PostMediaCollection
    @endslot
    @slot('placeholder')
        @lang('crud.labels.files_placeholder')
    @endslot
@endcomponent

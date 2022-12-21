@component('nos.crud::create', [
    'componentName' => 'comment'
])
    @slot('inputs')
        @component('nos.crud::fields.text', [
     'required' => 1,
     'label' => trans('crud.comment.columns.user_name'),
     'vModel' => 'form.user_name',
     'name' => 'user_name',
     'placeholder' => trans('crud.comment.columns.user_name')
 ])
        @endcomponent
        @component('nos.crud::fields.checkbox', [
            'required' => 0,
            'label' => trans('crud.comment.columns.publish'),
            'vModel' => 'form.publish',
            'name' => 'publish'
        ])
        @endcomponent
        @component('nos.crud::fields.text', [
            'required' => 1,
            'label' => trans('crud.comment.columns.comment'),
            'vModel' => 'form.comment',
            'name' => 'comment',
            'placeholder' => trans('crud.comment.columns.comment')
        ])
        @endcomponent
        @component('nos.crud::fields.select', [
            'required' => 1,
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

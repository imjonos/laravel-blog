@component('nos.crud::filters')
    @slot('inputs')
        @component('nos.crud::filter')
            @slot('input')
                @component('nos.crud::fields.number', [
            'required' => 0,
            'label' => trans('crud.post.columns.id'),
            'vModel' => 'form.id',
            'name' => 'id',
            'placeholder' => trans('crud.post.columns.id')
        ])
                @endcomponent

            @endslot
        @endcomponent
        @component('nos.crud::filter')
            @slot('input')
                @component('nos.crud::fields.text', [
            'required' => 0,
            'label' => trans('crud.post.columns.name'),
            'vModel' => 'form.name',
            'name' => 'name',
            'placeholder' => trans('crud.post.columns.name')
        ])
                @endcomponent

            @endslot
        @endcomponent
        @component('nos.crud::filter')
            @slot('input')
                @component('nos.crud::fields.text', [
            'required' => 0,
            'label' => trans('crud.post.columns.slug'),
            'vModel' => 'form.slug',
            'name' => 'slug',
            'placeholder' => trans('crud.post.columns.slug')
        ])
                @endcomponent

            @endslot
        @endcomponent
        @component('nos.crud::filter')
            @slot('input')
                @component('nos.crud::fields.checkbox', [
            'required' => 0,
            'label' => trans('crud.post.columns.publish'),
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
            'label' => trans('crud.post.columns.preview_text'),
            'vModel' => 'form.preview_text',
            'name' => 'preview_text',
            'placeholder' => trans('crud.post.columns.preview_text')
        ])
                @endcomponent

            @endslot
        @endcomponent
        @component('nos.crud::filter')
            @slot('input')
                @component('nos.crud::fields.text', [
            'required' => 0,
            'label' => trans('crud.post.columns.detail_text'),
            'vModel' => 'form.detail_text',
            'name' => 'detail_text',
            'placeholder' => trans('crud.post.columns.detail_text')
        ])
                @endcomponent

            @endslot
        @endcomponent
        @component('nos.crud::filter')
            @slot('input')
                @component('nos.crud::fields.select', [
            'required' => 0,
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

            @endslot
        @endcomponent
    @endslot
@endcomponent

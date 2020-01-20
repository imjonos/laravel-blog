<div class="row">
    <div class="col-md-3">
        @component('codersstudio.crud::fields.number', [
        'required' => 0
    ])
            @slot('label')
                @lang('crud.post.columns.id')
            @endslot
            @slot('vModel')
                form.id
            @endslot
            @slot('name')
                id
            @endslot
            @slot('placeholder')
                @lang('crud.post.columns.id')
            @endslot
        @endcomponent

    </div>
    <div class="col-md-3">
        @component('codersstudio.crud::fields.text', [
        'required' => 0
    ])
            @slot('label')
                @lang('crud.post.columns.name')
            @endslot
            @slot('vModel')
                form.name
            @endslot
            @slot('name')
                name
            @endslot
            @slot('placeholder')
                @lang('crud.post.columns.name')
            @endslot
        @endcomponent

    </div>
    <div class="col-md-3">
        @component('codersstudio.crud::fields.text', [
        'required' => 0
    ])
            @slot('label')
                @lang('crud.post.columns.slug')
            @endslot
            @slot('vModel')
                form.slug
            @endslot
            @slot('name')
                slug
            @endslot
            @slot('placeholder')
                @lang('crud.post.columns.slug')
            @endslot
        @endcomponent

    </div>
    <div class="col-md-3">
        @component('codersstudio.crud::fields.checkbox', [
        'required' => 0
    ])
            @slot('label')
                @lang('crud.post.columns.publish')
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
                @lang('crud.post.columns.preview_text')
            @endslot
            @slot('vModel')
                form.preview_text
            @endslot
            @slot('name')
                preview_text
            @endslot
            @slot('placeholder')
                @lang('crud.post.columns.preview_text')
            @endslot
        @endcomponent

    </div>
    <div class="col-md-3">
        @component('codersstudio.crud::fields.text', [
        'required' => 0
    ])
            @slot('label')
                @lang('crud.post.columns.detail_text')
            @endslot
            @slot('vModel')
                form.detail_text
            @endslot
            @slot('name')
                detail_text
            @endslot
            @slot('placeholder')
                @lang('crud.post.columns.detail_text')
            @endslot
        @endcomponent

    </div>
    <div class="col-md-3">
        @component('codersstudio.crud::fields.select', [
                                           'required' => 0
                                       ])
            @slot('label')
                @lang('crud.post.columns.category_id')
            @endslot
            @slot('vModel')
                form.category_id
            @endslot
            @slot('name')
                category_id
            @endslot
            @slot('options')
                @foreach(App\Category::publish()->get() as $value)
                    <option value="{{ $value->id }}">
                        {{ $value->name }}
                    </option>
                @endforeach
            @endslot
        @endcomponent
    </div>

</div>

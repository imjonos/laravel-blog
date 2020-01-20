@extends('codersstudio.crud::layouts.app')

@section('title', trans('crud.post.title'))

@section('content')

    <post-create inline-template>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">@lang('crud.post.title')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('crud.buttons.create')</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    @lang('crud.buttons.create')
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            @component('codersstudio.crud::fields.select', [
                                        'required' => 1
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
                            @component('codersstudio.crud::fields.text', [
                                    'required' => 1
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
                            @component('codersstudio.crud::fields.text', [
                                'required' => 1
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
                            @component('codersstudio.crud::fields.text', [
                                'required' => 1
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
                            @component('codersstudio.crud::fields.editor', [
                                'required' => 1
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
                            @endcomponent

                            @component('codersstudio.crud::fields.files', [
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

                            <div class="text-right">
                                <button class="btn btn-primary" @click="store">
                                    <i v-if="loading" class="fas fa-pulse fa-spinner"></i>
                                    @lang('crud.buttons.save')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </post-create>
@endsection

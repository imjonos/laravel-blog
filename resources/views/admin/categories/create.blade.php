@extends('codersstudio.crud::layouts.app')

@section('title', trans('crud.category.title'))

@section('content')

    <category-create inline-template>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{ route('categories.index') }}">@lang('crud.category.title')</a></li>
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
                            @component('codersstudio.crud::fields.text', [
    'required' => 1
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
                            @component('codersstudio.crud::fields.text', [
                                'required' => 1
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
                                    CategoryMediaCollection
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
    </category-create>
@endsection

@extends('codersstudio.crud::layouts.app')

@section('title', trans('crud.post.title'))

@section('content')

	<post-edit
		:data="{{ $data }}"
		inline-template>
		<div>
			<nav aria-label="breadcrumb">
			  	<ol class="breadcrumb">
			  		<li class="breadcrumb-item"><a href="{{ route('posts.index') }}">@lang('crud.post.title')</a></li>
			    	<li class="breadcrumb-item active" aria-current="page">@lang('crud.buttons.edit') №@{{ data.id }}</li>
			  	</ol>
			</nav>
			<div class="card">
				<div class="card-header">
					@lang('crud.buttons.edit') №@{{ data.id }}
				</div>
			    <div class="card-body">
			        <div class="row justify-content-center">
			            <div class="col-md-8">
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
	'required' => 1
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
@component('codersstudio.crud::fields.textarea', [
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

						    <div class="text-right">
				    			<button class="btn btn-primary" @click="update">
				    				<i v-if="loading" class="fas fa-pulse fa-spinner"></i>
						    		@lang('crud.buttons.save')
						    	</button>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </post-edit>
@endsection

@extends('codersstudio.crud::layouts.app')

@section('title', trans('crud.comment.title'))

@section('content')

	<comment-edit
		:data="{{ $data }}"
		inline-template>
		<div>
			<nav aria-label="breadcrumb">
			  	<ol class="breadcrumb">
			  		<li class="breadcrumb-item"><a href="{{ route('comments.index') }}">@lang('crud.comment.title')</a></li>
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
@component('codersstudio.crud::fields.checkbox', [
	'required' => 1
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
@component('codersstudio.crud::fields.text', [
	'required' => 1
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
@component('codersstudio.crud::fields.select', [
    'required' => 1
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
    </comment-edit>
@endsection

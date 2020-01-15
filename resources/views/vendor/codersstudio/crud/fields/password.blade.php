<div class="form-group">
	<label for="">
		{{ $label }}
		@if($required ?? false)
		<span class="text-danger">*</span>
		@endif
	</label>
	<input type="password" v-model="{{ $vModel }}" class="form-control">
	<div class="text-danger" v-if="errors.has('{{ $name }}')" v-html="errors.first('{{ $name }}')"></div>
</div>
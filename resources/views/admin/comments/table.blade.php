<div class="table-responsive mb-3">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="selectAll" @change="selectAll" v-model="allSelected" :value="true">
                        <label class="custom-control-label" for="selectAll"></label>
                    </div>
                </th>
                @component('codersstudio.crud::th', [
	'order' => true
])
    @slot('columnName')
    	id
    @endslot
    @slot('title')
        @lang('crud.comment.columns.id')
    @endslot
@endcomponent
@component('codersstudio.crud::th', [
	'order' => true
])
    @slot('columnName')
    	user_name
    @endslot
    @slot('title')
        @lang('crud.comment.columns.user_name')
    @endslot
@endcomponent
@component('codersstudio.crud::th', [
	'order' => true
])
    @slot('columnName')
    	publish
    @endslot
    @slot('title')
        @lang('crud.comment.columns.publish')
    @endslot
@endcomponent
@component('codersstudio.crud::th', [
	'order' => true
])
    @slot('columnName')
    	comment
    @endslot
    @slot('title')
        @lang('crud.comment.columns.comment')
    @endslot
@endcomponent
@component('codersstudio.crud::th', [
	'order' => true
])
    @slot('columnName')
    	post_id
    @endslot
    @slot('title')
        @lang('crud.comment.columns.post_id')
    @endslot
@endcomponent

                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in data.data">
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" :id="'check' + item.id" v-model="selected_checkboxes" :value="item.id" @change="checkItem">
                        <label class="custom-control-label" :for="'check' + item.id"></label>
                    </div>
                </td>
                				<td>
					@{{ item.id }}
				</td>
				<td>
					@{{ item.user_name }}
				</td>
<td>
	<div class="custom-control custom-checkbox">
		<input type="checkbox" v-model="item.publish" class="custom-control-input" :id="'checkpublish' + item.id" @change="toggleBoolean(item, 'publish')">
		<label class="custom-control-label" :for="'checkpublish' + item.id"></label>
	</div>
</td>				<td>
					@{{ item.comment }}
				</td>
				<td>
					@{{ item.post.name }}
				</td>

                <td class="nowrap">
                    <a class="btn btn-primary btn-sm" :href="'/admin/comments/' + item.id + '/edit'" data-toggle="tooltip" data-placement="top" title="@lang('crud.buttons.edit')">
                        <i class="fas fa-pen-square"></i>
                    </a>
                    <button class="btn btn-danger btn-sm" @click="destroy(item.id)" data-toggle="tooltip" data-placement="top" title="@lang('crud.buttons.delete')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<b-pagination
    v-model="data.current_page"
    :total-rows="data.total"
    :per-page="data.per_page"
    @change="getData"
></b-pagination>

@if ($crud->hasAccess('update'))
	@if($status = data_get($entry, 'status') == 'Requested')
	<form method="POST" action="{{ url($crud->route.'/'.$entry->getKey().'/draft') }}">
		{!! csrf_field() !!}
		<button class="btn btn-sm btn-link" type="submit"><i class="far fa-envelope"></i> Draft</button>
	</form>
	@elseif ($status = data_get($entry, 'status') == 'Draft')
	<form method="POST" action="{{ url($crud->route.'/'.$entry->getKey().'/request') }}">
		{!! csrf_field() !!}
		<button class="btn btn-sm btn-link" type="submit"><i class="far fa-paper-plane"></i> Request</button>
	</form>
	@else
	@endif
@endif
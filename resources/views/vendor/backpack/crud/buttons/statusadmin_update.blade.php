@if ($crud->hasAccess('update'))
	@php
		$itemrequest = data_get($entry, 'itemrequest');
		$status = $itemrequest->status;
		$adminstatus = data_get($entry, 'adminstatus');
	@endphp
	@if($status == 'Approved')
	<a href="{{ url($crud->route.'/'.$entry->getKey().'/process') }}" class="btn btn-sm btn-link"><i class="fas fa-spinner"></i> Process</a>
	@elseif ($adminstatus == 'Approved')
	<form method="POST" action="{{ url($crud->route.'/'.$entry->getKey().'/complete') }}">
		{!! csrf_field() !!}
		<button class="btn btn-sm btn-link" type="submit"><i class="fas fa-check"></i> Complete</button>
	</form>
	@endif
@endif
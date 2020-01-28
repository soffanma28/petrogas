@if ($crud->hasAccess('update'))
	@php
		$itemrequest = data_get($entry, 'itemrequest');
		$status = $itemrequest->status;
		$adminstatus = data_get($entry, 'adminstatus');
	@endphp

		@if($status == 'Approved')
			@if(backpack_user()->can('Request Admin'))
				<a href="{{ url($crud->route.'/'.$entry->getKey().'/request') }}" class="btn btn-sm btn-link"><i class="far fa-paper-plane"></i> Request</a>
			@endif
		@elseif ($adminstatus == 'Requested')
			@if(backpack_user()->can('Approve Admin'))
			<a href="{{ url($crud->route.'/'.$entry->getKey().'/approve') }}" class="btn btn-sm btn-link"><i class="far fa-thumbs-up"></i> Approve</a>
			@endif
		@elseif ($adminstatus == 'Approved')
			@if(backpack_user()->can('Complete Admin'))
			<form method="POST" action="{{ url($crud->route.'/'.$entry->getKey().'/complete') }}">
				{!! csrf_field() !!}
				<button class="btn btn-sm btn-link" type="submit"><i class="fas fa-check"></i> Complete</button>
			</form>
			@endif
		@endif
	
@endif
@if ($crud->hasAccess('update'))
	@php
		$status = data_get($entry, 'status');
	@endphp
	@if($status == 'Requested')
	<div class="row">
		@if(backpack_user()->can('Approve Supply'))
		<div class="col-md-3">
			<a href="{{ url($crud->route.'/'.$entry->getKey().'/approve') }}" class="btn btn-sm btn-link"><i class="far fa-thumbs-up"></i> Approve</a>
		</div>
		@endif
		<div class="col-md-3">
			<form method="POST" action="{{ url($crud->route.'/'.$entry->getKey().'/draft') }}">
				{!! csrf_field() !!}
				<button class="btn btn-sm btn-link" type="submit"><i class="far fa-envelope"></i> Draft</button>
			</form>
		</div>
	</div>
	@elseif ($status == 'Draft')
		@if(backpack_user()->can('Request Supply'))
		<form method="POST" action="{{ url($crud->route.'/'.$entry->getKey().'/send') }}">
			{!! csrf_field() !!}
			<button class="btn btn-sm btn-link" type="submit"><i class="far fa-paper-plane"></i> Request</button>
		</form>
		@endif
	@endif
@endif
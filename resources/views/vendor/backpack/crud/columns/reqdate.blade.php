<span>
	@php
	$itemrequest = data_get($entry, 'itemrequest');
	@endphp
	{{$itemrequest->req_date->format('d F Y H:m:i')}}
</span>
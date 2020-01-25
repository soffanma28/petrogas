<span>
	@php
	$itemrequest = data_get($entry, 'itemrequest');
	@endphp
	{{$itemrequest->requestor->name}}
</span>
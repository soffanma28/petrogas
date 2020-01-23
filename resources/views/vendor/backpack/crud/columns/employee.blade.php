{{-- Employee list --}}
@php
	$value = data_get($entry, $column['name']);
@endphp
@foreach($value as $key=>$val)
<span>{{$val["empid"]}} -- {{$val["empname"]}}</span></br>
@endforeach
<span></span>
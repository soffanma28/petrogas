{{-- Item list --}}
@php
	$value = data_get($entry, $column['name']);
	$items = App\Models\Item_request_detail::where('req_id', $value)->get();
@endphp
<table class="table table-bordered">
	<thead>
		<tr>
			<td>Item name</td>
			<td>Quantity request</td>
			<td>Quantity actual</td>
			<td>Unit Cost</td>
		</tr>
	</thead>
	<tbody>
		@foreach($items as $item)
		<tr>
			<td class="pt-0 pb-0">{{$item->item->name}}</td>
			<td class="pt-0 pb-0">{{$item->qty_request}}</td>
			<td class="pt-0 pb-0">{{$item->qty_actual}}</td>
			<td class="pt-0 pb-0">{{$item->qty_actual * $item->item->price}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
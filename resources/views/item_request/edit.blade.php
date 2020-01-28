@extends(backpack_view('layouts.top_left'))

@section('after_styles')
	<link rel="stylesheet" href="{{ asset('packages/pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
	<style type="text/css">
		.select2 {
			width: 100% !important;
		}
	</style>
@stop

@section('header')
	<nav aria-label="breadcrumb" class="d-none d-lg-block">
	  	<ol class="breadcrumb bg-transparent justify-content-end p-0">
		    <li class="breadcrumb-item text-capitalize"><a href="http://localhost:8000/admin/dashboard">Admin</a></li>
			<li class="breadcrumb-item text-capitalize"><a href="http://localhost:8000/admin/item_request">Item Request</a></li>
			<li class="breadcrumb-item text-capitalize active" aria-current="page">Edit</li>
		</ol>
	</nav>

    <section class="container-fluid">
	 	<h2>
	        <span class="text-capitalize">Office Supply Request Form</span>
	        <!-- <small>Add item.</small> -->
			<small><a href="http://localhost:8000/admin/item_request" class="hidden-print font-sm"><i class="fas fa-angle-double-left"></i> Back </a></small>
    	</h2>
	</section>
@endsection

@section('content')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<!-- Default box -->
		  <form method="post"
		  		action="{{ route('item_request.update', $itemrequest->id) }}"
		  		>
			  {!! csrf_field() !!}

		    <div class="row">
		    	<div class="col-lg-12">
		    		<div id="saveActions" class="form-group">
						
						@if($itemrequest->status == 'Draft' || $itemrequest->status == 'Requested')
					    <input type="hidden" name="save_action" value="">
	    				 <button type="submit" name="action" value="draft" class="btn btn-success">
				            <span class="far fa-envelope" role="presentation" aria-hidden="true"></span> &nbsp;
				            <span data-value="">Draft</span>
				        </button>

	    				<button type="submit" name="action" value="saveprove" class="btn btn-success">
				            <span class="far fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
				            <span data-value="">Save & Approval</span>
				        </button>
						@else
	    				<button type="submit" name="action" value="approved" class="btn btn-success">
				            <span class="fas fa-thumbs-up" role="presentation" aria-hidden="true"></span> &nbsp;
				            <span data-value="">Approved</span>
				        </button>
				        @endif

	    				 <a href="{{ url()->previous() }}" class="btn btn-default"><span class="fas fa-ban"></span> &nbsp;{{ trans('backpack::crud.cancel') }}</a>
			    	</div>
		    	</div>
		    	<div class="col-lg-6 col-md-12 col-sm-12">
		    		<div class="card">
		    			<div class="card-body">
		    				<!-- DRAFT REQUESTED -->
		    				@if($itemrequest->status == 'Draft' || $itemrequest->status == 'Requested')
							<div class="form-group row">
		    					<label class="col-sm-3">Requestor</label>
		    					<input class="form-control" type="text" name="requestor_id" value="{{$itemrequest->requestor_id}}" hidden>
		    					<div class="col-sm-9">
		    						<input class="form-control" type="text" name="requestor" value="{{$itemrequest->requestor->employee->employee_id}} -- {{$itemrequest->requestor->employee->name}}" disabled>	
		    					</div>
		    					
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Employee</label>
		    					<div class="col-sm-9">
		    						<select class="form-control" id="employee" name="employee[]" multiple="multiple">
		    							@php
		    							$check = array_column($itemrequest->employee, 'empid');
		    							@endphp
			    						@foreach($employees as $employee)
											@if(in_array($employee->employee_id, $check))
			    							<option value="{{ $employee->employee_id }}" selected>{{ $employee->employee_id }} - {{$employee->name}}</option>
			    							@else
			    							<option value="{{ $employee->employee_id }}">{{ $employee->employee_id }} - {{$employee->name}}</option>
			    							@endif
			    						@endforeach
			    					</select>	
		    					</div>
		    					
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Department</label>
		    					<div class="col-sm-9">
		    						<input class="form-control" type="text" name="department" id="department" value="{{ $itemrequest->requestor->department->name }}" disabled>
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Email</label>
		    					<div class="col-sm-9">
		    						<input class="form-control" type="email" name="email" id="email" value="{{ $itemrequest->requestor->email }}" disabled>	
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3 col-form-label">Request Date</label>
							    <div class="col-sm-9">
							    	<div class="input-group date" id="reqdatetimepicker">
								        <input type="datetime" class="form-control" id="req_date" name="req_date" value="{{$itemrequest->req_date->format('d F Y H:m:i')}}">
								        <span class="input-group-addon input-group-text">
					                        <span class="far fa-calendar"></span>
					                    </span>
								    </div>
							    </div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Type Of Request</label>
		    					<div class="col-sm-9">
		    						<select class="form-control select" id="category" name="typeofrequest">
			    						@foreach($categories as $category)
			    							@if($category == $itemrequest->typeofrequest)
				    						<option value="{{ $itemrequest->typeofrequest }}" selected>{{$itemrequest->typeofrequest}}</option>
				    						@else
				    						<option value="{{ $category->name }}">{{$category->name}}</option>
				    						@endif
			    						@endforeach
			    					</select>
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Status</label>
		    					<div class="col-sm-9">
		    						<select class="form-control select" id="status" name="status">
			    						<option value="{{ $itemrequest->status }}">{{$itemrequest->status}}</option>
			    					</select>
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Remark</label>
		    					<div class="col-sm-9">
		    						<textarea class="form-control textarea" type="text" name="remark" id="remark">{{$itemrequest->remark}}</textarea>
		    					</div>
		    				</div>
		    				@else
		    				<!-- APPROVED -->
							<div class="form-group row">
		    					<label class="col-sm-3">Requestor</label>
		    					<input class="form-control" type="text" name="requestor_id" value="{{$itemrequest->requestor_id}}" hidden>
		    					<div class="col-sm-9">
		    						<input class="form-control" type="text" name="requestor" value="{{$itemrequest->requestor->employee->employee_id}} -- {{$itemrequest->requestor->employee->name}}" disabled>	
		    					</div>
		    					
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Employee</label>
		    					<div class="col-sm-9">
		    						<select class="form-control select2" id="ap_employee" name="employee[]" multiple="multiple" disabled>
			    						@foreach($itemrequest->employee as $employee)
			    							<option value="{{ $employee['empid'] }}" selected>{{ $employee['empid'] }} - {{$employee['empname']}}</option>
			    						@endforeach
			    					</select>	
		    					</div>
		    					
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Department</label>
		    					<div class="col-sm-9">
		    						<input class="form-control" type="text" name="department" id="ap_department" value="{{ $itemrequest->requestor->department->name }}" disabled>
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Email</label>
		    					<div class="col-sm-9">
		    						<input class="form-control" type="email" name="email" id="ap_email" value="{{ $itemrequest->requestor->email }}" disabled>	
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3 col-form-label">Request Date</label>
							    <div class="col-sm-9">
							    	<div class="input-group date" id="ap_reqdatetimepicker">
								        <input type="datetime" class="form-control" id="ap_req_date" name="req_date" value="{{$itemrequest->req_date->format('d F Y H:m:i')}}" disabled>
								        <span class="input-group-addon input-group-text">
					                        <span class="far fa-calendar"></span>
					                    </span>
								    </div>
							    </div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Type Of Request</label>
		    					<div class="col-sm-9">
		    						<select class="form-control select" id="ap_category" name="typeofrequest" disabled>
			    						<option value="{{ $itemrequest->typeofrequest }}">{{$itemrequest->typeofrequest}}</option>
			    					</select>
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Status</label>
		    					<div class="col-sm-9">
		    						<select class="form-control select" id="ap_status" name="status" disabled>
			    						<option value="{{ $itemrequest->status }}">{{$itemrequest->status}}</option>
			    					</select>
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Remark</label>
		    					<div class="col-sm-9">
		    						<textarea class="form-control textarea" type="text" name="remark" id="ap_remark">{{$itemrequest->remark}}</textarea>
		    					</div>
		    				</div>
		    				@endif
		    			</div>
		    		</div>
		    	</div>
		    	<div class="col-lg-6 col-md-12 col-sm-12">
		    		<div class="card">
		    			<div class="card-body">
		    				@if($itemrequest->status == 'Draft' || $itemrequest->status == 'Requested')
		    				<h3>Items</h3>
		    				<div class="table-responsive">
		    					<table id="request_list" class="table mt-2 mb-0">
			    					<thead class="">
			    						<tr>
			    							<th>Item name</th>
			    							<th>Qty Request</th>
			    							<th>Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="reqbody">
			    						@foreach($itemdetail as $key => $item)
			    							@foreach($items as $list)
			    								@if($item->item_id == $list->id)
			    								<tr id="row{{$key}}">
					    							<td style="width: 60%" class="pb-0" >
					    								<div class="form-group">
									    					<select class="form-control select2 item_list" name="items[]">
																<option value="{{$item->item->id}}" selected>{{$item->item->name}}</option>
									    					</select>
									    				</div>
					    							</td>
					    							<td>
					    								<div class="form-group mb-1">
									    					<input class="form-control qty_list" type="text" name="qty_request[]" value="{{$item->qty_request}}">
									    				</div>
					    							</td>
					    							<td style="text-align: center">
					    								<a href="javascript:void(0)" id="{{$key}}" class="removeitem">
					    									<i class="fas fa-trash fa-lg mt-2"></i>
					    								</a>
					    							</td>
					    						</tr>
			    								@endif
			    							@endforeach
			    							
			    						@endforeach
			    						<tr id="row{{$key}}">
			    							<td style="width: 60%" class="pb-0" >
			    								<div class="form-group">
							    					<select class="form-control select2 item_list" name="items[]">
							    						@foreach($items as $ite)
														<option value="{{$ite->id}}">{{$ite->name}}</option>
														@endforeach
							    					</select>
							    				</div>
			    							</td>
			    							<td>
			    								<div class="form-group mb-1">
							    					<input class="form-control qty_list" type="text" name="qty_request[]" value="">
							    				</div>
			    							</td>
			    							<td style="text-align: center">
			    								<a href="javascript:void(0)" id="{{$key}}" class="removeitem">
			    									<i class="fas fa-trash fa-lg mt-2"></i>
			    								</a>
			    							</td>
			    						</tr>
			    					</tbody>
			    				</table>
			    				<a href="javascript:void(0)" class="btn btn-primary" id="additem" data-style="zoom-in"><span class="ladda-label"><i class="fas fa-plus"></i> {{ trans('backpack::crud.add') }} item</span></a>
		    				</div>
		    				@else
		    				<h3>Items</h3>
		    				<div class="table-responsive">
		    					<table id="request_list" class="table mt-2 mb-0">
			    					<thead class="">
			    						<tr>
			    							<th>Item name</th>
			    							<th>Qty Request</th>
			    							<th>Qty Actual</th>
			    							<!-- <th>Action</th> -->
			    						</tr>
			    					</thead>
			    					<tbody id="reqbody">
			    						@foreach($itemdetail as $key => $item)
			    						<tr id="row{{$key}}">
			    							<td style="width: 50%" class="pb-0" >
			    								<div class="form-group">
							    					<select class="form-control select2 item_list" name="items[]">
							    						
															<option value="{{$item->item->id}}">{{$item->item->name}}</option>
							    						
							    					</select>
							    				</div>
			    							</td>
			    							<td>
			    								<div class="form-group mb-1">
							    					<input class="form-control qty_list" type="text" name="qty_request[]" value="{{$item->qty_request}}" disabled>
							    				</div>
			    							</td>
			    							<td>
			    								<div class="form-group mb-1">
							    					<input class="form-control qty_list" type="text" name="qty_actual[]" value="{{$item->qty_actual}}" required>
							    				</div>
			    							</td>
			    							<!-- <td style="text-align: center">
			    								<a href="javascript:void(0)" id="{{$key}}" class="removeitem">
			    									<i class="fas fa-trash fa-lg mt-2"></i>
			    								</a>
			    							</td> -->
			    						</tr>
			    						@endforeach
			    					</tbody>
			    				</table>
			    				<!-- <a href="javascript:void(0)" class="btn btn-primary" id="additem" data-style="zoom-in"><span class="ladda-label"><i class="fas fa-plus"></i> {{ trans('backpack::crud.add') }} item</span></a> -->
		    				</div>
		    				@endif
		    			</div>
		    		</div>
		    	</div>
		    </div>

		  </form>
	</div>
</div>

@endsection

@section('after_scripts')

	<script type="text/javascript">

		$(document).ready(function(){

      		var selectedValues = $("#employee").val();
	        $('#employee').val(selectedValues).trigger('change');
	        $('#employee').select2();
      		$('.item_list').select2();
      		// $('#item').select2();
      		$('#reqdatetimepicker').datetimepicker({
      			format : 'DD/MM/Y H:mm:ss',
      			icons:{
		            time: 'far fa-clock',
		            date: 'far fa-calendar',
		            up: 'fas fa-chevron-up',
		            down: 'fas fa-chevron-down',
		            previous: 'fas fa-chevron-left',
		            next: 'fas fa-chevron-right',
		            today: 'fas fa-cut',
		            clear: 'fas fa-trash',
		            close: 'fas fa-ban'
		        }
      		});
      		$('#req_date').val('{{$itemrequest->req_date->format("d F Y H:m:i")}}');
      		var row = $('#request_list')[0].tBodies[0].rows.length;
      		$('#additem').click(function () {
      			row++;
      			$('#reqbody').append('<tr id="row'+row+'" class="req_added">' +
      				'<td style="width: 40%" class="pb-0">' +
						'<div class="form-group">' +
	    					'<select class="form-control select2 item_list" name="items[]">' +
	    						@foreach($items as $item)
	    							'<option value="{{$item->id}}">{{$item->name}}</option>' +
	    						@endforeach
	    					'</select>' +
	    				'</div>' +
					'</td>' +
					'<td>' +
						'<div class="form-group mb-1">' +
	    					'<input class="form-control qty_list" type="number" name="qty_request[]">' +
	    				'</div>' +
					'</td>' +
					'<td style="text-align: center">' +
						'<a href="javascript:void(0)" id="'+row+'" class="removeitem">' +
							'<i class="fas fa-trash fa-lg mt-2"></i>' +
						'</a>' +
					'</td>' +
				'</tr>' );
				$('.item_list').select2();
      			var items = $("select[name='items[]']").map(function(){return $(this).val();}).get();
		    	console.log(items);
      		});

      		$(document).on('click', '.removeitem', function(){  
		        var btnid = $(this).attr("id");  
		        console.log(btnid); 
		        $('#row'+btnid+'').remove();  
		    });
		    var items = $("select[name='items[]']").map(function(){return $(this).val();}).get();
		    console.log(items);

		    $.ajaxSetup({
	          	headers: {
	            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          	}
	      	});




		});
	</script>

@stop






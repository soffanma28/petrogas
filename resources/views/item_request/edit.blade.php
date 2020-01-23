@extends(backpack_view('layouts.top_left'))

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
		  		action="{{ route('item_request.store') }}"
		  		>
			  {!! csrf_field() !!}

		    <div class="row">
		    	<div class="col-lg-12">
		    		<div id="saveActions" class="form-group">
						
					    <input type="hidden" name="save_action" value="">
	    				 <button type="submit" name="action" value="draft" class="btn btn-success">
				            <span class="far fa-envelope" role="presentation" aria-hidden="true"></span> &nbsp;
				            <span data-value="">Draft</span>
				        </button>

	    				<button type="submit" name="action" value="saveprove" class="btn btn-success">
				            <span class="fas fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
				            <span data-value="">Save & Approval</span>
				        </button>

	    				 <a href="{{ url()->previous() }}" class="btn btn-default"><span class="fas fa-ban"></span> &nbsp;{{ trans('backpack::crud.cancel') }}</a>
			    	</div>
		    	</div>
		    	<div class="col-lg-7 col-md-12 col-sm-12">
		    		<div class="card">
		    			<div class="card-body">
		    				<div class="form-group">
		    					<label>Requestor</label>
		    					<input class="form-control" type="text" name="requestor_id" value="{{$itemrequest->requestor_id}}" hidden>
		    					<input class="form-control" type="text" name="requestor" value="{{$itemrequest->requestor_id}} -- {{$itemrequest->requestor->name}}" disabled>
		    				</div>
		    				<div class="form-group">
		    					<label>Employee</label>
		    					<select class="form-control" id="employee" name="employee[]" multiple="multiple">
		    						@foreach($employees as $employee)
		    							<option value="{{ $employee->employee_id }}">{{ $employee->employee_id }} - {{$employee->name}}</option>
		    						@endforeach
		    					</select>
		    				</div>
		    				<div class="form-group">
		    					<label>Department</label>
		    					<input class="form-control" type="text" name="department" id="department" value="{{ $itemrequest->requestor->department->name }}" disabled>
		    				</div>
		    				<div class="form-group">
		    					<label>Email</label>
		    					<input class="form-control" type="email" name="email" id="email" value="{{ $itemrequest->requestor->email }}" disabled>
		    				</div>
		    				<div class="form-group">
		    					<label>Request Date</label>
		    					<div class="input-group date" data-provide="datepicker">
								    <input type="text" class="form-control" value="{{$itemrequest->req_date}}" name="req_date" id="req_date">
								    <div class="input-group-addon">
								        <span class="glyphicon glyphicon-th"></span>
								    </div>
								</div>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="col-lg-5 col-md-12 col-sm-12">
		    		<div class="card">
		    			<div class="card-body">
		    				<div class="form-group">
		    					<label>Type Of Request</label>
		    					<select class="form-control select" id="category" name="typeofrequest">
		    						@foreach($categories as $category)
		    							@if($category->name == $itemrequest->typeofrequest)
										<option value="{{ $category->name }}" selected>{{$category->name}}</option>
										@else
										<option value="{{ $category->name }}" selected>{{$category->name}}</option>
		    							@endif
		    						@endforeach
		    					</select>
		    				</div>
		    				<div class="form-group">
		    					<label>Status</label>
		    					<select class="form-control select" id="status" name="status">
		    						<option value="Draft" selected>Draft</option>
		    						<option value="Requested">Requested</option>
		    						<option value="Approval">Approval</option>
		    						<option value="Approved">Approved</option>
		    						<option value="On Process">On Process</option>
		    						<option value="Ready">Ready</option>
		    						<option value="Completed">Completed</option>
		    					</select>
		    				</div>
		    				<div class="form-group">
		    					<label>Remark</label>
		    					<textarea class="form-control textarea" type="text" name="remark" id="remark" value="{{$itemrequest->remark}}"></textarea>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="col-lg-12 col-md-12 col-sm-12">
		    		<div class="card">
		    			<div class="card-body mb-5">
		    				<h3>Items</h3>
		    				<div class="table-responsive">
		    					<table id="request_list" class="table mt-2 mb-0">
			    					<thead class="">
			    						<tr>
			    							<th>Item name -- Quantity</th>
			    							<th>Quantity Request</th>
			    							<th>Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="reqbody">
			    						<tr>
			    							<td style="width: 60%" class="pb-0">
			    								<div class="form-group">
							    					<select class="form-control select2 item_list" name="items[]">
							    						@foreach($items as $item)
															<option value="{{$item->id}}">{{$item->name}} -- {{$item->qty}}</option>
							    						@endforeach
							    					</select>
							    				</div>
			    							</td>
			    							<td>
			    								<div class="form-group mb-1">
							    					<input class="form-control qty_list" type="text" name="qty_request[]">
							    				</div>
			    							</td>
			    							<td>
			    								<a href="javascript:void(0)">
			    									<i class="fas fa-trash fa-lg mt-2 removeitem"></i>
			    								</a>
			    							</td>
			    						</tr>
			    					</tbody>
			    				</table>
			    				<a href="javascript:void(0)" class="btn btn-primary" id="additem" data-style="zoom-in"><span class="ladda-label"><i class="fas fa-plus"></i> {{ trans('backpack::crud.add') }} item</span></a>
		    				</div>
		    				
		    			</div>
		    		</div>
		    	</div>
		    	<!-- <div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="card cardprogress">
				        <div class="row d-flex justify-content-between px-3 top">
				            <div class="d-flex">
				                <h5>ORDER <span class="text-primary font-weight-bold">#Y34XDHR</span></h5>
				            </div>
				            <div class="d-flex flex-column text-sm-right">
				                <p class="mb-0">Expected Arrival <span>01/12/19</span></p>
				                <p>USPS <span class="font-weight-bold">234094567242423422898</span></p>
				            </div>
				        </div> 
				        <div class="row d-flex justify-content-center">
				            <div class="col-12">
				                <ul id="progressbar" class="text-center">
				                    <li class="active check step0">
				                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Requested</p>
				                    	<p class="mb-1">Sugiyono</p>
				                    	<p class="">22/01/2020 12:00 AM</p>
				                    </li>
				                    <li class="active check step0">
				                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Approval</p>
				                    	<p class="mb-1">Sugiyono</p>
				                    	<p class="">22/01/2020 12:00 AM</p>
				                    </li>
				                    <li class="active check step0">
				                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">On Process</p>
				                    	<p class="mb-1">Sugiyono</p>
				                    	<p class="">22/01/2020 12:00 AM</p>
				                    </li>
				                    <li class="active check step0">
				                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Ready</p>
				                    	<p class="mb-1">Sugiyono</p>
				                    	<p class="">22/01/2020 12:00 AM</p>
				                    </li>
				                    <li class="round step0">
				                    	<p class="font-weight-bold">Completed</p>
				                    </li>
				                </ul>
				            </div>
				        </div>
				    </div>
				</div> -->
		    </div>

		  </form>
	</div>
</div>

@endsection

@section('after_scripts')

	<script type="text/javascript">

		$(document).ready(function(){

      		$('#employee').select2();
      		$('.item_list').select2();
      		// $('#item').select2();
      		// $('#req_date').datepicker('destroy');
      		// $('#req_date').datepicker({
      		// 	todayBtn : "linked",
      		// });
      		// $('#req_date').datepicker('update');
      		var i = 1;
      		$('#additem').click(function () {
      			i++;
      			$('#reqbody').append('<tr id="row'+i+'" class="req_added">' +
      				'<td style="width: 60%" class="pb-0">' +
						'<div class="form-group">' +
	    					'<select class="form-control select2 item_list" name="items[]">' +
	    						@foreach($items as $item)
	    							'<option value="{{$item->id}}">{{$item->name}} -- {{$item->qty}}</option>' +
	    						@endforeach
	    					'</select>' +
	    				'</div>' +
					'</td>' +
					'<td>' +
						'<div class="form-group mb-1">' +
	    					'<input class="form-control qty_list" type="text" name="qty_request[]">' +
	    				'</div>' +
					'</td>' +
					'<td>' +
						'<a href="javascript:void(0)" id="'+i+'" class="removeitem">' +
							'<i class="fas fa-trash fa-lg mt-2"></i>' +
						'</a>' +
					'</td>' +
				'</tr>' );
				$('.item_list').select2();
      		
      		});

      		$(document).on('click', '.removeitem', function(){  
		        var btnid = $(this).attr("id");   
		        $('#row'+btnid+'').remove();  
		    });  

		    $.ajaxSetup({
	          	headers: {
	            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          	}
	      	});




		});
	</script>

@stop






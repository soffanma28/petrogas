@extends(backpack_view('layouts.top_left'))

@section('header')
	<nav aria-label="breadcrumb" class="d-none d-lg-block">
	  	<ol class="breadcrumb bg-transparent justify-content-end p-0">
		    <li class="breadcrumb-item text-capitalize"><a href="http://localhost:8000/admin/dashboard">Admin</a></li>
			<li class="breadcrumb-item text-capitalize"><a href="http://localhost:8000/admin/item_request">Item Request</a></li>
			<li class="breadcrumb-item text-capitalize active" aria-current="page">Add</li>
		</ol>
	</nav>

    <section class="container-fluid">
	 	<h2>
	        <span class="text-capitalize">Office Supply Request Form</span>
	        <!-- <small>Add item.</small> -->
			<small><a href="http://localhost:8000/admin/item_request" class="hidden-print font-sm"><i class="fa fa-angle-double-left"></i> Back </a></small>
    	</h2>
	</section>
@endsection

@section('content')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<!-- Default box -->
		  <form method="post"
		  		action=""
		  		>
			  {!! csrf_field() !!}

		    <div class="row">
		    	<div class="col-lg-7 col-md-12 col-sm-12">
		    		<div class="card">
		    			<div class="card-body">
		    				<div class="form-group">
		    					<label>Requestor</label>
		    					<select class="form-control select" id="users" name="user_id">
		    						<option value=""></option>
		    						@foreach($users as $user)
		    							<option value="{{ $user->id }}">{{ $user->id }} - {{$user->name}}</option>
		    						@endforeach
		    					</select>
		    				</div>
		    				<div class="form-group">
		    					<label>Employee</label>
		    					<select class="form-control select" id="employee" name="employee">
		    						<option value=""></option>
		    						@foreach($users as $user)
		    							<option value="{{ $user->id }}">{{ $user->id }} - {{$user->name}}</option>
		    						@endforeach
		    					</select>
		    				</div>
		    				<div class="form-group">
		    					<label>Department</label>
		    					<input class="form-control" type="text" name="department" id="department">
		    				</div>
		    				<div class="form-group">
		    					<label>Email</label>
		    					<input class="form-control" type="email" name="email" id="email">
		    				</div>
		    				<div class="form-group">
		    					<label>Request Date</label>
		    					<div class="input-group date" data-provide="datepicker">
								    <input type="text" class="form-control" value="{{Carbon\Carbon::today()->format('d-m-Y')}}" name="req_date" id="req_date">
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
		    					<label>Type of Request</label>
		    					<input class="form-control" type="text" name="typeof_request" id="typeof_request" value="Office Supply">
		    				</div>
		    				<div class="form-group">
		    					<label>Status</label>
		    					<input class="form-control" type="text" name="status" id="status" value="Ready">
		    				</div>
		    				<div class="form-group">
		    					<label>Remark</label>
		    					<textarea class="form-control textarea" type="text" name="remark" id="remark" value=""></textarea>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="col-lg-12 col-md-12 col-sm-12">
		    		<div class="card">
		    			<div class="card-body">
		    				<a href="#" class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> {{ trans('backpack::crud.add') }} item</span></a>
		    				<table id="request_list" class="table mt-2">
		    					<thead class="">
		    						<tr>
		    							<th>Name</th>
		    							<th>Quantity Request</th>
		    							<th>Quantity Actual</th>
		    							<th>Action</th>
		    						</tr>
		    					</thead>
		    					<tbody>
		    						<tr>
		    							<td>
		    								<div class="form-group">
						    					<select class="form-control select" id="users" name="user_id">
						    						<option></option>
						    						<option value="">test1</option>
						    						<option value="">test2</option>
						    						<option value="">test3</option>
						    					</select>
						    				</div>
		    							</td>
		    							<td>
		    								<div class="form-group">
						    					<input class="form-control" type="text" name="qty_request" id="qty_request">
						    				</div>
		    							</td>
		    							<td>
		    								<div class="form-group">
						    					<input class="form-control" type="text" name="qty_act" id="qty_act">
						    				</div>
		    							</td>
		    							<td>
		    								<a href="#">
		    									<i class="fa fa-trash fa-lg mt-2"></i>
		    								</a>
		    							</td>
		    						</tr>
		    					</tbody>
		    				</table>
		    			</div>
		    		</div>
		    	</div>
		    </div>

	          <div id="saveActions" class="form-group">

			    <input type="hidden" name="save_action" value="">

			    <div class="btn-group" role="group">

			        <button type="submit" class="btn btn-success">
			            <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
			            <span data-value="">Save & Approval</span>
			        </button>

			    </div>

			    <a href="{{ url()->previous() }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;{{ trans('backpack::crud.cancel') }}</a>
			</div>

		  </form>
	</div>
</div>

@endsection

@section('after_scripts')

	<script type="text/javascript">
		$(document).ready(function(){

			$('#req_date').datepicker();


			$('#users').change(function(){
			    var user_id = $('#users').val();
			    $('#department').val("Department");
			    $('#email').val("name@email.com");

		        // $.ajax({
		        //     type: 'POST',
		        //     headers: {
		        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        //     }
		        //     url: '/admin/item_request/create/dept',
		        //     data: {
		        //         id: user_id
		        //     },
		        //     dataType: 'json',
		        //     success: function(data) {
		        //     	console.log(data);
		        //     },
		        //     error: function(data) {
		        //         var errors = $.parseJSON(data.responseText);
		        //         console.log(errors);
		        //     }
		        // });
			});
		});
	</script>

@stop






@extends(backpack_view('layouts.top_left'))

@section('after_styles')
	<link rel="stylesheet" href="{{ asset('packages/pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
@stop

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
				            <span class="far fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
				            <span data-value="">Save & Approval</span>
				        </button>

	    				 <a href="{{ url()->previous() }}" class="btn btn-default"><span class="fas fa-ban"></span> &nbsp;{{ trans('backpack::crud.cancel') }}</a>
			    	</div>
		    	</div>
		    	<div class="col-lg-6 col-md-12 col-sm-12">
		    		<div class="card">
		    			<div class="card-body">
		    				<div class="form-group row">
		    					<label class="col-sm-3 col-form-label">Requestor</label>
		    					<input class="form-control" type="text" name="requestor_id" value="{{backpack_user()->id}}" hidden>
		    					<div class="col-sm-9">
		    						<input class="form-control" type="text" name="requestor" value="{{backpack_user()->employee->employee_id}} -- {{backpack_user()->employee->name}}" disabled>
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3 col-form-label">Employee</label>
		    					<div class="col-sm-9">
		    						<select class="form-control" id="employee" name="employee[]" multiple="multiple" required>
			    						@foreach($employees as $employee)
			    							<option value="{{ $employee->employee_id }}">{{ $employee->employee_id }} - {{$employee->name}}</option>
			    						@endforeach
			    					</select>
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3 col-form-label">Department</label>
		    					<div class="col-sm-9">
		    						<input class="form-control" type="text" name="department" id="department" value="{{ backpack_user()->department->name }}" disabled>
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3 col-form-label">Email</label>
		    					<div class="col-sm-9">
		    						<input class="form-control" type="email" name="email" id="email" value="{{ backpack_user()->email }}" disabled>
		    					</div>
		    				</div>
		    				<div class="form-group row">
							    <label class="col-sm-3 col-form-label">Request Date</label>
							    <div class="col-sm-9">
							    	<div class="input-group date" id="reqdatetimepicker">
								        <input type="datetime" class="form-control" name="req_date" value="{{Carbon\Carbon::now()->format('d/m/Y H:i:s')}}" required>
								        <span class="input-group-addon input-group-text">
					                        <span class="far fa-calendar"></span>
					                    </span>
								    </div>
							    </div>
							</div>
							<div class="form-group row">
		    					<label class="col-sm-3">Type Of Request</label>
		    					<div class="col-sm-9">
		    						<select class="form-control select" id="category" name="typeofrequest" required>
			    						@foreach($categories as $category)
			    							<option value="{{ $category->name }}">{{$category->name}}</option>
			    						@endforeach
			    					</select>
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Status</label>
		    					<div class="col-sm-9">
		    						<select class="form-control select" id="status" name="status">
			    						<option value="Draft" selected>Draft</option>
			    						<option value="Requested">Requested</option>
			    					</select>
		    					</div>
		    				</div>
		    				<div class="form-group row">
		    					<label class="col-sm-3">Remark</label>
		    					<div class="col-sm-9">
		    						 <textarea class="form-control textarea" type="text" name="remark" id="remark" value="" required></textarea>
		    					</div>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="col-lg-6 col-md-12 col-sm-12">
		    		<div class="card">
		    			<div class="card-body">
		    				<h3>Items</h3>
		    				<div class="table-responsive">
		    					<table id="request_list" class="table mt-2 mb-0">
			    					<thead class="">
			    						<tr>
			    							<th>Item name -- Quantity</th>
			    							<th>Qty Request</th>
			    							<th>Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="reqbody">
			    						<tr>
			    							<td style="width: 60%" class="pb-0 pt-2">
			    								<div class="form-group mb-1">
							    					<select class="form-control select2 item_list" name="items[]" required>
							    						@foreach($items as $item)
															<option value="{{$item->name}}">{{$item->name}} -- {{$item->qty}}</option>
							    						@endforeach
							    					</select>
							    				</div>
			    							</td>
			    							<td class="pt-1 pb-1">
			    								<div class="form-group mb-1">
							    					<input class="form-control qty_list" type="number" name="qty_request[]" required>
							    				</div>
			    							</td>
			    							<td style="text-align: center;" class="pt-1 pb-1">
			    								<a href="javascript:void(0)">
			    									<i class="fas fa-trash fa-lg mt-2 removeitem"></i>
			    								</a>
			    							</td>
			    						</tr>
			    					</tbody>
			    				</table>
			    				<div class="row">
			    					<div class="col-sm-3 pr-1">
			    						<a href="javascript:void(0)" class="btn btn-primary w-100" id="additem" data-style="zoom-in"><span class="ladda-label"><i class="fas fa-plus"></i> {{ trans('backpack::crud.add') }} item</span></a>
			    					</div>
			    					<div class="col-sm-4 pl-0">
			    						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">
										  <span class="ladda-label"><i class="fas fa-upload"></i> Import item</span>
										</button>
			    						<!-- <a href="javascript:void(0)" class="btn btn-success" id="importItem" data-style="zoom-in"><span class="ladda-label"><i class="fas fa-upload"></i> Import item</span></a> -->
			    					</div>
			    				</div>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </div>
			

		  </form>
	</div>
</div>

<!-- IMPORT Modal -->
			<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="importModalLabel">Import items</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="form-group">
			        	<input type="file" name="importitem" id="import" class="form-control">
			        </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="button" id="importitem" class="btn btn-primary">Import</button>
			      </div>
			    </div>
			  </div>
			</div>

@endsection

@section('after_scripts')

	<script type="text/javascript" src="{{ asset('packages/moment/min/moment.min.js') }}"></script>
	<script src="{{ asset('packages/pc-bootstrap4-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.4/xlsx.full.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){ 



			function toJSON(workbook) {
			    var result = {};
			    workbook.SheetNames.forEach(function(sheetName) {
			      var roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
			      if (roa.length > 0) {
			        result[sheetName] = roa;
			      }
			    });
			    return result;
			};

			function ImportToTable(json){

			}

			var jsonData = '';

			$('#import').on('change', function (e) {
				var importFile = e.target.files[0];

				var fileReader = new FileReader();

				fileReader.onload = function (e) {
					var data = e.target.result;
					var workbook = XLSX.read(data, {type: 'binary'});
					jsonData = toJSON(workbook);
					// console.log(jsonData['Sheet1'][0].name);

				}

				fileReader.readAsBinaryString(importFile);
			});

			

			$('#importitem').on('click', function(){
				$('.modal').modal('hide');

				for (prop in jsonData) {

				    for (var i = 0; i < jsonData[prop].length; i++){
				    	$('#reqbody').append('<tr id="imrow'+i+'" class="req_added">' +
		      				'<td style="width: 60%" class="pb-0 pt-2">' +
								'<div class="form-group mb-1">' +
			    					'<select class="form-control select2 item_list" name="items[]">' +
			    							'<option value="'+ jsonData[prop][i].name +'">'+ jsonData[prop][i].name +'</option>' +
			    					'</select>' +
			    				'</div>' +
							'</td>' +
							'<td class="pt-1 pb-1>' +
								'<div class="form-group mb-1">' +
			    					'<input class="form-control qty_list" type="number" name="qty_request[]" value="'+jsonData[prop][i].qty_request+'">' +
			    				'</div>' +
							'</td>' +
							'<td style="text-align: center" class="pt-1 pb-1">' +
								'<a href="javascript:void(0)" id="'+i+'" class="removeimport">' +
									'<i class="fas fa-trash fa-lg mt-2"></i>' +
								'</a>' +
							'</td>' +
						'</tr>' );
				    }
				}
				$('.item_list').select2();

			});

		});
	</script>

	<script type="text/javascript">

		$(document).ready(function(){

      		$('#employee').select2();
      		$('.item_list').select2();
      		// $('#item').select2();
      		$('#reqdatetimepicker').datetimepicker({
      			allowInputToggle : true,
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

      		var i = 1;
      		$('#additem').click(function () {
      			i++;
      			$('#reqbody').append('<tr id="row'+i+'" class="req_added">' +
      				'<td style="width: 60%" class="pb-0 pt-2">' +
						'<div class="form-group mb-1">' +
	    					'<select class="form-control select2 item_list" name="items[]">' +
	    						@foreach($items as $item)
	    							'<option value="{{$item->id}}">{{$item->name}} -- {{$item->qty}}</option>' +
	    						@endforeach
	    					'</select>' +
	    				'</div>' +
					'</td>' +
					'<td class="pt-1 pb-1>' +
						'<div class="form-group mb-1">' +
	    					'<input class="form-control qty_list" type="number" name="qty_request[]">' +
	    				'</div>' +
					'</td>' +
					'<td style="text-align: center" class="pt-1 pb-1">' +
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
		    $(document).on('click', '.removeimport', function(){  
		        var btnid = $(this).attr("id");   
		        $('#imrow'+btnid+'').remove();  
		    });  


		});
	</script>

@stop






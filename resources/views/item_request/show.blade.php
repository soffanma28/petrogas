@extends(backpack_view('layouts.top_left'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.preview') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
	<section class="container-fluid">
	 <h2>
        <span class="text-capitalize">Office Supply Request</span>
        <small>Preview Office supply request.</small>
        @if ($crud->hasAccess('list'))
          <small><a href="{{ url($crud->route) }}" class="hidden-print font-sm"><i class="fa fa-angle-double-left"></i> Back </span></a></small>
        @endif
     </h2>
    </section>
@endsection

@section('after_styles')

<style type="text/css">
	.cardprogress {
	    z-index: 0;
	    /*background-color: #ECEFF1;*/
	    padding-bottom: 20px;
	    /*margin-top: 90px;*/
	    margin-bottom: 90px;
	    /*border-radius: 10px*/
	}

	.top {
	    padding-top: 40px;
	    padding-left: 5% !important;
	    padding-right: 5% !important;
	}

	#progressbar {
	    margin-bottom: 10px;
	    overflow: hidden;
	    color: #455A64;
	    padding-left: 0px;
	    margin-top: 30px
	}

	#progressbar ul {
		list-style: none;
	}

	#progressbar li {
	    list-style-type: none;
	    font-size: 13px;
	    width: 20%;
	    float: left;
	    position: relative;
	    font-weight: 400
	}

	#progressbar .step0::before {
	    font-family: "Font Awesome 5 Pro";
	  	content: "\f111";
	    /*font-weight: 900;*/
	    color: #fff;
	    display:none;
	}

	.check svg {
		color: #fff;
		width: 2em;
	    /*height: 40px;*/
	    line-height: 45px;
	    /*display: block;*/
	    font-size: 40px;
	    padding: 10px;
	    background-size: 24px;
	    background: #651FFF;
	    border-radius: 50%;
	}

	.round svg {

		color: #fff;
		width: 2em;
	    /*height: 40px;*/
	    line-height: 45px;
	    /*display: block;*/
	    font-size: 40px;
	    padding: 10px;
	    background-size: 24px;
	    background: #C5CAE9;
	    border-radius: 50%;

	}

	#progressbar li:before {
	    width: 40px;
	    height: 40px;
	    line-height: 45px;
	    display: block;
	    font-size: 20px;
	    background: #C5CAE9;
	    border-radius: 50%;
	    margin: auto;
	    padding: 0px
	}

	#progressbar li:after {
	    content: '';
	    width: 100%;
	    height: 12px;
	    background: #C5CAE9;
	    position: absolute;
	    left: 0;
	    top: 16px;
	    z-index: -1
	}

	#progressbar li:last-child:after {
	    border-top-right-radius: 10px;
	    border-bottom-right-radius: 10px;
	    position: absolute;
	    left: -50%
	}

	#progressbar li:nth-child(2):after,
	#progressbar li:nth-child(3):after,
	#progressbar li:nth-child(4):after {
	    left: -50%
	}

	#progressbar li:first-child:after {
	    border-top-left-radius: 10px;
	    border-bottom-left-radius: 10px;
	    position: absolute;
	    left: 50%
	}

	#progressbar li:last-child:after {
	    border-top-right-radius: 10px;
	    border-bottom-right-radius: 10px
	}

	#progressbar li:first-child:after {
	    border-top-left-radius: 10px;
	    border-bottom-left-radius: 10px
	}

	#progressbar li.active:before,
	#progressbar li.active:after {
	    background: #651FFF
	}

	#progressbar li.active:before {
	    font-family: "Font Awesome 5 Pro";
	  	/*font-weight: 900;*/
	  	content: "\f00c";
	  	display:none;
	}

	.icon::before {
	    display: inline-block;
	    font-style: normal;
	    font-variant: normal;
	    text-rendering: auto;
	    -webkit-font-smoothing: antialiased;
	}
</style>

@stop

@section('content')
<div class="row">
	<div class="{{ $crud->getShowContentClass() }}">

	<!-- Default box -->
	  <div class="">
	  	@if ($crud->model->translationEnabled())
	    <div class="row">
	    	<div class="col-md-12 mb-2">
				<!-- Change translation button group -->
				<div class="btn-group float-right">
				  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    {{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[$crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()] }} &nbsp; <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
					  	<a class="dropdown-item" href="{{ url($crud->route.'/'.$entry->getKey().'/show') }}?locale={{ $key }}">{{ $locale }}</a>
				  	@endforeach
				  </ul>
				</div>
			</div>
	    </div>
	    @else
	    @endif
	    <div class="card no-padding no-border">
			<table class="table table-striped mb-0">
		        <tbody>
		        @foreach ($crud->columns() as $column)
		            <tr>
		                <td>
		                    <strong>{!! $column['label'] !!}:</strong>
		                </td>
                        <td>
							@if (!isset($column['type']))
		                      @include('crud::columns.text')
		                    @else
		                      @if(view()->exists('vendor.backpack.crud.columns.'.$column['type']))
		                        @include('vendor.backpack.crud.columns.'.$column['type'])
		                      @else
		                        @if(view()->exists('crud::columns.'.$column['type']))
		                          @include('crud::columns.'.$column['type'])
		                        @else
		                          @include('crud::columns.text')
		                        @endif
		                      @endif
		                    @endif
                        </td>
		            </tr>
		        @endforeach
				@if ($crud->buttons()->where('stack', 'line')->count())
					<tr>
						<td><strong>{{ trans('backpack::crud.actions') }}</strong></td>
						<td>
							@include('crud::inc.button_stack', ['stack' => 'line'])
						</td>
					</tr>
				@endif
		        </tbody>
			</table>
	    </div><!-- /.box-body -->
	    @php
			$status = data_get($entry, 'status');
			$requestor = data_get($entry, 'requestor');
			$approver = data_get($entry, 'approver');
			$on_process = data_get($entry, 'on_process');
			$ready = data_get($entry, 'ready');
			$complete = data_get($entry, 'complete');
			$req_date = data_get($entry, 'req_date');
			$approve_date = data_get($entry, 'approve_date');
			$process_date = data_get($entry, 'process_date');
			$ready_date = data_get($entry, 'ready_date');
			$complete_date = data_get($entry, 'complete_date');
	    @endphp
	    <div class="col-lg-12 col-md-12 col-sm-12 pl-0 pr-0">
		    <div class="card cardprogress">
		        <div class="row d-flex justify-content-center">
		            <div class="col-12">
		                <ul id="progressbar" class="text-center">
		                		<!-- REQUESTED -->
		                	@if($status == 'Requested') 
								<li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Requested</p>
			                    	<p class="mb-1">{{ $requestor->name }}</p>
			                    	<p class="">
			                    		@if($req_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $req_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{$req_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Approved</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">On Process</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Ready</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold">Completed</p>
			                    </li>
			                    <!-- END REQUESTED -->
			                    <!-- APPROVED -->
		                	@elseif($status == 'Approved')
								<li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Requested</p>
			                    	<p class="mb-1">{{ $requestor->name }}</p>
			                    	<p class="">
			                    		@if($req_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $req_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$req_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Approved</p>
			                    	<p class="mb-1">{{ $approver->name }}</p>
			                    	<p class="">
			                    		@if($approve_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $approve_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$approve_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">On Process</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Ready</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold">Completed</p>
			                    </li>
			                    <!-- END APPROVED -->
			                    <!-- ON PROCESS -->
		                	@elseif($status == 'On Process')
								<li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Requested</p>
			                    	<p class="mb-1">{{ $requestor->name }}</p>
			                    	<p class="">
			                    		@if($req_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $req_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$req_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Approved</p>
			                    	<p class="mb-1">{{ $approver->name }}</p>
			                    	<p class="">
										@if($approve_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $approve_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$approve_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">On Process</p>
			                    	<p class="mb-1">{{ $on_process->name }}</p>
			                    	<p class="">
			                    		@if($process_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $process_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$process_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Ready</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold">Completed</p>
			                    </li>
			                    <!-- END ON PROCESS -->
			                    <!-- READY -->
		                	@elseif($status == 'Ready')
								<li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Requested</p>
			                    	<p class="mb-1">{{ $requestor->name }}</p>
			                    	<p class="">
			                    		@if($req_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $req_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$req_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Approved</p>
			                    	<p class="mb-1">{{ $approver->name }}</p>
			                    	<p class="">
			                    		@if($approve_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $approve_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$approve_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">On Process</p>
			                    	<p class="mb-1">{{ $on_process->name }}</p>
			                    	<p class="">
			                    		@if($process_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $process_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$process_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Ready</p>
			                    	<p class="mb-1">{{ $ready->name }}</p>
			                    	<p class="">
			                    		@if($ready_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ready_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$ready_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold">Completed</p>
			                    </li>
			                    <!-- END READY -->
			                    <!-- COMPLETED -->
		                	@elseif($status == 'Completed')
								<li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Requested</p>
			                    	<p class="mb-1">{{ $requestor->name }}</p>
			                    	<p class="">
			                    		@if($req_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $req_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$req_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Approved</p>
			                    	<p class="mb-1">{{ $approver->name }}</p>
			                    	<p class="">
			                    		@if($approve_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $approve_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$approve_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">On Process</p>
			                    	<p class="mb-1">{{ $on_process->name }}</p>
			                    	<p class="">
			                    		@if($process_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $process_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$process_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="active check step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Ready</p>
			                    	<p class="mb-1">{{ $ready->name }}</p>
			                    	<p class="">
			                    		@if($ready_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ready_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$ready_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <li class="active check step0">
			                    	<p class="font-weight-bold mb-1">Completed</p>
			                    	<p class="mb-1">{{ $complete->name }}</p>
			                    	<p class="">
			                    		@if($complete_date!='null')
			                    			{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $complete_date)->format('d F Y H:i:s')}} 
			                    		@else 
			                    			{{$complete_date}}
			                    		@endif
			                    	</p>
			                    </li>
			                    <!-- END COMPLETED -->
			                    <!-- DRAFT -->
							@else
								<li class="round step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Requested</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Approved</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">On Process</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold mb-1" style="font-size: 1.2em;">Ready</p>
			                    </li>
			                    <li class="round step0">
			                    	<p class="font-weight-bold">Completed</p>
			                    </li>
							@endif
		                </ul>
		            </div>
		        </div>
		    </div>
		</div>
	  </div><!-- /.box -->

	</div>
</div>
@endsection


@section('after_styles')
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css') }}">
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/show.css') }}">
@endsection

@section('after_scripts')
	<script data-search-pseudo-elements defer src="https://pro.fontawesome.com/releases/v5.12.0/js/all.js"></script>
	<script src="{{ asset('packages/backpack/crud/js/crud.js') }}"></script>
	<script src="{{ asset('packages/backpack/crud/js/show.js') }}"></script>
@endsection

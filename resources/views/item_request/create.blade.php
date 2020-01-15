@extends(backpack_view('layouts.top_left'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.add') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
	<section class="container-fluid">
	  <h2>
        <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
        <!-- <small>{!! $crud->getSubheading() ?? trans('backpack::crud.add').' '.$crud->entity_name !!}.</small> -->

        @if ($crud->hasAccess('list'))
          <small><a href="{{ url($crud->route) }}" class="hidden-print font-sm"><i class="fa fa-angle-double-left"></i> Back</a></small>
        @endif
	  </h2>
	</section>
@endsection

@section('content')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<!-- Default box -->

		@include('crud::inc.grouped_errors')

		  <form method="post"
		  		action="{{ url($crud->route) }}"
				@if ($crud->hasUploadFields('create'))
				enctype="multipart/form-data"
				@endif
		  		>
			  {!! csrf_field() !!}

		    <div class="row">
		    	<div class="col-lg-8 col-md-12 col-sm-12">
		    		<!-- load the view from the application if it exists, otherwise load the one in the package -->
		      		@if(view()->exists('vendor.backpack.crud.form_content'))
				      	@include('vendor.backpack.crud.form_content', [ 'fields' => $crud->fields(), 'action' => 'create' ])
				    @else
				      	@include('crud::form_content', [ 'fields' => $crud->fields(), 'action' => 'create' ])
				    @endif
		    	</div>
		    	<div class="col-lg-4 col-md-12 col-sm-12">
		    		<div class="card">
		    			<div class="card-body">
		    				
		    			</div>
		    		</div>
		    	</div>
		    	<div class="col-lg-12 col-md-12 col-sm-12">
		    		<div class="card">
		    			<div class="card-body">
		    				<a href="{{ url($crud->route.'/create') }}" class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> {{ trans('backpack::crud.add') }} item</span></a>
		    				<table id="request_list" class="table mt-2">
		    					<thead class="">
		    						<tr>
		    							<th>Name</th>
		    							<th>Quantity Request</th>
		    							<th>Current Quantity</th>
		    							<th>Action</th>
		    						</tr>
		    					</thead>
		    					<tbody>
		    						<tr>
		    							<td>test</td>
		    							<td>test</td>
		    							<td>test</td>
		    							<td>test</td>
		    						</tr>
		    					</tbody>
		    				</table>
		    			</div>
		    		</div>
		    	</div>
		    </div>

	          <div id="saveActions" class="form-group">

			    <input type="hidden" name="save_action" value="{{ $saveAction['active']['value'] }}">

			    <div class="btn-group" role="group">

			        <button type="submit" class="btn btn-success">
			            <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
			            <span data-value="{{ $saveAction['active']['value'] }}">{{ $saveAction['active']['label'] }}</span>
			        </button>

			        <div class="btn-group" role="group">
			            <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span><span class="sr-only">&#x25BC;</span></button>
			            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
			                @foreach( $saveAction['options'] as $value => $label)
			                <a class="dropdown-item" href="javascript:void(0);" data-value="{{ $value }}">{{ $label }}</a>
			                @endforeach
			            </div>
			          </div>

			    </div>

			    <a href="{{ $crud->hasAccess('list') ? url($crud->route) : url()->previous() }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;{{ trans('backpack::crud.cancel') }}</a>
			</div>

		  </form>
	</div>
</div>

@endsection

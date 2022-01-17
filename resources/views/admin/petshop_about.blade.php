@extends(backpack_view('blank'))

@section('content')

<div class="row">
	<div class="col-12">
	    <div class="card">
	      <div class="card-header">Pet Shop Example</div>
	      <div class="card-body">This mock admin panel is here to highlight all the things you can do using the <a href="https://backpackforlaravel.com/docs/crud-fields#relationship" target="_blank">relationship field</a> in Backpack 4.2, as it's using all relationship types Laravel supports. Take a look at the diagram below to better understand the database structure and where each relationship type is being used:</div>
	    </div>
	  </div>
</div>

	<a target="_blank" href="{{ asset('uploads/petshop_erd_diagram.png') }}"><img class="img img-fluid" src="{{ asset('uploads/petshop_erd_diagram.png') }}" alt="Petshop ERD Diagram"></a>

@endsection

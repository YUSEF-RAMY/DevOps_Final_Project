@extends('admin.layouts.app')

@section('title', 'New Permission')

@section('content')
<h1 class="h4 mb-3">New Permission</h1>
<form action="{{ route('admin.permissions.store') }}" method="post">
	@csrf
	<div class="mb-3">
		<label class="form-label">Name</label>
		<input name="name" class="form-control" required />
	</div>
	<button class="btn btn-primary">Create</button>
</form>
@endsection



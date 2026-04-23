@extends('admin.layouts.app')

@section('title', 'Edit Permission')

@section('content')
<h1 class="h4 mb-3">Edit Permission</h1>
<form action="{{ route('admin.permissions.update', $permission) }}" method="post">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label class="form-label">Name</label>
		<input name="name" class="form-control" required value="{{ old('name', $permission->name) }}" />
	</div>
	<button class="btn btn-primary">Save</button>
</form>
@endsection



@extends('admin.layouts.app')

@section('title', 'Add Administrator')

@section('content')
<h1 class="h4 mb-3">Add Administrator</h1>
<form method="post" action="{{ route('admin.admins.store') }}">
  @csrf
  <div class="row g-3">
    <div class="col-md-4">
      <label class="form-label">Name</label>
      <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Enter administrator name">
      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
      <label class="form-label">Email</label>
      <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="admin@example.com">
      @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
      <label class="form-label">Password (optional)</label>
      <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Default: password">
      @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
  </div>
  <div class="mt-3">
    <label class="form-label">Assign Roles</label>
    <div class="row">
      @foreach($roles as $role)
        <div class="col-md-3">
          <label class="form-check">
            <input type="checkbox" class="form-check-input" name="roles[]" value="{{ $role->name }}">
            <span class="form-check-label">{{ $role->name }}</span>
          </label>
        </div>
      @endforeach
    </div>
  </div>
  <div class="mt-3"><button class="btn btn-primary">Save</button></div>
</form>
@endsection



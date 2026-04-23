@extends('admin.layouts.app')

@section('title', 'Add Currency')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Add Currency</h1>
    <a href="{{ route('admin.currencies.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <form action="{{ route('admin.currencies.store') }}" method="POST">
        @csrf
        @include('admin.currencies.partials.form', ['currency' => null])
        <div class="mt-4 d-flex justify-content-end gap-2">
          <a href="{{ route('admin.currencies.index') }}" class="btn btn-secondary">Cancel</a>
          <button class="btn btn-primary" type="submit"><i class="bi bi-save me-1"></i>Save Currency</button>
        </div>
      </form>
      
      @push('scripts')
      <script>
      document.addEventListener('DOMContentLoaded', function() {
        const codeInput = document.getElementById('code');
        if (codeInput) {
          codeInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
          });
        }
      });
      </script>
      @endpush
    </div>
  </div>
</div>
@endsection

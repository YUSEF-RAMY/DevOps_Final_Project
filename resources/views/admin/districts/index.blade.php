@extends('admin.layouts.app')

@section('title', 'Districts Management')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <h3 class="card-title mb-0 fw-semibold">Districts Management</h3>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDistrictModal">
                    <i class="bi bi-plus-circle me-1"></i>Add District
                </button>
            </div>
        </div>
    </div>
    <div class="card-body p-3">

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
  <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
    @foreach($divisions as $division)
    <div class="mb-4">
      <h5 class="border-bottom pb-2 mb-3">
        <i class="bi bi-geo-alt me-2"></i>{{ $division }}
      </h5>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>District</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($districts->where('division', $division) as $district)
            <tr>
              <td>
                <strong>{{ $district->name }}</strong>
              </td>
              <td>
                <span class="badge {{ $district->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                  {{ $district->is_active ? 'Active' : 'Inactive' }}
                </span>
              </td>
              <td>
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-sm btn-outline-primary" onclick="editDistrict({{ $district->id }}, '{{ $district->name }}', '{{ $district->division }}', {{ $district->is_active ? 'true' : 'false' }}, {{ $district->sort_order }})" title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <form action="{{ route('admin.districts.toggle-status', $district) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-warning" title="Toggle Status">
                      <i class="bi bi-toggle-{{ $district->is_active ? 'on' : 'off' }}"></i>
                    </button>
                  </form>
                  <form action="{{ route('admin.districts.destroy', $district) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endforeach
    </div>
</div>

<!-- Add District Modal -->
<div class="modal fade" id="addDistrictModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.districts.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add District</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">District Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Division</label>
            <select name="division" class="form-select" required>
              <option value="">Select Division</option>
              <option value="Dhaka">Dhaka</option>
              <option value="Chittagong">Chittagong</option>
              <option value="Rajshahi">Rajshahi</option>
              <option value="Khulna">Khulna</option>
              <option value="Barisal">Barisal</option>
              <option value="Sylhet">Sylhet</option>
              <option value="Rangpur">Rangpur</option>
              <option value="Mymensingh">Mymensingh</option>
            </select>
          </div>
          <div class="mb-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" id="district_active" checked>
              <label class="form-check-label" for="district_active">Active</label>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="0">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add District</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit District Modal -->
<div class="modal fade" id="editDistrictModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editDistrictForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit District</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">District Name</label>
            <input type="text" name="name" id="edit_district_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Division</label>
            <select name="division" id="edit_district_division" class="form-select" required>
              <option value="">Select Division</option>
              <option value="Dhaka">Dhaka</option>
              <option value="Chittagong">Chittagong</option>
              <option value="Rajshahi">Rajshahi</option>
              <option value="Khulna">Khulna</option>
              <option value="Barisal">Barisal</option>
              <option value="Sylhet">Sylhet</option>
              <option value="Rangpur">Rangpur</option>
              <option value="Mymensingh">Mymensingh</option>
            </select>
          </div>
          <div class="mb-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" id="edit_district_active">
              <label class="form-check-label" for="edit_district_active">Active</label>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" id="edit_district_sort_order" class="form-control" value="0">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update District</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function editDistrict(id, name, division, isActive, sortOrder) {
    document.getElementById('editDistrictForm').action = `/admin/districts/${id}`;
    document.getElementById('edit_district_name').value = name;
    document.getElementById('edit_district_division').value = division;
    document.getElementById('edit_district_active').checked = isActive;
    document.getElementById('edit_district_sort_order').value = sortOrder;
    new bootstrap.Modal(document.getElementById('editDistrictModal')).show();
}
</script>
@endsection

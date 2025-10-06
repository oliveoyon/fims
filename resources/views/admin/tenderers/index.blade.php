@extends('admin.layouts.admin-layout')

@section('title', 'Tenderer Management')

@section('content')
<section>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <button class="btn btn-success btn-sm" id="createTendererBtn">
                    <i class="fas fa-plus-square mr-1"></i> Add New Tenderer
                </button>
            </div>
        </div>

        <table class="table table-striped" id="tenderersTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>License No</th>
                    <th>Document</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenderers as $tenderer)
                    <tr id="tenderer-{{ $tenderer->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td class="tenderer-name">{{ $tenderer->name }}</td>
                        <td>{{ $tenderer->address }}</td>
                        <td>{{ $tenderer->phone }}</td>
                        <td>{{ $tenderer->license_no }}</td>
                        <td>
                            @if ($tenderer->document)
                                <a href="{{ asset('storage/' . $tenderer->document) }}" target="_blank">View</a>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $tenderer->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $tenderer->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm editTendererBtn"
                                data-id="{{ $tenderer->id }}"
                                data-name="{{ $tenderer->name }}"
                                data-address="{{ $tenderer->address }}"
                                data-phone="{{ $tenderer->phone }}"
                                data-license_no="{{ $tenderer->license_no }}"
                                data-is_active="{{ $tenderer->is_active }}">
                                Edit
                            </button>

                            <button class="btn btn-danger btn-sm deleteTendererBtn"
                                data-id="{{ $tenderer->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tendererModal" tabindex="-1" aria-labelledby="tendererModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tendererModalLabel">Add New Tenderer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tendererForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="tendererName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="tendererName" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="tendererAddress" class="form-label">Address</label>
                            <textarea class="form-control" id="tendererAddress" name="address" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tendererPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="tendererPhone" name="phone">
                        </div>

                        <div class="mb-3">
                            <label for="tendererLicense" class="form-label">License No</label>
                            <input type="text" class="form-control" id="tendererLicense" name="license_no">
                        </div>

                        <div class="mb-3">
                            <label for="tendererDocument" class="form-label">Upload Document (PDF/Image)</label>
                            <input type="file" class="form-control" id="tendererDocument" name="document">
                        </div>

                        <div class="mb-3">
                            <label for="tendererActive" class="form-label">Status</label>
                            <select class="form-select" id="tendererActive" name="is_active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3 text-end custombtn">
                            <button type="submit" class="btn btn-primary" id="submitBtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Open Create Modal
    document.getElementById('createTendererBtn').addEventListener('click', function() {
        const form = document.getElementById('tendererForm');
        form.reset();
        form.setAttribute('action', '{{ route('admin.tenderers.store') }}');
        form.setAttribute('method', 'POST');
        document.getElementById('tendererModalLabel').textContent = 'Add New Tenderer';
        document.querySelectorAll('input[name="_method"]').forEach(el => el.remove());
        new bootstrap.Modal(document.getElementById('tendererModal')).show();
    });

    // Open Edit Modal
    document.querySelectorAll('.editTendererBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            document.getElementById('tendererName').value = this.dataset.name;
            document.getElementById('tendererAddress').value = this.dataset.address;
            document.getElementById('tendererPhone').value = this.dataset.phone;
            document.getElementById('tendererLicense').value = this.dataset.license_no;
            document.getElementById('tendererActive').value = this.dataset.is_active;

            const form = document.getElementById('tendererForm');
            form.setAttribute('action', '{{ route('admin.tenderers.update', ':id') }}'.replace(':id', id));
            form.setAttribute('method', 'POST');

            document.querySelectorAll('input[name="_method"]').forEach(el => el.remove());
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);

            document.getElementById('tendererModalLabel').textContent = 'Edit Tenderer';
            new bootstrap.Modal(document.getElementById('tendererModal')).show();
        });
    });

    // Delete Tenderer
    document.querySelectorAll('.deleteTendererBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Are you sure?',
                text: 'This tenderer will be deleted permanently!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ route('admin.tenderers.destroy', ':id') }}'.replace(':id', id), {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('tenderer-' + id).remove();
                            Swal.fire({ title: 'Deleted!', text: 'Tenderer deleted.', icon: 'success', position: 'top-end', toast: true, showConfirmButton: false, timer: 2000 });
                        } else {
                            Swal.fire('Error!', data.message || 'Failed to delete tenderer.', 'error');
                        }
                    });
                }
            });
        });
    });

    // Form Submit
    document.getElementById('tendererForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;

        const formData = new FormData(this);
        const action = this.getAttribute('action');
        const method = this.getAttribute('method');

        fetch(action, { method: method, body: formData, headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('tendererModal')).hide();
                Swal.fire({ title: 'Success!', text: method === 'POST' ? 'Tenderer added successfully.' : 'Tenderer updated successfully.', icon: 'success', position: 'top-end', toast: true, showConfirmButton: false, timer: 2000 });
                setTimeout(() => location.reload(), 500);
            } else {
                Swal.fire('Error!', data.message || 'Something went wrong!', 'error');
            }
        })
        .catch(() => Swal.fire('Error!', 'Something went wrong!', 'error'))
        .finally(() => submitBtn.disabled = false);
    });

});
</script>
@endpush

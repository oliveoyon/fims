@extends('admin.layouts.admin-layout')

@section('title', 'Upazila Management')

@section('content')
<section>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <button class="btn btn-success btn-sm" id="createUpazilaBtn">
                    <i class="fas fa-plus-square mr-1"></i> Add New Upazila
                </button>
            </div>
        </div>

        <!-- Upazilas Table -->
        <table class="table table-striped" id="upazilasTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Upazila Name</th>
                    <th>District</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($upazilas as $upazila)
                    <tr id="upazila-{{ $upazila->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td class="upazila-name">{{ $upazila->name }}</td>
                        <td class="upazila-district">{{ $upazila->district->name ?? '-' }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm editUpazilaBtn"
                                    data-id="{{ $upazila->id }}"
                                    data-name="{{ $upazila->name }}"
                                    data-district="{{ $upazila->district_id }}">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm deleteUpazilaBtn"
                                    data-id="{{ $upazila->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Fullscreen Modal for Create/Edit Upazila -->
    <div class="modal fade" id="upazilaModal" tabindex="-1" aria-labelledby="upazilaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="upazilaModalLabel">Add New Upazila</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="upazilaForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="upazilaName" class="form-label">Upazila Name</label>
                            <input type="text" class="form-control" id="upazilaName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="districtSelect" class="form-label">Select District</label>
                            <select class="form-control" id="districtSelect" name="district_id">
                                <option value="">-- Select District --</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
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
    // Open Create Modal
    document.getElementById('createUpazilaBtn').addEventListener('click', function() {
        document.getElementById('upazilaForm').reset();
        document.getElementById('upazilaForm').setAttribute('action', '{{ route('admin.upazilas.store') }}');
        document.getElementById('upazilaForm').setAttribute('method', 'POST');
        document.getElementById('upazilaModalLabel').textContent = 'Add New Upazila';
        var upazilaModal = new bootstrap.Modal(document.getElementById('upazilaModal'));
        upazilaModal.show();
    });

    // Open Edit Modal
    document.querySelectorAll('.editUpazilaBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            var upazilaId = this.getAttribute('data-id');
            var upazilaName = this.getAttribute('data-name');
            var districtId = this.getAttribute('data-district');

            document.getElementById('upazilaName').value = upazilaName;
            document.getElementById('districtSelect').value = districtId;
            document.getElementById('upazilaModalLabel').textContent = 'Edit Upazila';
            document.getElementById('upazilaForm').setAttribute('action',
                '{{ route('admin.upazilas.update', ':id') }}'.replace(':id', upazilaId));
            document.getElementById('upazilaForm').setAttribute('method', 'POST');

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_method';
            input.value = 'PUT';
            document.getElementById('upazilaForm').appendChild(input);

            var upazilaModal = new bootstrap.Modal(document.getElementById('upazilaModal'));
            upazilaModal.show();
        });
    });

    // Delete Upazila
    document.querySelectorAll('.deleteUpazilaBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            var upazilaId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this upazila!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ route('admin.upazilas.destroy', ':id') }}'.replace(':id', upazilaId), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('upazila-' + upazilaId).remove();
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The upazila has been deleted.',
                                icon: 'success',
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                            });
                        } else {
                            Swal.fire('Error!', 'There was an error deleting the upazila.', 'error');
                        }
                    });
                }
            });
        });
    });

    // Handle Form Submit (Add/Edit)
    document.getElementById('upazilaForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var submitButton = document.querySelector('#submitBtn');
        submitButton.disabled = true;

        var action = this.getAttribute('action');
        var method = this.getAttribute('method');
        var formData = new FormData(this);
        var upazilaModalElement = document.getElementById('upazilaModal');
        var upazilaModal = bootstrap.Modal.getInstance(upazilaModalElement);

        fetch(action, {
            method: method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (upazilaModal) upazilaModal.hide();

                Swal.fire({
                    title: 'Success!',
                    text: method === 'POST' ? 'Upazila added successfully.' : 'Upazila updated successfully.',
                    icon: 'success',
                    position: 'top-end',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });

                setTimeout(() => {
                    location.reload();
                }, 500);
            } else {
                Swal.fire({ title: 'Error!', text: data.message || 'Something went wrong!', icon: 'error' });
            }
        })
        .catch(error => {
            Swal.fire('Error!', 'Something went wrong!', 'error');
        })
        .finally(() => {
            submitButton.disabled = false;
        });
    });
</script>
@endpush

@extends('admin.layouts.admin-layout')

@section('title', 'Division Management')

@section('content')
<section>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <button class="btn btn-success btn-sm" id="createDivisionBtn">
                    <i class="fas fa-plus-square mr-1"></i> Add New Division
                </button>
            </div>
        </div>

        <!-- Divisions Table -->
        <table class="table table-striped" id="divisionsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($divisions as $division)
                    <tr id="division-{{ $division->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td class="division-name">{{ $division->name }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm editDivisionBtn"
                                    data-id="{{ $division->id }}"
                                    data-name="{{ $division->name }}">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm deleteDivisionBtn"
                                    data-id="{{ $division->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Fullscreen Modal for Create/Edit Division -->
    <div class="modal fade" id="divisionModal" tabindex="-1" aria-labelledby="divisionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="divisionModalLabel">Add New Division</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="divisionForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="divisionName" class="form-label">Division Name</label>
                            <input type="text" class="form-control" id="divisionName" name="name">
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
    document.getElementById('createDivisionBtn').addEventListener('click', function() {
        document.getElementById('divisionForm').reset();
        document.getElementById('divisionForm').setAttribute('action', '{{ route('admin.divisions.store') }}');
        document.getElementById('divisionForm').setAttribute('method', 'POST');
        document.getElementById('divisionModalLabel').textContent = 'Add New Division';
        var divisionModal = new bootstrap.Modal(document.getElementById('divisionModal'));
        divisionModal.show();
    });

    // Open Edit Modal
    document.querySelectorAll('.editDivisionBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            var divisionId = this.getAttribute('data-id');
            var divisionName = this.getAttribute('data-name');

            document.getElementById('divisionName').value = divisionName;
            document.getElementById('divisionModalLabel').textContent = 'Edit Division';
            document.getElementById('divisionForm').setAttribute('action',
                '{{ route('admin.divisions.update', ':id') }}'.replace(':id', divisionId));
            document.getElementById('divisionForm').setAttribute('method', 'POST');

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_method';
            input.value = 'PUT';
            document.getElementById('divisionForm').appendChild(input);

            var divisionModal = new bootstrap.Modal(document.getElementById('divisionModal'));
            divisionModal.show();
        });
    });

    // Delete Division
    document.querySelectorAll('.deleteDivisionBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            var divisionId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this division!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ route('admin.divisions.destroy', ':id') }}'.replace(':id', divisionId), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('division-' + divisionId).remove();
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The division has been deleted.',
                                icon: 'success',
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                            });
                        } else {
                            Swal.fire('Error!', 'There was an error deleting the division.', 'error');
                        }
                    });
                }
            });
        });
    });

    // Handle Form Submit (Add/Edit)
    document.getElementById('divisionForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var submitButton = document.querySelector('#submitBtn');
        submitButton.disabled = true;

        var action = this.getAttribute('action');
        var method = this.getAttribute('method');
        var formData = new FormData(this);
        var divisionModalElement = document.getElementById('divisionModal');
        var divisionModal = bootstrap.Modal.getInstance(divisionModalElement);

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
                if (divisionModal) divisionModal.hide();

                Swal.fire({
                    title: 'Success!',
                    text: method === 'POST' ? 'Division added successfully.' : 'Division updated successfully.',
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

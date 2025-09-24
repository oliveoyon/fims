@extends('admin.layouts.admin-layout')

@section('title', 'Component Management')

@section('content')
<section>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <button class="btn btn-success btn-sm" id="createComponentBtn">
                    <i class="fas fa-plus-square mr-1"></i> Add New Component
                </button>
            </div>
        </div>

        <!-- Components Table -->
        <table class="table table-striped" id="componentsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Component Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($components as $component)
                    <tr id="component-{{ $component->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td class="component-name">{{ $component->name }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm editComponentBtn"
                                    data-id="{{ $component->id }}"
                                    data-name="{{ $component->name }}">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm deleteComponentBtn"
                                    data-id="{{ $component->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Fullscreen Modal for Create/Edit Component -->
    <div class="modal fade" id="componentModal" tabindex="-1" aria-labelledby="componentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="componentModalLabel">Add New Component</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="componentForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="componentName" class="form-label">Component Name</label>
                            <input type="text" class="form-control" id="componentName" name="name">
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
    document.getElementById('createComponentBtn').addEventListener('click', function() {
        document.getElementById('componentForm').reset();
        document.getElementById('componentForm').setAttribute('action', '{{ route('admin.components.store') }}');
        document.getElementById('componentForm').setAttribute('method', 'POST');
        document.getElementById('componentModalLabel').textContent = 'Add New Component';
        var componentModal = new bootstrap.Modal(document.getElementById('componentModal'));
        componentModal.show();
    });

    // Open Edit Modal
    document.querySelectorAll('.editComponentBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            var componentId = this.getAttribute('data-id');
            var componentName = this.getAttribute('data-name');

            document.getElementById('componentName').value = componentName;
            document.getElementById('componentModalLabel').textContent = 'Edit Component';
            document.getElementById('componentForm').setAttribute('action',
                '{{ route('admin.components.update', ':id') }}'.replace(':id', componentId));
            document.getElementById('componentForm').setAttribute('method', 'POST');

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_method';
            input.value = 'PUT';
            document.getElementById('componentForm').appendChild(input);

            var componentModal = new bootstrap.Modal(document.getElementById('componentModal'));
            componentModal.show();
        });
    });

    // Delete Component
    document.querySelectorAll('.deleteComponentBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            var componentId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this component!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ route('admin.components.destroy', ':id') }}'.replace(':id', componentId), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('component-' + componentId).remove();
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The component has been deleted.',
                                icon: 'success',
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                            });
                        } else {
                            Swal.fire('Error!', 'There was an error deleting the component.', 'error');
                        }
                    });
                }
            });
        });
    });

    // Handle Form Submit (Add/Edit)
    document.getElementById('componentForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var submitButton = document.querySelector('#submitBtn');
        submitButton.disabled = true;

        var action = this.getAttribute('action');
        var method = this.getAttribute('method');
        var formData = new FormData(this);
        var componentModalElement = document.getElementById('componentModal');
        var componentModal = bootstrap.Modal.getInstance(componentModalElement);

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
                if (componentModal) componentModal.hide();

                Swal.fire({
                    title: 'Success!',
                    text: method === 'POST' ? 'Component added successfully.' : 'Component updated successfully.',
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

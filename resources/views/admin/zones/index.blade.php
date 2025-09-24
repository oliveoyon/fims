@extends('admin.layouts.admin-layout')

@section('title', 'Zone Management')

@section('content')
<section>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <button class="btn btn-success btn-sm" id="createZoneBtn">
                    <i class="fas fa-plus-square mr-1"></i> Add New Zone
                </button>
            </div>
        </div>

        <!-- Zones Table -->
        <table class="table table-striped" id="zonesTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Zone Name</th>
                    <th>Division</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($zones as $zone)
                    <tr id="zone-{{ $zone->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td class="zone-name">{{ $zone->name }}</td>
                        <td class="zone-division">{{ $zone->division->name ?? '-' }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm editZoneBtn"
                                    data-id="{{ $zone->id }}"
                                    data-name="{{ $zone->name }}"
                                    data-division="{{ $zone->division_id }}">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm deleteZoneBtn"
                                    data-id="{{ $zone->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Fullscreen Modal for Create/Edit Zone -->
    <div class="modal fade" id="zoneModal" tabindex="-1" aria-labelledby="zoneModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="zoneModalLabel">Add New Zone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="zoneForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="zoneName" class="form-label">Zone Name</label>
                            <input type="text" class="form-control" id="zoneName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="divisionSelect" class="form-label">Select Division</label>
                            <select class="form-control" id="divisionSelect" name="division_id">
                                <option value="">-- Select Division --</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
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
    document.getElementById('createZoneBtn').addEventListener('click', function() {
        document.getElementById('zoneForm').reset();
        document.getElementById('zoneForm').setAttribute('action', '{{ route('admin.zones.store') }}');
        document.getElementById('zoneForm').setAttribute('method', 'POST');
        document.getElementById('zoneModalLabel').textContent = 'Add New Zone';
        var zoneModal = new bootstrap.Modal(document.getElementById('zoneModal'));
        zoneModal.show();
    });

    // Open Edit Modal
    document.querySelectorAll('.editZoneBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            var zoneId = this.getAttribute('data-id');
            var zoneName = this.getAttribute('data-name');
            var divisionId = this.getAttribute('data-division');

            document.getElementById('zoneName').value = zoneName;
            document.getElementById('divisionSelect').value = divisionId;
            document.getElementById('zoneModalLabel').textContent = 'Edit Zone';
            document.getElementById('zoneForm').setAttribute('action',
                '{{ route('admin.zones.update', ':id') }}'.replace(':id', zoneId));
            document.getElementById('zoneForm').setAttribute('method', 'POST');

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_method';
            input.value = 'PUT';
            document.getElementById('zoneForm').appendChild(input);

            var zoneModal = new bootstrap.Modal(document.getElementById('zoneModal'));
            zoneModal.show();
        });
    });

    // Delete Zone
    document.querySelectorAll('.deleteZoneBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            var zoneId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this zone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ route('admin.zones.destroy', ':id') }}'.replace(':id', zoneId), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('zone-' + zoneId).remove();
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The zone has been deleted.',
                                icon: 'success',
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                            });
                        } else {
                            Swal.fire('Error!', 'There was an error deleting the zone.', 'error');
                        }
                    });
                }
            });
        });
    });

    // Handle Form Submit (Add/Edit)
    document.getElementById('zoneForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var submitButton = document.querySelector('#submitBtn');
        submitButton.disabled = true;

        var action = this.getAttribute('action');
        var method = this.getAttribute('method');
        var formData = new FormData(this);
        var zoneModalElement = document.getElementById('zoneModal');
        var zoneModal = bootstrap.Modal.getInstance(zoneModalElement);

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
                if (zoneModal) zoneModal.hide();

                Swal.fire({
                    title: 'Success!',
                    text: method === 'POST' ? 'Zone added successfully.' : 'Zone updated successfully.',
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

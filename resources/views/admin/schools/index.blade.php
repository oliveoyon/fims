@extends('admin.layouts.admin-layout')
@section('title', 'Schools Management')

@section('content')
<section>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <button class="btn btn-success btn-sm" id="createSchoolBtn">
                    <i class="fas fa-plus-square mr-1"></i> Add New School
                </button>
            </div>
        </div>

        <table class="table table-striped" id="schoolsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Division</th>
                    <th>Zone</th>
                    <th>District</th>
                    <th>Upazila</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Geo</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schools as $school)
                <tr id="school-{{ $school->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school->division->name }}</td>
                    <td>{{ $school->zone->name }}</td>
                    <td>{{ $school->district->name }}</td>
                    <td>{{ $school->upazila->name }}</td>
                    <td>{{ $school->address }}</td>
                    <td>{{ $school->phone }}</td>
                    <td>{{ $school->geo_location }}</td>
                    <td>
                        <span class="badge {{ $school->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $school->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm editSchoolBtn"
                                data-id="{{ $school->id }}"
                                data-name="{{ $school->name }}"
                                data-division="{{ $school->division_id }}"
                                data-zone="{{ $school->zone_id }}"
                                data-district="{{ $school->district_id }}"
                                data-upazila="{{ $school->upazila_id }}"
                                data-address="{{ $school->address }}"
                                data-phone="{{ $school->phone }}"
                                data-geo="{{ $school->geo_location }}"
                                data-active="{{ $school->is_active }}">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-sm deleteSchoolBtn"
                                data-id="{{ $school->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="schoolModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="schoolModalLabel">Add New School</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="schoolForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Division</label>
                            <select class="form-select" id="division_id" name="division_id" required>
                                <option value="">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Zone</label>
                            <select class="form-select" id="zone_id" name="zone_id" required>
                                <option value="">Select Zone</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">District</label>
                            <select class="form-select" id="district_id" name="district_id" required>
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upazila</label>
                            <select class="form-select" id="upazila_id" name="upazila_id" required>
                                <option value="">Select Upazila</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="schoolName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="schoolAddress" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="schoolPhone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Geo Location</label>
                            <input type="text" class="form-control" name="geo_location" id="schoolGeo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="is_active" id="schoolActive">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3 text-end">
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
const divisionSelect = document.getElementById('division_id');
const zoneSelect = document.getElementById('zone_id');
const districtSelect = document.getElementById('district_id');
const upazilaSelect = document.getElementById('upazila_id');

// Load dependent dropdowns
divisionSelect?.addEventListener('change', () => {
    fetch(`/admin/get-zones/${divisionSelect.value}`)
        .then(res => res.json())
        .then(data => {
            zoneSelect.innerHTML = '<option value="">Select Zone</option>';
            data.forEach(z => zoneSelect.innerHTML += `<option value="${z.id}">${z.name}</option>`);
            districtSelect.innerHTML = '<option value="">Select District</option>';
            upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
        });
});

zoneSelect?.addEventListener('change', () => {
    fetch(`/admin/get-districts/${zoneSelect.value}`)
        .then(res => res.json())
        .then(data => {
            districtSelect.innerHTML = '<option value="">Select District</option>';
            data.forEach(d => districtSelect.innerHTML += `<option value="${d.id}">${d.name}</option>`);
            upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
        });
});

districtSelect?.addEventListener('change', () => {
    fetch(`/admin/get-upazilas/${districtSelect.value}`)
        .then(res => res.json())
        .then(data => {
            upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
            data.forEach(u => upazilaSelect.innerHTML += `<option value="${u.id}">${u.name}</option>`);
        });
});

// Open Create Modal
document.getElementById('createSchoolBtn').addEventListener('click', () => {
    document.getElementById('schoolForm').reset();
    document.getElementById('schoolForm').setAttribute('action', '{{ route("admin.schools.store") }}');
    document.getElementById('schoolForm').setAttribute('method', 'POST');
    document.getElementById('schoolModalLabel').textContent = 'Add New School';
    document.querySelectorAll('input[name="_method"]').forEach(el => el.remove());
    new bootstrap.Modal(document.getElementById('schoolModal')).show();
});

// Edit
document.querySelectorAll('.editSchoolBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        const data = this.dataset;
        document.getElementById('schoolName').value = data.name;
        document.getElementById('schoolAddress').value = data.address;
        document.getElementById('schoolPhone').value = data.phone;
        document.getElementById('schoolGeo').value = data.geo;
        document.getElementById('schoolActive').value = data.active;

        // Set dropdowns
        divisionSelect.value = data.division;
        divisionSelect.dispatchEvent(new Event('change'));

        setTimeout(() => {
            zoneSelect.value = data.zone;
            zoneSelect.dispatchEvent(new Event('change'));
        }, 300);
        setTimeout(() => {
            districtSelect.value = data.district;
            districtSelect.dispatchEvent(new Event('change'));
        }, 600);
        setTimeout(() => {
            upazilaSelect.value = data.upazila;
        }, 900);

        const form = document.getElementById('schoolForm');
        form.setAttribute('action', '{{ route("admin.schools.update", ":id") }}'.replace(':id', data.id));
        form.setAttribute('method', 'POST');

        document.querySelectorAll('input[name="_method"]').forEach(el => el.remove());
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);

        new bootstrap.Modal(document.getElementById('schoolModal')).show();
    });
});

// Delete
document.querySelectorAll('.deleteSchoolBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.dataset.id;
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this school!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if(result.isConfirmed){
                fetch(`/admin/schools/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                }).then(res => res.json())
                  .then(data => {
                    if(data.success){
                        document.getElementById('school-' + id).remove();
                        Swal.fire({title:'Deleted!',text:'School deleted.',icon:'success',position:'top-end',toast:true,showConfirmButton:false,timer:2000,timerProgressBar:true});
                    }
                  });
            }
        });
    });
});

// Form Submit
document.getElementById('schoolForm').addEventListener('submit', function(e){
    e.preventDefault();
    const submitBtn = document.querySelector('#submitBtn');
    submitBtn.disabled = true;
    const action = this.getAttribute('action');
    const method = this.getAttribute('method');
    const formData = new FormData(this);

    fetch(action, {method, body: formData, headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}})
    .then(res=>res.json())
    .then(data=>{
        if(data.success){
            bootstrap.Modal.getInstance(document.getElementById('schoolModal')).hide();
            Swal.fire({title:'Success!',text:'School saved successfully.',icon:'success',position:'top-end',toast:true,showConfirmButton:false,timer:2000,timerProgressBar:true});
            setTimeout(()=>location.reload(),500);
        }else Swal.fire('Error!',data.message || 'Something went wrong!','error');
    }).catch(()=>Swal.fire('Error!','Something went wrong!','error'))
    .finally(()=>submitBtn.disabled=false);
});
</script>
@endpush

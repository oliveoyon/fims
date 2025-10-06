@extends('admin.layouts.admin-layout')

@section('title', 'Tender Management')

@section('content')
<section>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <button class="btn btn-success btn-sm" id="createTenderBtn">
                    <i class="fas fa-plus-square mr-1"></i> Add New Tender
                </button>
            </div>
        </div>

        <table class="table table-striped" id="tendersTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Component</th>
                    <th>Tenderer</th>
                    <th>Schools</th>
                    <th>Dates</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenders as $tender)
                    <tr id="tender-{{ $tender->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tender->title }}</td>
                        <td>{{ $tender->component->name ?? '-' }}</td>
                        <td>{{ $tender->tenderer->name ?? '-' }}</td>
                        <td>
                            @foreach($tender->schools as $school)
                                <span class="badge bg-info">{{ $school->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $tender->start_date }} to {{ $tender->end_date }}</td>
                        <td>
                            <span class="badge {{ $tender->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $tender->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm editTenderBtn"
                                data-id="{{ $tender->id }}"
                                data-title="{{ $tender->title }}"
                                data-component_id="{{ $tender->component_id }}"
                                data-tenderer_id="{{ $tender->tenderer_id }}"
                                data-schools="{{ $tender->schools->pluck('id')->implode(',') }}"
                                data-start_date="{{ $tender->start_date }}"
                                data-end_date="{{ $tender->end_date }}"
                                data-description="{{ $tender->description }}"
                                data-is_active="{{ $tender->is_active }}">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm deleteTenderBtn" data-id="{{ $tender->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tenderModal" tabindex="-1" aria-labelledby="tenderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tenderModalLabel">Add New Tender</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tenderForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="tenderTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="tenderTitle" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="tenderComponent" class="form-label">Component</label>
                            <select class="form-select" id="tenderComponent" name="component_id" required>
                                <option value="">Select Component</option>
                                @foreach ($components as $component)
                                    <option value="{{ $component->id }}">{{ $component->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tenderTenderer" class="form-label">Tenderer</label>
                            <select class="form-select" id="tenderTenderer" name="tenderer_id" required>
                                <option value="">Select Tenderer</option>
                                @foreach ($tenderers as $tenderer)
                                    <option value="{{ $tenderer->id }}">{{ $tenderer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tenderSchools" class="form-label">Schools</label>
                            <select class="form-select" id="tenderSchools" name="schools[]" multiple required>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tenderStartDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="tenderStartDate" name="start_date">
                        </div>

                        <div class="mb-3">
                            <label for="tenderEndDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="tenderEndDate" name="end_date">
                        </div>

                        <div class="mb-3">
                            <label for="tenderDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="tenderDescription" name="description" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tenderActive" class="form-label">Status</label>
                            <select class="form-select" id="tenderActive" name="is_active">
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
const tenderModalEl = document.getElementById('tenderModal');

// Open Create Modal
document.getElementById('createTenderBtn').addEventListener('click', function() {
    const form = document.getElementById('tenderForm');
    form.reset();
    form.setAttribute('action', '{{ route("admin.tenders.store") }}');
    form.setAttribute('method', 'POST');
    tenderModalEl.querySelector('.modal-title').textContent = 'Add New Tender';
    form.querySelectorAll('input[name="_method"]').forEach(el => el.remove());
    bootstrap.Modal.getOrCreateInstance(tenderModalEl).show();
});

// Open Edit Modal
document.querySelectorAll('.editTenderBtn').forEach(button => {
    button.addEventListener('click', function() {
        const form = document.getElementById('tenderForm');
        form.reset();
        const id = this.dataset.id;
        form.action = '{{ route("admin.tenders.update", ":id") }}'.replace(':id', id);
        form.method = 'POST';

        tenderModalEl.querySelector('.modal-title').textContent = 'Edit Tender';

        // Add _method PUT
        form.querySelectorAll('input[name="_method"]').forEach(el => el.remove());
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);

        // Fill fields
        form.querySelector('#tenderTitle').value = this.dataset.title;
        form.querySelector('#tenderComponent').value = this.dataset.component_id;
        form.querySelector('#tenderTenderer').value = this.dataset.tenderer_id;
        form.querySelector('#tenderStartDate').value = this.dataset.start_date;
        form.querySelector('#tenderEndDate').value = this.dataset.end_date;
        form.querySelector('#tenderDescription').value = this.dataset.description;
        form.querySelector('#tenderActive').value = this.dataset.is_active;

        // Multi-school select
        const schoolSelect = form.querySelector('#tenderSchools');
        const selectedSchools = this.dataset.schools.split(',');
        Array.from(schoolSelect.options).forEach(opt => {
            opt.selected = selectedSchools.includes(opt.value);
        });

        bootstrap.Modal.getOrCreateInstance(tenderModalEl).show();
    });
});

// Delete Tender
document.querySelectorAll('.deleteTenderBtn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this tender!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then(result => {
            if(result.isConfirmed){
                fetch('{{ route("admin.tenders.destroy", ":id") }}'.replace(':id', id), {
                    method: 'DELETE',
                    headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'}
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success){
                        document.getElementById('tender-'+id).remove();
                        Swal.fire({
                            title:'Deleted!',
                            text:'Tender deleted successfully.',
                            icon:'success',
                            position:'top-end',
                            toast:true,
                            showConfirmButton:false,
                            timer:2000,
                            timerProgressBar:true
                        });
                    }
                });
            }
        });
    });
});

// Form submit (Add/Edit)
document.getElementById('tenderForm').addEventListener('submit', function(e){
    e.preventDefault();
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;

    const form = this;
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST', // Always POST, Laravel reads _method
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            bootstrap.Modal.getInstance(tenderModalEl).hide();
            Swal.fire({
                title:'Success!',
                text: formData.get('_method')==='PUT'?'Tender updated successfully':'Tender added successfully',
                icon:'success',
                position:'top-end',
                toast:true,
                showConfirmButton:false,
                timer:2000,
                timerProgressBar:true
            });
            setTimeout(()=>location.reload(), 500);
        } else {
            Swal.fire('Error!', data.message || 'Something went wrong!', 'error');
        }
    })
    .catch(()=>Swal.fire('Error!','Something went wrong!','error'))
    .finally(()=>submitBtn.disabled = false);
});
</script>
@endpush

@extends('admin.layouts.admin-layout')
@section('title', 'Inspection Management')

@section('content')
<div class="container-fluid">
    <div class="mb-3">
        <button class="btn btn-success" id="createInspectionBtn">Add Inspection</button>
    </div>

    <table class="table table-bordered" id="inspectionTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Tender</th>
                <th>School</th>
                <th>Progress</th>
                <th>Status</th>
                <th>Inspector</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inspections as $inspection)
                <tr id="inspection-{{ $inspection->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $inspection->tender->title }}</td>
                    <td>{{ $inspection->school->name }}</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ $inspection->progress_percentage }}%;">
                                {{ $inspection->progress_percentage }}%
                            </div>
                        </div>
                    </td>
                    <td>{{ $inspection->work_status }}</td>
                    <td>{{ $inspection->inspector->name }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editBtn" data-id="{{ $inspection->id }}">Edit</button>
                        <button class="btn btn-info btn-sm historyBtn" data-id="{{ $inspection->id }}">History</button>
                        <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $inspection->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="inspectionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Inspection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="inspectionForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Tender</label>
                            <select name="tender_id" id="tenderSelect" class="form-select" required>
                                <option value="">Select Tender</option>
                                @foreach ($tenders as $tender)
                                    <option value="{{ $tender->id }}">{{ $tender->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>School</label>
                            <select name="school_id" id="schoolSelect" class="form-select" required>
                                <option value="">Select School</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Work Status</label>
                            <input type="text" class="form-control" name="work_status">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Progress (%)</label>
                            <input type="number" class="form-control" name="progress_percentage" min="0" max="100">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Latitude</label>
                            <input type="text" class="form-control" name="latitude">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Longitude</label>
                            <input type="text" class="form-control" name="longitude">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Images</label>
                            <input type="file" class="form-control" name="images[]" multiple>
                            <div class="col-md-12 mb-3">
                                <label>Existing Images</label>
                                <div id="existingImages" class="d-flex flex-wrap"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Videos</label>
                            <input type="file" class="form-control" name="videos[]" multiple>
                            <div class="col-md-12 mb-3">
                                <label>Existing Videos</label>
                                <div id="existingVideos" class="d-flex flex-wrap"></div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Observation</label>
                            <textarea class="form-control" name="observation"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Recommendation</label>
                            <textarea class="form-control" name="recommendation"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Work Description</label>
                            <textarea class="form-control" name="work_description"></textarea>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" id="inspectionSubmitBtn">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="historyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inspection History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="historyBody">
                <!-- History content will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('createInspectionBtn').addEventListener('click', () => {
    const form = document.getElementById('inspectionForm');
    form.reset();
    document.getElementById('existingImages').innerHTML = '';
    document.getElementById('existingVideos').innerHTML = '';
    document.getElementById('inspectionSubmitBtn').disabled = false; // enable submit
    new bootstrap.Modal(document.getElementById('inspectionModal')).show();
});

// Fetch schools by tender
document.getElementById('tenderSelect').addEventListener('change', function() {
    const tenderId = this.value;
    const schoolSelect = document.getElementById('schoolSelect');
    schoolSelect.innerHTML = '<option value="">Select School</option>';
    if (tenderId) {
        fetch('/admin/get-schools-by-tender/' + tenderId)
            .then(res => res.json())
            .then(data => {
                data.forEach(s => {
                    const opt = document.createElement('option');
                    opt.value = s.id;
                    opt.textContent = s.name;
                    schoolSelect.appendChild(opt);
                });
            });
    }
});

// Edit inspection
document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        fetch(`/admin/inspections/${id}/edit`)
            .then(res => res.json())
            .then(data => {
                const form = document.getElementById('inspectionForm');
                form.reset();
                form.querySelector('input[name=id]')?.remove();
                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'id';
                idInput.value = data.id;
                form.appendChild(idInput);

                form.querySelector('select[name=tender_id]').value = data.tender_id;
                form.querySelector('select[name=tender_id]').dispatchEvent(new Event('change'));

                setTimeout(() => {
                    form.querySelector('select[name=school_id]').value = data.school_id;
                }, 300);

                form.querySelector('input[name=work_status]').value = data.work_status;
                form.querySelector('input[name=progress_percentage]').value = data.progress_percentage;
                form.querySelector('input[name=latitude]').value = data.latitude;
                form.querySelector('input[name=longitude]').value = data.longitude;
                form.querySelector('textarea[name=observation]').value = data.observation;
                form.querySelector('textarea[name=recommendation]').value = data.recommendation;
                form.querySelector('textarea[name=work_description]').value = data.work_description;

                // Existing media
                const imageWrapper = document.getElementById('existingImages');
                imageWrapper.innerHTML = '';
                if (data.images.length) {
                    data.images.forEach(img => {
                        const el = document.createElement('img');
                        el.src = img;
                        el.style.width = '80px';
                        el.style.margin = '5px';
                        imageWrapper.appendChild(el);
                    });
                }
                const videoWrapper = document.getElementById('existingVideos');
                videoWrapper.innerHTML = '';
                if (data.videos.length) {
                    data.videos.forEach(vid => {
                        const el = document.createElement('video');
                        el.src = vid;
                        el.controls = true;
                        el.style.width = '120px';
                        el.style.margin = '5px';
                        videoWrapper.appendChild(el);
                    });
                }

                document.getElementById('inspectionSubmitBtn').disabled = false; // enable submit
                new bootstrap.Modal(document.getElementById('inspectionModal')).show();
            });
    });
});

// Delete inspection
document.querySelectorAll('.deleteBtn').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        if(!confirm('Are you sure you want to delete this inspection?')) return;

        const id = btn.dataset.id;
        fetch(`/admin/inspections/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                document.getElementById(`inspection-${id}`).remove();
                Swal.fire('Deleted!', 'Inspection has been deleted.', 'success');
            } else {
                Swal.fire('Error!', 'Something went wrong.', 'error');
            }
        });
    });
});

// Submit inspection form via AJAX with validation and double submit prevention
document.getElementById('inspectionForm').addEventListener('submit', function(e){
    e.preventDefault();
    const submitBtn = document.getElementById('inspectionSubmitBtn');
    submitBtn.disabled = true; // prevent double submit

    const formData = new FormData(this);

    fetch('/admin/inspections', {
        method: 'POST',
        body: formData
    })
    .then(async res => {
        if(res.status === 422){
            const errorData = await res.json();
            let msg = '';
            Object.values(errorData.errors).forEach(arr => arr.forEach(e=>msg += e + '<br>'));
            Swal.fire({icon:'error', title:'Validation Error', html: msg});
            submitBtn.disabled = false;
        } else if(res.ok){
            return res.json();
        } else {
            throw new Error('Something went wrong');
        }
    })
    .then(data => {
        if(data && data.success){
            new bootstrap.Modal(document.getElementById('inspectionModal')).hide();
            Swal.fire('Success!', 'Inspection saved successfully.', 'success').then(()=> location.reload());
        }
    })
    .catch(err => {
        Swal.fire('Error!', err.message, 'error');
        submitBtn.disabled = false;
    });
});

// History button
document.querySelectorAll('.historyBtn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const historyBody = document.getElementById('historyBody');
        historyBody.innerHTML = '<p>Loading...</p>';

        fetch(`/admin/inspections/${id}/history`)
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    historyBody.innerHTML = '<p>No history found.</p>';
                    return;
                }

                let html = '';
                data.forEach((ins, index) => {
                    html += `
<div class="card mb-3">
    <div class="card-header">
        Inspection #${index+1} | ${ins.created_at}
    </div>
    <div class="card-body row">
        <div class="col-md-6 mb-2"><strong>Work Status:</strong> ${ins.work_status}</div>
        <div class="col-md-6 mb-2"><strong>Progress:</strong>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: ${ins.progress_percentage}%" aria-valuenow="${ins.progress_percentage}" aria-valuemin="0" aria-valuemax="100">${ins.progress_percentage}%</div>
            </div>
        </div>
        <div class="col-md-12 mb-2"><strong>Description:</strong> ${ins.work_description}</div>
        <div class="col-md-12 mb-2"><strong>Observation:</strong> ${ins.observation}</div>
        <div class="col-md-12 mb-2"><strong>Recommendation:</strong> ${ins.recommendation}</div>
        <div class="col-md-12 mb-2"><strong>Images:</strong><br>${ins.images.map(img=>`<img src="${img}" style="width:80px;margin:5px;">`).join('')}</div>
        <div class="col-md-12 mb-2"><strong>Videos:</strong><br>${ins.videos.map(vid=>`<video src="${vid}" controls style="width:120px;margin:5px;"></video>`).join('')}</div>
        <div class="col-md-6 mb-2"><strong>Latitude:</strong> ${ins.latitude}</div>
        <div class="col-md-6 mb-2"><strong>Longitude:</strong> ${ins.longitude}</div>
    </div>
</div>`;
                });

                historyBody.innerHTML = html;
                new bootstrap.Modal(document.getElementById('historyModal')).show();
            });
    });
});
</script>
@endpush

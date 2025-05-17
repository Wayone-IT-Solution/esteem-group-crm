<table id="daparmentTable" class="table table-striped table-bordered">
    <thead class="bg-light">
        <tr class="b-b-primary">
            <th class="text-center">Sr.No</th>
            <th>Company Name</th>
            <th>Department</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $department)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $department->company->name ?? '' }}</td>
            <td>{{ $department->department }}</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                    <button type="button"
                        class="btn btn-sm btn-warning edit-department-btn"
                        data-id="{{ $department->id }}"
                        data-department="{{ $department->department }}"
                        data-company-id="{{ $department->company_id }}"
                        data-update-url="{{ route('department.update', $department->id) }}">
                        <i class="fa-solid fa-pen"></i>
                    </button>

                    <button type="submit" class="btn btn-sm btn-danger" onclick="CommanDelete('delete','departments','{{ $department->id }}')">
                        <i class="fa-solid fa-trash" style="font-size: 14px;"></i>
                    </button>

                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>

     $(function() {
        $('.edit-department-btn').on('click', function() {
            $('#editDepartmentId').val($(this).data('id'));
            $('#editCompanyName').val($(this).data('company-id'));
            $('#editDepartmentName').val($(this).data('department'));
            $('#editDepartmentForm').attr('action', $(this).data('update-url'));
            $('#editDepartmentModal').modal('show');
        });

        $('#addDepartmentForm').on('submit', function(e) {
            e.preventDefault();
            const $btn = $('#addSubmitBtn');
            $btn.prop('disabled', true);
            $('#addSubmitText').addClass('d-none');
            $('#addSubmitSpinner').removeClass('d-none');

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function() {

                    Swal.fire({
                        title: 'Success!',
                        text: 'Department added successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = window.location.href;
                    });
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON?.errors;
                    const errorMsg = errors ? Object.values(errors).flat().join('<br>') :
                        'Something went wrong!';
                    showToast(errorMsg, 'error');
                },
                complete: function() {
                    $btn.prop('disabled', false);
                    $('#addSubmitText').removeClass('d-none');
                    $('#addSubmitSpinner').addClass('d-none');
                }
            });
        });

        $('#editDepartmentForm').on('submit', function(e) {
            e.preventDefault();
            const $btn = $('#editSubmitBtn');
            $btn.prop('disabled', true);
            $('#editSubmitText').addClass('d-none');
            $('#editSubmitSpinner').removeClass('d-none');

            const formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    showToast1('Department updated successfully.');
                    setTimeout(() => {
                        $('#editDepartmentModal').modal('hide');
                        location.reload();
                    }, 2000);
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON?.errors;
                    const errorMsg = errors ? Object.values(errors).flat().join('<br>') :
                        'Something went wrong!';
                    showToast(errorMsg, 'error');
                },
                complete: function() {
                    $btn.prop('disabled', false);
                    $('#editSubmitText').removeClass('d-none');
                    $('#editSubmitSpinner').addClass('d-none');
                }
            });
        });


    });
</script>
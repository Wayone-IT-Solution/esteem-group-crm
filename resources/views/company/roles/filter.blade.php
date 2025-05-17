 <table id="rolesTable" class="table table-striped table-bordered">
     <thead class="bg-light">
         <tr class="b-b-primary">
             <th class="text-center">Sr.No</th>
             <th>Company Name</th>
             <th>Role Name</th>
             <th class="text-center">Actions</th>
         </tr>
     </thead>
     <tbody>
         @foreach ($roles as $key=> $role)
         <tr>
             <td class="text-center">{{ ++$key }}</td>
             <td>{{ $role->company->name ?? '' }}</td>
             <td>{{ $role->role }}</td>
             <td class="text-center">
                 <div class="d-flex justify-content-center gap-2">
                     <button type="button" class="btn btn-sm btn-warning edit-role-btn"
                         data-id="{{ $role->id }}" data-role="{{ $role->role }}"
                         data-company-id="{{ $role->company_id }}"
                         data-name="{{ $role->name }}"
                         data-update-url="{{ route('role.update', $role->id) }}">
                         <i class="fa-solid fa-pen"></i>
                     </button>
                      <button type="submit" class="btn btn-sm btn-danger" onclick="CommanDelete('delete','roles','{{ $role->id }}')">
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
        $('.edit-role-btn').on('click', function() {
            $('#editRoleId').val($(this).data('id'));
            $('#editCompanyName').val($(this).data('company-id'));
            $('#editRoleName').val($(this).data('role'));
            $('#editRoleDisplayName').val($(this).data('name'));
            $('#editRoleForm').attr('action', $(this).data('update-url'));
            $('#editRoleModal').modal('show');
        });

        $('#addRoleForm').on('submit', function(e) {
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
                        text: 'Role added successfully',
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

        $('#editRoleForm').on('submit', function(e) {
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
                     Swal.fire({
                        title: 'Success!',
                        text: 'Role updated successfully',
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
                    $('#editSubmitText').removeClass('d-none');
                    $('#editSubmitSpinner').addClass('d-none');
                }
            });
        });

       
    });
 </script>
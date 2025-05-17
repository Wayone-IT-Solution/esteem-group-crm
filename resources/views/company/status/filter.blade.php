 <table id="statusTable" class="table table-striped table-bordered">
     <thead class="bg-light">
         <tr class="b-b-primary">
             <th class="text-center">Sr.No</th>
             <th>Company Name</th>
             <th>Status</th>
             <th class="text-center">Actions</th>
         </tr>
     </thead>
     <tbody>
         @foreach ($status as $statusItem)
         <tr>
             <td class="text-center">{{ $loop->iteration }}</td>
             <td>{{ $statusItem->company->name ?? '' }}</td>
             <td>{{ $statusItem->status }}</td>
             <td class="text-center">
                 <div class="d-flex justify-content-center gap-2">
                     <button type="button"
                         class="btn btn-sm btn-warning edit-department-btn"
                         data-id="{{ $statusItem->id }}"
                         data-status="{{ $statusItem->status }}"
                         data-company-id="{{ $statusItem->company_id }}"
                         data-update-url="{{ route('status.update', $statusItem->id) }}">
                         <i class="fa-solid fa-pen"></i>
                     </button>

                     <button type="submit" class="btn btn-sm btn-danger" onclick="CommanDelete('delete','status','{{ $statusItem->id }}')">
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
             $('#editStatusName').val($(this).data('status'));
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
                         text: 'Status added successfully',
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
                     Swal.fire({
                         title: 'Success!',
                         text: 'Status updated successfully',
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
 <table id="usersTable" class="table table-striped table-bordered">
     <thead class="bg-light">
         <tr class="b-b-primary">
             <th>Sr.N</th>
             <th>Name</th>
             <th>Email</th>
             <th>Company</th>
             <th>Designation</th>
             <th>Phone</th>
             <th>Address</th>
             <th>Action</th>
         </tr>
     </thead>
     <tbody>
         @foreach ($users as $user)
         <tr>
             <td>{{ $loop->iteration }}</td>
             <td><i class="fa-solid fa-user text-primary"></i> <small>{{ $user->name ?? '' }}</small></td>
             <td><i class="fa-solid fa-envelope text-secondary"></i> <small>{{ $user->email }}</small></td>
             <td><i class="fa-solid fa-building text-info"></i> <small>{{ $user->company->name }}</small></td>
             <td><i class="fa-solid fa-briefcase text-success"></i> <small>{{ ucfirst($user->role) }}</small></td>
             <td><i class="fa-solid fa-phone text-warning"></i> <small>{{ $user->mobile_number }}</small></td>
             <td><i class="fa-solid fa-location-dot text-danger"></i> <small>{{ $user->address }}</small></td>
             <td>
                 <div class="d-flex justify-content-center gap-1">
                     <!-- View Info Button -->
                     <button class="btn btn-sm btn-info show-user-info" data-bs-toggle="offcanvas"
                         data-bs-target="#userInfoCanvas"
                         data-name="{{ $user->name  ?? ''}}"
                         data-email="{{ $user->email }}"
                         data-company="{{ $user->company->name }}"
                         data-role="{{ ucfirst($user->role) }}"
                         data-phone="{{ $user->mobile_number }}"
                         data-address="{{ $user->address }}"
                         title="View Info">
                         <i class="fa-solid fa-eye" style="font-size: 14px;"></i>
                     </button>

                     <!-- Edit Button -->
                     <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-sm btn-warning edit-company-btn"
                         data-id="{{ $user->id }}"
                         data-name="{{ $user->name }}"
                         data-update-url="{{ route('company.update', $user->id) }}">
                         <i class="fa-solid fa-pen" style="font-size: 14px;"></i>
                     </a>

                     <!-- Delete Button -->
                     <button type="submit" class="btn btn-sm btn-danger" onclick="CommanDelete('delete','users','{{ $user->id }}')">
                         <i class="fa-solid fa-trash" style="font-size: 14px;"></i>
                     </button>
                 </div>
             </td>

         </tr>
         @endforeach
     </tbody>
 </table>
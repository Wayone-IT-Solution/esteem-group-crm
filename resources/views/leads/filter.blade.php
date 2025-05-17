 <table id="leadsTable" class="table table-bordered table-striped">
                <thead class="bg-light">
                    <tr>
                        <th>SNO.</th>
                        <th>Lead Id</th>
                        <th>Lead Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Creatd At</th>
                        <th>Assigned To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> <a href="{{ route('admin.leads.edit', $lead->id) }}">{{ $lead->unique_id }}</a></td>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->company->name ?? 'N/A' }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->mobile_number }}</td>
                        <td>{{ $lead->address }}</td>
                        <td>{{ $lead->description }}</td>
                        <td>{{ $lead->source }}</td>
                        <td>
                            <span class="badge bg-{{ $lead->status == 'converted' ? 'success' : ($lead->status == 'contacted' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($lead->status) }}
                            </span>
                        </td>
                        <td>{{ date('d-m-Y', strtotime($lead->created_at)) }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                @if(!empty($lead->assinges))
                                @foreach ($lead->assinges as $list)
                                @php
                                $user = DB::table('users')->where('id', $list->user_id)->first();
                                $initials = $user ? strtoupper(substr($user->name, 0, 1)) : '?';
                                @endphp
                                <div class="assigned-avatar" data-bs-toggle="tooltip" title="{{ $user->name ?? 'N/A' }}">
                                    {{ $initials }}
                                </div>
                                @endforeach
                                @else
                                <div class="assigned-avatar bg-secondary" data-bs-toggle="tooltip" title="Unassigned">?</div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">

                                <a href="{{ route('admin.leads.edit', $lead->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="CommanDelete('delete', 'lead_models', '{{ $lead->id }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
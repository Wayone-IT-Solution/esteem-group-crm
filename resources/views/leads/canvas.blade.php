<table class="table table-bordered table-striped table-hover">
            <thead class=" text-center" style="background-color: #26477a;color:white">
                <tr>
                    <th  style="color:white;">Sno.</th>
                    <th style="color:white;">Intracted Employee</th>
                    <th style="color:white;">Date / Day</th>
                    <th style="color:white;">Comment</th>
                    <th style="color:white;">Next Follow Up Date</th>
                    <th style="color:white;"> Status</th>
                </tr>
            </thead>
            <tbody>
               
                @if(!empty($leadCon))
                @foreach ($leadCon as $key=> $list )
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $list->user->name ?? '' }}</td>
                        <td>{{ date('d-m-Y' , strtotime($list->created_at))}}</td>
                        <td>{{ $list->description }}</td>
                        <td>{{ $list->next_followup }}</td>
                        <td>{{ $list->status }}</td>
                    </tr>
                
                @endforeach

                @endif()
            </tbody>
        </table>
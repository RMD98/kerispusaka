@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Daftar Ticket</h3>
        <a href="{{route('ticket.create')}}"
           class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
            + Add Ticket
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 border rounded">
            <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Id</th>
                    <th class="px-4 py-2 border-b">Id Pelapor</th>
                    <th class="px-4 py-2 border-b">Pelapor</th>
                    <th class="px-4 py-2 border-b">Id Petugas</th>
                    <th class="px-4 py-2 border-b">Petugas</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th></th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $value)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_ticket }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_user }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->pelapor }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_staff }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->petugas }}</td>
                        <td class="px-4 py-2 border-b">
                            @if ($value->status == 'Pending') 
                                <span class="text-yellow-500 font-semibold">Pending</span>
                             @elseif ($value->status == 'In Progress') 
                                <span class="text-blue-500 font-semibold">In Progress</span>
                             @elseif ($value->status == 'Resolved') 
                                <span class="text-green-500 font-semibold">Resolved</span>
                             @elseif ($value->status == 'Closed') 
                                <span class="text-gray-500 font-semibold">Closed</span>
                            
                            @endif
                        </td>
                        <td class="px-4 py-2 border-b">
                            @if ($value->status == 'Pending') 
                                <a href="#" onclick="updateStatus('{{$value->id_ticket}}','In Progress')" class="btn-secondary btn">Accept</a>
                             @elseif ($value->status == 'In Progress') 
                                <a href="#" onclick="updateStatus('{{$value->id_ticket}}','Resolved')" class="btn-success btn ">Done</a>
                            @endif
                        </td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{route('ticket.edit', $value->id_ticket)}}" class="text-blue-600 hover:underline">Edit</a>
                            |
                            <form action="{{ route('ticket.destroy',$value->id_ticket)}}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                    <!-- <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                    </tr> -->
            </tbody>
        </table>
    </div>
</div>

@stop
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function updateStatus(id, status) {
        $.ajax({
            url: "{{route('ticket.updateStatus')}}",
            type: "POST",
            data: {
                id : id,
                status: status,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                Swal.fire({
                        icon: 'success',
                        title: 'SUCCESS!',
                        text: response.message ?? 'Status updated successfully!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                setTimeout(function(){
                        location.reload();
                },1000);
            },
            error: function(xhr, status, error) {
                console.error('Error updating status:', error);
                alert('Failed to update status.');
            }
        });
    }
</script>
@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Daftar Petugas</h3>
        <a href="/add_staff"
           class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
            + Add User
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 border rounded">
            <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Id</th>
                    <th class="px-4 py-2 border-b">Nama</th>
                    <th class="px-4 py-2 border-b">Telepon</th>
                    <th class="px-4 py-2 border-b">Surat Izin</th>
                    <th class="px-4 py-2 border-b">Asal</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $value)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_staff }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->nama }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->no_hp }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->surat_izin }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->asal }}</td>
                        <td class="px-4 py-2 border-b">
                            
                            <a href="/edit_staff/{{$value->id_staff}}" class="text-blue-600 hover:underline">Edit</a>
                            |
                            <form action="{{ route('staff.destroy',$value->id_staff)}}" method="POST" class="inline">
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
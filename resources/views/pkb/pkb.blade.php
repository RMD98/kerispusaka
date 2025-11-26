@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Daftar Pemeriksaan Kebuntingan</h3>
        <a href="/add_pkb"
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
                    <th class="px-4 py-2 border-b">No Dokumen</th>
                    <th class="px-4 py-2 border-b">Kejadian</th>
                    <th class="px-4 py-2 border-b">IB</th>
                    <th class="px-4 py-2 border-b">Petugas Penanggugn Jawab</th>
                    <!-- <th class="px-4 py-2 border-b">Status</th> -->
                    <th class="px-4 py-2 border-b">Keterangan</th>
                    <th class="px-4 py-2 border-b">Tanggal Dibuat</th>
                    <th class="px-4 py-2 border-b">Tanggal Diperbarui</th>
                </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach ($data as $index => $value)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->no_dokumen }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_kejadian }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_ib }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_staff }}</td>
                        <!-- <td class="px-4 py-2 border-b">{ $value->status }}</td> -->
                        <td class="px-4 py-2 border-b">{{ $value->created_at }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->updated_at }}</td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('pkb.edit', $value->id_pkb)}}" class="text-blue-600 hover:underline">Edit</a>
                            |
                            <form action="{{ route('pkb.destroy', $value->id_pkb) }}" method="POST" class="inline">
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
            </tbody>
        </table>
    </div>
</div>

@stop
@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Daftar Kejadian</h3>
        @if(Auth::user()->role != 'peternak'):
            <a href="{{route('kejadian.create')}}"
            class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                + Add Kejadian
            </a>
        @endif
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 border rounded">
            <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Peternak</th>
                    <th class="px-4 py-2 border-b">Betina</th>
                    <th class="px-4 py-2 border-b">Hasil</th>
                    <th class="px-4 py-2 border-b">Tanggal Bibuat</th>
                    <th class="px-4 py-2 border-b">Tanggal Diperbarui</th>
                </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach ($data as $index => $value)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_peternak }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_betina }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->status }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->created_at }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->updated_at }}</td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{route('kejadian.show',$value->id_kejadian)}}" class="text-green-600 hover:underline">Detail</a>
                            |
                            <a href="{{route('kejadian.edit',$value->id_kejadian)}}" class="text-blue-600 hover:underline">Edit</a>
                            |
                            <form action="{{route('kejadian.destroy',$value->id_kejadian)}}" method="POST" class="inline">
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
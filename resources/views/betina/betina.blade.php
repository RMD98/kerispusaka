@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Daftar Sapi Betina</h3>
        <a href="/add_betina"
           class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
            + Add Betina
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 border rounded">
            <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">EARTAG</th>
                    <th class="px-4 py-2 border-b">Peternak</th>
                    <th class="px-4 py-2 border-b">Nama</th>
                    <th class="px-4 py-2 border-b">Jenis</th>
                    <th class="px-4 py-2 border-b">Lahir</th>
                    <th class="px-4 py-2 border-b">Usia</th>
                    <th class="px-4 py-2 border-b">Jumalah Ib</th>
                    <th class="px-4 py-2 border-b">Riwayat Penyakit</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Foto</th>
                    <th class="px-4 py-2 border-b"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $value)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->ear_tag }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_peternak }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->nama }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->jenis_sapi }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->tanggal_lahir }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->usia }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->jumlah_ib }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->riwayat_penyakit }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->status }}</td>
                        <td class="px-4 py-2 border-b">
                            @if($value->foto)
                                <button onclick="window.open('{{ asset($value->foto) }}', '_blank')"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                                    View Foto
                                </button>
                            @else
                                No Foto
                            @endif
                            </td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('betina.edit', $value->ear_tag)}}" class="text-blue-600 hover:underline">Edit</a>
                            |
                            <form action="{{ route('betina.destroy', $value->ear_tag) }}" method="POST" class="inline">
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
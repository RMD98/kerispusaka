<style>
    thead th {
        background-color: #f3f4f6; /* Warna latar belakang abu-abu muda */
    }
</style>

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
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ticket as $index => $value)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_ticket }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_user }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->pelapor }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_staff }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->petugas }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->status }}</td>
                    
                    </tr>
                @endforeach
                    <!-- <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                    </tr> -->
            </tbody>
        </table>
    </div>
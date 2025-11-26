<!DOCTYPE html>
<html>
<head>
    <title>Report {{ $data->id_kejadian }}</title>
    <style>
        .printable, .printable th, .printable td {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            text-align: center;
        }
    </style>
        <!-- <link href="{{public_path('/css/sb-admin-2.min.css')}}" rel="stylesheet"> -->

</head>
<body>
    <div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Data Kejadian {{$data->id_kejadian}}</h2>
        <a href="/print_pdf/{{$data->id_kejadian}}"
           class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
        </a>
    </div>
    <hr class="my-4 border-t-2 border-gray-400">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Data Kejadian</h3>
    </div>
    <div class="row mt-2">
        <table>
            <tr>
                <td>Id Peternak </td>
                <td>: {{$data->id_peternak}}</td>
            </tr>
            <tr>
                <td>Id Betina </td>
                <td>: {{$data->id_betina}}</td>
            </tr>
            <tr>
                <td>Status </td>
                <td>: {{$data->status}}</td>
            </tr>
            <tr>
                <td>Tanggal Dibuat </td>
                <td>: {{$data->created_at}}</td>
            </tr>
            <tr>
                <td>Tanggal Diperbarui </td>
                <td>: {{$data->updated_at}}</td>
            </tr>
        </table>
    </div>
    <hr class="my-4 border-t-2 border-gray-400">
    <table width="100%" style="border-collapse: collapse;">
        <tr>
            <!-- Data Peternak -->
            <td width="50%" valign="top" style="padding-right: 20px;">
                <h3 style="font-size:16px; font-weight:bold; margin-bottom:10px;">Data Peternak</h3>
                <table width="100%" style="border-collapse: collapse;">
                    <tr>
                        <td>Id Peternak</td>
                        <td>: {{ $peternak->id_peternak }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $peternak->nama }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $peternak->alamat }}</td>
                    </tr>
                    <tr>
                        <td>NO HP</td>
                        <td>: {{ $peternak->no_hp }}</td>
                    </tr>
                </table>
            </td>

            <!-- Data Sapi -->
            <td width="50%" valign="top" style="padding-left: 20px;">
                <h3 style="font-size:16px; font-weight:bold; margin-bottom:10px;">Data Sapi</h3>
                <table width="100%" style="border-collapse: collapse;">
                    <tr>
                        <td>Ear Tag</td>
                        <td>: {{ $betina->ear_tag }}</td>
                    </tr>
                    <tr>
                        <td>Nama Sapi</td>
                        <td>: {{ $betina->nama }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ $betina->tanggal_lahir }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <hr class="my-4 border-t-2 border-gray-400">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Data Inseminasi Buatan</h3>
    </div>
    <div class="row mt-2">
        <table class="min-w-full text-sm text-left text-gray-700 border rounded printable">
            <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Petugas</th>
                    <th class="px-4 py-2 border-b">Pejantan (Straw)</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Tanggal Dibuat</th>
                    <th class="px-4 py-2 border-b">Tanggal Diperbarui</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ib as $index => $value)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_staff }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->pejantan }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->hasil }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->created_at }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->updated_at }}</td>
                    </tr>
                @endforeach
                    <!-- <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                    </tr> -->
            </tbody>
        </table>
    </div>
    <hr class="my-4 border-t-2 border-gray-400">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Data Pengecekan Kebuntingan</h3>
    </div>
    <div class="row mt-2">
        <table class="min-w-full text-sm text-left text-gray-700 border rounded printable">
            <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Petugas</th>
                    <th class="px-4 py-2 border-b">IB</th>
                    <th class="px-4 py-2 border-b">No Dokumen</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Keterangan</th>
                    <th class="px-4 py-2 border-b">Tanggal Dibuat</th>
                    <th class="px-4 py-2 border-b">Tanggal Diperbarui</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pkb as $index => $value)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_staff }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_ib }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->no_dokumen }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->hasil }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->keterangan }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->created_at }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->updated_at }}</td>
                    </tr>
                @endforeach
                    <!-- <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                    </tr> -->
            </tbody>
        </table>
    </div>
    <hr class="my-4 border-t-2 border-gray-400">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Data Kelahiran</h3>
    </div>
    <div class="row mt-2">
        <table class="min-w-full text-sm text-left text-gray-700 border rounded printable">
            <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Petugas</th>
                    <!-- <th class="px-4 py-2 border-b">PKB</th> -->
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Keunggulan</th>
                    <th class="px-4 py-2 border-b">Tanggal Dibuat</th>
                    <th class="px-4 py-2 border-b">Tanggal Diperbarui</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelahiran as $index => $value)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_staff }}</td>
                        <!-- <td class="px-4 py-2 border-b">{ $value->id_pkb }}</td> -->
                        <td class="px-4 py-2 border-b">{{ $data->status }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->keunggulan }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->created_at }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->updated_at }}</td>
                    </tr>
                @endforeach
                    <!-- <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                    </tr> -->
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
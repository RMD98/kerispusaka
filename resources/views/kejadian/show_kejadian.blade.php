@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Data Kejadian {{$data->id_kejadian}}</h2>
        <a href="{{ route('print.pdf', $data->id_kejadian) }}" target="_blank"
            onclick="setTimeout(() => { window.location.href='{{ route('print.pdf', [$data->id_kejadian, 'download' => 1]) }}'; }, 1000)"
           class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition" >
           <i class="fa fa-print" aria-hidden="true"></i> Print to PDF
        </a>
    </div>
    <hr class="my-4 border-t-2 border-gray-400">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Data Kejadian</h3>
    </div>
    <div class="dt-kej row mt-2">
        <div class="col-2 ">
            <p>Id Peternak </p>
            <p>Id Betina </p>
            <p>Status </p>
            <p>Tanggal Dibuat </p>
            <p>Tanggal Diperbarui </p>
        </div>
        <div class="col-2">
            <p> : {{$data->id_peternak}}</p>
            <p> : {{$data->id_betina}}</p>
            <p> : {{$data->status}}</p>
            <p> : {{$data->created_at}}</p>
            <p> : {{$data->updated_at}}</p>
        </div>
    </div>
    <hr class="my-4 border-t-2 border-gray-400">
    <div class="row">
        <div class="col-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Data Peternak</h3>
            </div>
            <div class="dt-kej row mt-2">
                <div class="col-4 ">
                    <p>Id Peternak </p>
                    <p>Nama </p>
                    <p>Alamat </p>
                    <p>NO HP</p>
                </div>
                <div class="col-4">
                    <p> : {{$peternak->id_peternak}}</p>
                    <p> : {{$peternak->nama}}</p>
                    <p> : {{$peternak->alamat}}</p>
                    <p> : {{$peternak->no_hp}}</p>
                </div>
            </div>
        </div>
         <div class="col-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Data Sapi </h3>
            </div>
            <div class="dt-kej row mt-2">
                <div class="col-4 ">
                    <p>Ear Tag</p>
                    <p>Nama Sapi</p>
                    <p>Tanggal Lahir</p>
                    
                </div>
                <div class="col-4">
                    <p> : {{$betina->ear_tag}}</p>
                    <p> : {{$betina->nama}}</p>
                    <p> : {{$betina->tanggal_lahir}}</p>
                    
                </div>
            </div>
        </div>
    </div>
    <hr class="my-4 border-t-2 border-gray-400">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Data Inseminasi Buatan</h3>
        <a href="/add_ib/{{$data->id_kejadian}}"
           class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
            + Add Inseminasai
        </a>
    </div>
    <div class="dt-kej row mt-2">
        <table class="min-w-full text-sm text-left text-gray-700 border rounded">
            <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Petugas Penanggung Jawab</th>
                    <th class="px-4 py-2 border-b">Pejantan (Straw)</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Tanggal Dibuat</th>
                    <th class="px-4 py-2 border-b">Tanggal Diperbarui</th>
                </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach ($ib as $index => $value)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->id_staff }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->pejantan }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->hasil }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->created_at }}</td>
                        <td class="px-4 py-2 border-b">{{ $value->updated_at }}</td>
                        <td class="px-4 py-2 border-b">
                            @if(Auth::user()->role=='peternak')
                                @if($value->status == 'Belum Ada Tindakan')
                                    <a href="#" onclick="sendWhatsAppMessage()" class="text-blue-600 hover:underline">Kirim Pengingat</a>
                                    |
                                @endif
                            @endif
                            <a href="{{route('ib.edit',$value->id_ib)}}" class="text-blue-600 hover:underline">Edit</a>
                            |
                            <form action="{{ route('ib.destroy', $value->id_ib) }}" method="POST" class="inline">
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
    <hr class="my-4 border-t-2 border-gray-400">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Data Pengecekan Kebuntingan</h3>
        <a href="/add_pkb/{{$data->id_kejadian}}"
           class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
            + Add PKB
        </a>
    </div>
    <div class="dt-kej row mt-2">
        <table class="min-w-full text-sm text-left text-gray-700 border rounded">
            <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Petugas Penanggung Jawab</th>
                    <th class="px-4 py-2 border-b">IB</th>
                    <th class="px-4 py-2 border-b">No Dokumen</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Keterangan</th>
                    <th class="px-4 py-2 border-b">Tanggal Dibuat</th>
                    <th class="px-4 py-2 border-b">Tanggal Diperbarui</th>
                </tr>
            </thead>
            <tbody>
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
                        <td class="px-4 py-2 border-b">
                            @if(Auth::user()->role=='peternak')
                                @if($value->status == 'Belum Ada Tindakan')
                                    <a href="#" onclick="sendWhatsAppMessage()" class="text-blue-600 hover:underline">Kirim Pengingat</a>
                                    |
                                @endif
                            @endif
                            <a href="{{route('pkb.edit',$value->id_pkb)}}" class="text-blue-600 hover:underline">Edit</a>
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
    <hr class="my-4 border-t-2 border-gray-400">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Data Kelahiran</h3>
        <a href="/add_kelahiran/{{$data->id_kejadian}}"
           class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
            + Add Kelahiran
        </a>
    </div>
    <div class="dt-kej row mt-2">
        <table class="min-w-full text-sm text-left text-gray-700 border rounded">
            <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Petugas Penanggung Jawab</th>
                    <!-- <th class="px-4 py-2 border-b">PKB</th> -->
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Keunggulan</th>
                    <th class="px-4 py-2 border-b">Tanggal Dibuat</th>
                    <th class="px-4 py-2 border-b">Tanggal Diperbarui</th>
                </tr>
            </thead>
            <tbody>
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
                        <td class="px-4 py-2 border-b">
                            @if(Auth::user()->role=='peternak')
                                @if($value->status == 'Belum Ada Tindakan')
                                    <a href="#" onclick="sendWhatsAppMessage()" class="text-blue-600 hover:underline">Kirim Pengingat</a>
                                    |
                                @endif
                            @endif
                            <a href="{{route('kelahiran.edit',$value->id_kelahiran)}}" class="text-blue-600 hover:underline">Edit</a>
                            |
                            <form action="{{ route('kelahiran.destroy', $value->id_kelahiran) }}" method="POST" class="inline">
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
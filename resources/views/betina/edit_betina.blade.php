@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Edit Sapi Betina</h3>
    </div>

    {{-- Form --}}
    <div class="overflow-x-auto">
        <form action="{{route('betina.update', $data->ear_tag)}}" method="POST" class="flex-1 overflow-auto space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="eartag" class="block text-sm font-medium text-gray-700">Eartag</label>
                <input type="text" name="eartag" id="eartag" required value="{{$data->ear_tag}}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" required value="{{$data->nama}}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="peternak" class="block text-sm font-medium text-gray-700">Peternak</label>
                <select id="peternak" name="peternak" class="w-full rounded-lg shadow-sm border border-gray-300">
                    <!-- Options loaded by AJAX -->
                     <option value="{{$data->id_peternak}}">{{$data->id_peternak}}</option>
                </select>
            </div>

            <div>
                <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
                <input type="text" name="jenis" id="jenis" required value="{{$data->jenis_sapi}}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Lahir</label>
                <input type="date" name="tanggal" id="tanggal" required value="{{date('Y-m-d',strtotime($data->tanggal_lahir))}}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="jumlah_ib" class="block text-sm font-medium text-gray-700">Jumlah Ib</label>
                <input type="number" name="jumlah_ib" id="jumlah_ib" required value="{{$data->jumlah_ib}}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="riwayat" class="block text-sm font-medium text-gray-700">Riwayat Penyakit</label>
                <input type="text" name="riwayat" id="riwayat" required value="{{$data->riwayat_penyakit}}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status">
                    <option {{$data->status =='BOLEH IB' ? ' selected ' : ''}} value="BOLEH IB" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">BOLEH IB</option>
                    <option {{$data->status =='TIDAK BOLEH IB' ? ' selected ' : ''}} value="TIDAK BOLEH IB">TIDAK BOLEH IB</option>
                </select>
                <!-- <input type="text" name="riwayat" id="riwayat" required
                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500"> -->
            </div>
            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700">FOTO SAPI</label>
                @if($data->foto)
                    <!-- <img src="{{asset($data->foto)}}" alt="" srcset=""> -->
                    <button onclick="window.open('{{ asset($data->foto) }}', '_blank')"
                            class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                        View Foto
                    </button>

                @endif
                <input type="file" name="foto" id="foto" 
                   class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                

            </div>

            <div class="pt-4">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                    Update Betina
                </button>
            </div>
        </form>
    </div>
</div>

@stop
<!-- Select2 CSS & JS -->

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#peternak').select2({
        placeholder: 'Cari peternak...',
        minimumInputLength: 0,
        ajax: {
            url: '{{route('peternak.search')}}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search input
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(item => ({
                        id: item.id_peternak,
                        text: item.text
                    }))
                };
            },
            cache: true
        },
    });
});
</script>

@endpush

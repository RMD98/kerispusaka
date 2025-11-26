@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">User List</h3>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
    <form action="{{ route('pkb.update', $data->id_pkb) }}" method="POST" class="flex-1 overflow-auto space-y-6">
                @csrf
                @method('PUT')
                    <input type="hidden" name="id" value="{{$data->id_pkb}}" readonly>
                <div>
                    <label for="kejadian" class="block text-sm font-medium text-gray-700">Id Kejadian</label>
                    <input type="text" name="kejadian" id="kejadian" readonly value="{{$data->id_kejadian}}"
                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" value="{{request()->route('id')}}">
                </div>
                
                <div>
                    <label for="ib" class="block text-sm font-medium text-gray-700">Id IB</label>
                    <select id="ib" name="ib" class="w-full rounded-lg shadow-sm border border-gray-300">
                        <option value="{{$data->id_ib}}" selected>{{$data->id_ib}}</option>

                    </select>
                </div>

                <div>
                    <label for="dokumen" class="block text-sm font-medium text-gray-700">No Dokumen</label>
                    <input type="text" name="dokumen" id="dokumen" placeholder="No Dokumen" required value="{{$data->no_dokumen}}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="staff" class="block text-sm font-medium text-gray-700">Petugas Penanggung Jawab</label>
                    <select id="staff" name="staff" class="w-full rounded-lg shadow-sm border border-gray-300">
                        <option value="{{$data->id_staff}}" selected>{{$data->id_staff}}</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <!-- <input type="text" name="status" id="status"
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" value ="Belum Ada Tindakan"> -->
                    <select id="status" name="status" class="w-full rounded-lg shadow-sm border border-gray-300">
                        <option value="Belum Ada Tindakan"  {{$data->hasil == 'Belum Ada Tindakan' ? ' selected ' : '' }}>Belum Ada Tindakan</option>
                        <option value="sukses" {{$data->hasil == 'sukses' ? ' selected ' : '' }}>PKB Berhasil</option>
                        <option value="gagal"  {{$data->hasil == 'gagal' ? ' selected ' : '' }}>PKB Gagal</option>
                    </select>
                </div>

                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" placeholder="No Dokumen" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" value="{{$data->keterangan}}">
                </div>

                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Diperbarui</label>
                    <input type="date" name="tanggal" id="tanggal" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" value="{{date('Y-m-d',strtotime($data->created_at))}}">
                </div>
                

                <div class="pt-4">
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                        Save User
                    </button>
                </div>
            </form>

    </div>
</div>

@stop
@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
   
    $('#ib').select2({
        placeholder : 'Cari IB...',
        minimumInputLength: 0,
        ajax:{
            url : '/ib/search',
            dataType : 'json',
            delay : 250,
            data : function(params){
                return{
                    q : params.term,
                    kejadian : $('#kejadian').val()
                }
            },
            processResults : function(data) {
                return {
                    results: data.map(item => ({
                        id : item.id_ib,
                        text : item.id_ib
                    }))
                }
            },
            cache : true,

        }
    })
    $('#staff').select2({
        placeholder: 'Cari Staff...',
        minimumInputLength: 0,
        ajax: {
            url: '/staff/search',
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
                        id: item.id_staff,
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
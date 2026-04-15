@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <div>

            <h3 class="text-xl font-semibold text-gray-800">User List</h3>
            <x-breadcrumb />

        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
    <form action="{{route('ticket.update', $data->id_ticket)}}" method="POST" class="flex-1 overflow-auto space-y-6">
                @csrf
                @method('POST')
                <input type="hidden" name="page" value="{{ request('page') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                <input type="hidden" name="direction" value="{{ request('direction') }}">
                <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                <div>
                    <label for="staff" class="block text-sm font-medium text-gray-700">Petugas Penanggung Jawab</label>
                    <select id="staff" name="staff" class="w-full rounded-lg shadow-sm border border-gray-300">
                        <option value="{{$data->id_staff}}" selected>{{$data->staff}}</option>
                    </select>
                </div>
                <div>
                    <label for="peternak" class="block text-sm font-medium text-gray-700">Pelapor</label>
                    <select id="peternak" name="peternak" class="w-full rounded-lg shadow-sm border border-gray-300">
                        <!-- Options loaded by AJAX -->
                        <option value="{{$data->id_peternak}}" selected>{{$data->peternak}}</option>
                    </select>
                </div>               
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis Laporan</label>
                    <select name="jenis" id="jenis" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option {{$data->jenis_laporan == 'Admin' ? 'selected' :''}} value="Admin">Admin</option>
                            <option {{$data->jenis_laporan == 'IB' ? 'selected' :''}} value="IB">IB</option>
                            <option {{$data->jenis_laporan == 'Kebuntingan' ? 'selected' :''}} value="Kebuntingan">Kebuntingan</option>
                            <option {{$data->jenis_laporan == 'Kelahiran' ? 'selected' :''}} value="Kelahiran">Kelahiran</option>
                            <option {{$data->jenis_laporan == 'Penyakit' ? 'selected' :''}} value="Penyakit">Penyakit</option>
                    </select>
                </div>
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Laporan</label>
                    <input type="datetime-local" name="tanggal" id="tanggal" value="{{date('Y-m-d\TH:i', strtotime($data->created_at))}}" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 bg-gray-100 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Pending" {{$data->status == 'Pending' ? 'selected' :''}}>Laporan Diterima</option>
                            <option value="In Progress" {{$data->status == 'In Progress' ? 'selected' :''}}>Dalam Proses</option>
                            <option value="Resolved" {{$data->status == 'Resolved' ? 'selected' :''}}>Selesai</option>
                    </select>
                </div>
                <div class="pt-4">
                    <button type="submit"
                            class="bg-blue-600 text-white px-3 py-2 rounded-xl hover:bg-blue-700 transition">
                        Update Ticket
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
    let id = window.location.pathname.split("/")[2];

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
    $('#staff').select2({
        placeholder: 'Cari Staff...',
        minimumInputLength: 0,
        ajax: {
            url: '{{route('staff.search')}}',
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
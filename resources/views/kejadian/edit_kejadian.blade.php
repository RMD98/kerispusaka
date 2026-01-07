@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Edit Kejadian</h3>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
    <form action="{{route('kejadian.update',$data->id_kejadian)}}" method="POST" class="flex-1 overflow-auto space-y-6">
                @csrf
                <div>
                    <label for="peternak" class="block text-sm font-medium text-gray-700">Id Peternak</label>
                    <select id="peternak" name="peternak" class="w-full rounded-lg shadow-sm border border-gray-300">
                        <option value="{{$data->id_peternak}}" selected>{{$data->id_peternak}}</option>
                    </select>
                </div>

                <div>
                    <label for="betina" class="block text-sm font-medium text-gray-700">Id Betina</label>
                    <!-- <input type="text" name="betina" id="betina" required -->
                           <!-- class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500"> -->
                    <select id="betina" name="betina" class="w-full rounded-lg shadow-sm border border-gray-300">
                        <option value="{{$data->id_betina}}" selected>{{$data->id_betina}} - {{$data->nama}} </option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="text" name="status" id="status" readonly
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" value="{{$data->status}}">
                </div>

                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Diperbarui</label>
                    <input type="date" name="tanggal" id="tanggal" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" value="{{date('Y-m-d',strtotime($data->created_at))}}">
                </div>


                <div class="pt-4">
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                        Update Kejadian
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
    $('#peternak').select2({
        placeholder: 'Cari Peternak...',
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

    $('#betina').select2({
        placeholder: 'Cari Betina...',
        minimumInputLength: 0,
        ajax: {
            url: '{{route('betina.search')}}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search input
                    peternak: $('#peternak').val() // get selected peternak
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(item => ({
                        id: item.ear_tag,
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
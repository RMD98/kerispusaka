@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Tambah Kelahiran</h3>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
    <form action="" method="POST" class="flex-1 overflow-auto space-y-6">
                @csrf
                @if(request()->route('id'))

                    <div>
                        <label for="kejadian" class="block text-sm font-medium text-gray-700">Id Kejadian</label>
                         <input type="text" name="kejadian" id="kejadian" readonly value="{{request()->route('id')}}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" value="{{request()->route('id')}}">
                    </div>
                @else
                    <div>
                        <label for="kejadian" class="block text-sm font-medium text-gray-700">Id Kejadian</label>
                        <select id="kejadian" name="kejadian" class="w-full rounded-lg shadow-sm border border-gray-300" required>
                        <!-- Options loaded by AJAX -->
                        </select>
                    </div>
                @endif
                <div>
                    <label for="staff" class="block text-sm font-medium text-gray-700">Petugas Penanggung Jawab</label>
                    <select id="staff" name="staff" class="w-full rounded-lg shadow-sm border border-gray-300">
                    </select>
                </div>

                
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Sapi Lahir</label>
                    <input name="nama" id="nama" type="text" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Nama Sapi Lahir" required>
                </div>
                
                <div>
                    <label for="pkb" class="block text-sm font-medium text-gray-700">ID PKB</label>
                    <select id="pkb" name="pkb" class="w-full rounded-lg shadow-sm border border-gray-300">
                    </select>
                </div>

                <div>
                    <label for="keunggulan" class="block text-sm font-medium text-gray-700">Keunggulan Sapi</label>
                    <input name="keunggulan" id="keunggulan" type="text" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Keunggulan Sapi" required>
                </div>
                
                <div>
                    <label for="kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select id="kelamin" name="kelamin" class="w-full rounded-lg shadow-sm border border-gray-300">
                        <option value="Jantan">Jantan</option>
                        <option value="Betina">Betina</option>
                    </select>
                </div>

                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Diperbarui</label>
                    <input type="date" name="tanggal" id="tanggal" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>


                <div class="pt-4">
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                        Save Kelahiran
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
        if(id){

        } else{
            $('#kejadian').select2({
                placeholder: 'Cari Kejadian...',
                minimumInputLength: 0,
                ajax: {
                    url: '{{route('kejadian.search')}}',
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
                                id: item.id_kejadian,
                                text: item.id_kejadian
                            }))
                        };
                    },
                    cache: true
                },
            });
        }
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
        $('#pkb').select2({
            placeholder: 'Cari pkb...',
            minimumInputLength: 0,
            ajax: {
                url: '{{route('pkb.search')}}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search input
                        kejadian : id
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id_pkb,
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
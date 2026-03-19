@extends('layouts.template')
@section('content')
<div>
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-3xl font-bold text-black">DASHBOARD</h1>
            <x-breadcrumb />
        </div>
    </div>
    {{-- Card Body --}}
    <div class="row ml-4">
        <div class="bg-white shadow rounded card-stat m-2" id="today">
        </div>

        <div class="bg-white shadow rounded card-stat m-2" id="total">
        </div>

        <div class="bg-white shadow rounded card-stat m-2" id="done">
        </div>
    </div>
    <div class="row ml-4 mt-4">
            <!-- <div class="bg-white shadow rounded chart m-2">
                <canvas id="ticketChart" width="700" height="300"></canvas>
            </div> -->
            <div class="bg-white shadow rounded chart m-2">
                <canvas id="ibChart" width="250" height="50"></canvas>
            </div>
    </div>
    <div class="row ml-4 mt-4">
    </div>
</div>

@stop
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url : "{{route('ticket.statistics')}}",
            type : "GET",
            success: function(response){
                    $('#today').html(`
                        <p class="text-black stat-text">Total Tickets Hari Ini</p>
                        <p class="text-black stat-text stat-value"><i class="fas fa-calendar-day mr-3 "></i>${response.today}</p>
                    `);
                    $('#total').html(`
                        <p class="text-black stat-text">Total Tickets</p>
                        <p class="text-black stat-text stat-value"><i class="fas fa-ticket-alt mr-3 "></i>${response.count}</p>
                    `);
                    $('#done').html(`
                        <p class="text-black stat-text">Total Tickets Selesai</p>
                        <p class="text-black stat-text stat-value"><i class="fas fa-check mr-3"></i>${response.selesai}</p>
                    `);
                var dataset = {
                    labels: response.labels,
                    datasets: [{
                        label: 'Jumlah Tiket per Bulan',
                        data: response.data,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                };
                createChart('ticketChart',dataset, 'line','Jumlah Tiket per Bulan');
            },
        })
        $.ajax({
            url : "{{route('ib.statistics')}}",
            type : "GET",
            success: function(response){
                var dataset = {
                    labels: response.labels,
                    datasets: [{
                        label: 'Persentase IB Sukses vs Gagal',
                        data: response.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
                createChart('ibChart', dataset, 'pie');
            },
        })
        function createChart(chart, dataset, type,) {
            const ctx = document.getElementById(chart);
            const chartData = dataset;
            new Chart(ctx, {
                type: type,
                data: chartData,
            });
        }
        
    });
    
</script>
@endpush
@extends('base')
@section('title','Beranda')

@section('content')
<section class="p-4 bg-white rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-center text-[#C0392B]">
        Dashboard Pegawai
    </h1>

    <div class="max-w-3xl mx-auto">
        <canvas id="pegawaiChart"></canvas>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pegawaiChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Jumlah Pegawai',
                data: @json($data),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection

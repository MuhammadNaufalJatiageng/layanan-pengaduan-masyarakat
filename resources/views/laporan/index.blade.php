@extends('template.main')

@section('body')
    <div class="row bg-white">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Turning-series chart</h5>
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="bg-dark p-10 text-white text-center">
                                <i class="mdi mdi-book-multiple m-b-5 font-16"></i>
                                <h5 class="m-b-0 m-t-5">{{ count($pengaduan) }}</h5>
                                <small class="font-light">Total laporan</small>
                            </div>
                        </div>
                        <div class="col-12 m-t-15">
                            <div class="bg-dark p-10 text-white text-center">
                                <i class="mdi mdi-check-circle-outline m-b-5 font-16"></i>
                                <h5 class="m-b-0 m-t-5">
                                    {{ number_format(($data[2] / count($pengaduan)) * 100, 2) }}%</h5>
                                <small class="font-light">Tingkat Penyelesaian</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const ctx = document.getElementById('myChart');
        const dataLaporan = @json($data);
        console.log(dataLaporan);

        const data = {
            labels: [
                'Status diterima',
                'Status diproses',
                'Status Selesai'
            ],
            datasets: [{
                label: 'Jumlah Laporan',
                data: [dataLaporan[0], dataLaporan[1], dataLaporan[2]],
                backgroundColor: [
                    '#ffb848',
                    '#2255a4',
                    '#28b779',
                ],
                hoverOffset: 4
            }]
        };

        new Chart(ctx, {
            type: 'pie',
            data: data,
        });
    </script>
@endsection

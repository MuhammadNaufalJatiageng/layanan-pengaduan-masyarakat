@extends('template.main')

@section('body')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title">Daftar Pengaduan</h5>
            </div>
            <div class="table-responsive">
                <table id="zero_config" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>kategori</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduan as $pengaduan)
                            @php
                                $id = Crypt::encrypt($pengaduan->id);
                                $update = Crypt::encrypt([$pengaduan->id, 'update']);
                                $selesai = Crypt::encrypt([$pengaduan->id, 'selesai']);
                            @endphp
                            <tr>
                                <td>{{ $pengaduan->judul }}</td>
                                <td>
                                    <span class="badge badge-pill badge-primary font-bold">
                                        {{ $pengaduan->kategori->nama }}
                                    </span>
                                </td>
                                <td>
                                    <span @class([
                                        'badge badge-pill font-bold',
                                        'badge-warning' => $pengaduan->status == '0',
                                        'badge-info' => $pengaduan->status == '1',
                                        'badge-success' => $pengaduan->status == '2',
                                    ])>
                                        @if ($pengaduan->status == '0')
                                            Diterima
                                        @elseIf ($pengaduan->status == '1')
                                            Di proses
                                        @else
                                            Selesai
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $pengaduan->created_at->format('d-M-Y') }}</td>
                                <td class="row justify-content-center" style="gap: 8px;">
                                    <a href="{{ route('show', $id) }}" class="btn btn-warning">Lihat</a>
                                    @if ($pengaduan->status == 0)
                                        <form action="{{ route('pengaduan.update', $update) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" class="btn btn-info">Proses</button>
                                        </form>
                                    @endif
                                    @if ($pengaduan->status == 1)
                                        <form action="{{ route('pengaduan.update', $selesai) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" class="btn btn-success">Selesai</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#zero_config').DataTable({
            "columnDefs": [{
                "targets": -1,
                "orderable": false
            }]
        });
    </script>
@endsection

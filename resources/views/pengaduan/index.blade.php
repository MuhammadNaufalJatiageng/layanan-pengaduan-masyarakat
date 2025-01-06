@extends('template.main')

@section('body')
    @if (Auth::user()->role == 'Admin')
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title">Daftar Kategori</h5>
                    <button type="button" class="btn btn-primary px-4 py-2" data-toggle="modal" data-target="#Modal2">
                        <i class="mdi mdi-plus"></i>
                        Buat kategori
                    </button>

                    {{-- modal --}}
                    <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Buat kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('kategori.store') }}" method="post" id="formKategori">
                                        @csrf
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text"
                                            class="form-control @error('nama')
                                    is-invalid
                                @enderror"
                                            id="nama" name="nama" placeholder="Nama kategori">
                                        @error('judul')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" form="formKategori" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- modal --}}
                </div>
                <div class="table-responsive">
                    <table id="kategori" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $kategori)
                                @php
                                    $idKat = Crypt::encrypt($kategori->id);
                                @endphp
                                <tr>
                                    <td>{{ $kategori->nama }}</td>
                                    <td class="row justify-content-center" style="gap: 8px;">
                                        <form action="{{ route('kategori.destroy', $idKat) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn btn-danger show_confirm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title">Pengaduan Saya</h5>
                <a href="{{ route('pengaduan.create') }}" class="btn btn-primary px-4 py-2">
                    <i class="mdi mdi-plus"></i>
                    Buat Pengaduan
                </a>
            </div>
            <div class="table-responsive">
                <table id="pengaduan" class="table table-bordered">
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
                                    <a href="{{ route('show', $id) }}" class="btn btn-info">Lihat</a>
                                    <form action="{{ route('pengaduan.destroy', $id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-danger show_confirm">Hapus</button>
                                    </form>
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
        $('#kategori').DataTable({
            "columnDefs": [{
                "targets": -1,
                "orderable": false
            }]
        });
        $('#pengaduan').DataTable({
            "columnDefs": [{
                "targets": -1,
                "orderable": false
            }]
        });
    </script>
@endsection

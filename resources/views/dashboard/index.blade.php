@extends('template.main')

@section('body')
    <div class="row">
        <div class="col-md card">
            <div class="card-body d-flex justify-content-between">
                <h4 class="card-title m-b-0">Daftar Pengaduan</h4>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#Modal2">
                    <i class="mdi mdi-filter-outline"></i>
                    Filter
                </button>
            </div>
            <ul class="list-style-none">
                @foreach ($pengaduan as $pengaduan)
                    @php
                        $id = Crypt::encrypt($pengaduan->id);
                    @endphp
                    <li class="card-body p-2">
                        <a href="{{ route('show', $id) }}" class="d-flex no-block p-2 rounded link">
                            <div>
                                <p class="m-b-0 font-medium p-0">{{ $pengaduan->judul }}</p>
                                <div>

                                    <span
                                        class="badge badge-pill badge-primary font-bold">{{ $pengaduan->kategori->nama }}</span>
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
                                </div>
                            </div>
                            <div class="ml-auto">
                                <div class="tetx-right text-center">
                                    <h5 class="text-muted m-b-0">{{ $pengaduan->created_at->format('d M') }}</h5>
                                    <span class="text-muted font-16">{{ $pengaduan->created_at->format('Y') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    {{-- modal --}}
    <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filter Berdasarkan kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('search') }}" method="post" id="filter">
                        @csrf
                        <div class="form-group" data-select2-id="12">
                            <label>Pilih Kategori</label>
                            <div>
                                <select class="select2 form-control custom-select select2-hidden-accessible" tabindex="-1"
                                    aria-hidden="true" name="filter">
                                    <option selected disabled>Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" form="filter" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
@endsection

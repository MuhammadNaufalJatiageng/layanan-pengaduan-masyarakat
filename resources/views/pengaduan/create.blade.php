@extends('template.main')

@section('body')
    <div class="card p-3">
        <form action="{{ route('pengaduan.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <h3 class="card-title">Buat Pengaduan</h3>

                <div class="mt-3 border-bottom">
                    <h5>Identitas pembuat pengaduan.</h5>

                    <div class="form-group row mt-3">
                        <label for="nama" class="col-md-1 control-label col-form-label">Nama</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="nama" value="{{ Auth::user()->name }}"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="nik" class="col-md-1 control-label col-form-label">NIK</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="nik" value="{{ Auth::user()->nik }}"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="alamat" class="col-md-1 control-label col-form-label">Alamat</label>
                        <div class="col-md">
                            <textarea id="alamat" class="form-control" readonly>{{ Auth::user()->alamat }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Laporan</label>
                        <input type="text"
                            class="form-control @error('judul')
                            is-invalid
                        @enderror"
                            id="judul" name="judul" value="{{ old('judul') }}">
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group" data-select2-id="12">
                        <label>Kategori</label>
                        <div>
                            <select
                                class="select2 form-control custom-select select2-hidden-accessible @error('kategori_id')
                            is-invalid
                        @enderror""
                                tabindex="-1" aria-hidden="true" name="kategori_id">
                                <option selected disabled>Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('kategori_id') == $item->id ? 'selected' : ' ' }}>{{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="isi_laporan" class="form-label">Isi Laporan</label>
                        <textarea
                            class="form-control @error('isi_laporan')
                            is-invalid
                        @enderror"
                            id="isi_laporan" rows="3" name="isi_laporan">{{ old('isi_laporan') }}</textarea>
                        @error('isi_laporan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lampiran" class="form-label">Lampiran <small class="text-muted">( pdf,png,jpg.jpeg
                                )</small></label>
                        <input
                            class="form-control @error('lampiran')
                                    is-invalid
                                @enderror"
                            type="file" id="lampiran" name="lampiran">
                        @error('lampiran')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

    </div>
    <div class="border-top">
        <div class="card-body">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>
    </div>
@endsection

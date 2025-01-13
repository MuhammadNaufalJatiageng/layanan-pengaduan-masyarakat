@extends('template.main')

@section('style')
    <style>
        .report-header {
            background-color: #0468d3;
            color: white;
            padding: 30px;
            border-radius: 10px 10px 0 0;
        }

        .report-content {
            background-color: white;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
        }

        .report-attachments img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .report-category .badge {
            margin-right: 5px;
        }

        .btn-press {
            border: 2px solid rgba(0, 0, 0, 0.225);
            border-radius: 2px;
            padding: 8px;
            width: 100%;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
        }

        .btn-press:active {
            transform: scale(0.95);
        }

        #formContainer {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 0.5s ease, opacity 0.5s ease;
        }

        #formContainer.visible {
            max-height: 200px;
            /* Atur sesuai kebutuhan */
            opacity: 1;
        }

        .hidden {
            display: none;
            /* Sembunyikan elemen saat tidak terlihat */
        }
    </style>
@endsection

@section('body')
    <div>
        <div class="report-header text-center">
            <h1 class="display-6">
                {{ $pengaduan->judul }}
            </h1>
            <p class="lead">
                Kategori:
                <span class="badge bg-light text-dark font-bold">
                    {{ $pengaduan->kategori->nama }}
                </span>
            </p>
            <p class="lead">
                Status: @if ($pengaduan->status == '0')
                    Sudah diterima
                @elseIf ($pengaduan->status == '1')
                    Sedang diproses
                @else
                    Sudah selesai
                @endif
            </p>
        </div>
        <div class="report-content mt-4">
            <p>
                {{ $pengaduan->isi_laporan }}
            </p>
            @if ($pengaduan->lampiran)
                <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" class="btn btn-warning" download>Unduh lampiran</a>
            @endif
            <small class="d-flex justify-content-end text-muted">{{ $pengaduan->created_at->diffForHumans() }}</small>
        </div>
        <div class="report-content mt-4">
            <h4>Respon</h4>
            <div class="card">
                <div class="comment-widgets scrollable ps-container ps-theme-default"
                    data-ps-id="96e6bde3-dc6c-58d5-8652-eae8aa54bb9a">
                    @foreach ($respons as $item)
                        @if ($item->pesan)
                            <div class="d-flex flex-row comment-row m-t-0 border-bottom p-1">
                                <div class="comment-text w-100">
                                    <h6 class="font-medium text-muted">
                                        {{ $item->user->role == 'Admin' ? $item->user->name : 'Pelapor' }}</h6>
                                    <span class="m-b-15 d-block">{{ $item->pesan }}</span>
                                    <div class="comment-footer">
                                        <small
                                            class="text-muted float-right">{{ $item->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                        <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                        <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->id == $pengaduan->user_id || Auth::user()->role == 'Admin')
            <div class="report-content mt-4">
                @php
                    $id = Crypt::encrypt($pengaduan->id);
                @endphp
                <div id="formContainer" class="hidden">
                    <form action="{{ route('pengaduan.reply') }}" method="POST" class="mb-3" id="repForm">
                        @csrf
                        <div class="input-group-textarea">
                            <input type="hidden" name="pengaduan_id" value="{{ $id }}">
                            <textarea class="form-control border-0" rows="2" placeholder="Tulis pesan Anda di sini..." name="pesan"
                                autofocus></textarea>
                            <button class="btn btn-primary p-2" style="width: 100%">Kirim</button>
                        </div>
                    </form>
                </div>

                <button class="btn btn-white btn-press font-bold" id="repBtn">Balas</button>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script>
        const repBtn = document.getElementById('repBtn');
        const formContainer = document.getElementById('formContainer');

        repBtn.addEventListener('click', () => {
            if (formContainer.classList.contains('visible')) {
                formContainer.classList.remove('visible');
                setTimeout(() => {
                    formContainer.classList.add('hidden');
                }, 500); // Waktu yang sama dengan durasi transisi
            } else {
                formContainer.classList.remove('hidden');
                setTimeout(() => {
                    formContainer.classList.add('visible');
                }, 10); // Sedikit delay untuk memicu transisi
            }
        });
    </script>
@endsection

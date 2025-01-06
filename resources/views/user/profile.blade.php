@extends('template.main')

@section('body')
    <div class="card">
        <div class="card-body">
            <h5>Profil</h5>
            <div class="mt-3">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>{{ Auth::user()->nik }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ Auth::user()->alamat }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

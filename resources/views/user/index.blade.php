@extends('template.main')

@section('body')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="card-title">Daftar User</h5>
                <button type="button" class="btn btn-primary px-4 py-2" data-toggle="modal" data-target="#Modal2">
                    <i class="mdi mdi-plus"></i>
                    Buat User
                </button>

                {{-- modal --}}
                <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Buat user</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.store') }}" method="post" id="formUser">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label ">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                            id="name" name="name" placeholder="Nama lengkap sesuai ktp"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="register-nik" class="form-label ">NIK</label>
                                        <input type="text"
                                            class="form-control @error('nik')
                                                is-invalid
                                            @enderror"
                                            id="register-nik" name="nik" placeholder="NIK sesuai ktp"
                                            value="{{ old('nik') }}">
                                        @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label ">Email</label>
                                        <input type="email"
                                            class="form-control @error('email')
                                                is-invalid
                                            @enderror"
                                            id="email" name="email" placeholder="name@gmail.com"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label ">Alamat</label>
                                        <textarea name="alamat" id="alamat"
                                            class="form-control @error('alamat')
                                                is-invalid
                                            @enderror"
                                            placeholder="Isi sesuai alamat di ktp">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group" data-select2-id="12">
                                        <label>Role</label>
                                        <div>
                                            <select
                                                class="select2 form-control custom-select select2-hidden-accessible @error('role')
                                            is-invalid
                                        @enderror""
                                                tabindex="-1" aria-hidden="true" name="role">
                                                <option selected disabled>Pilih Role</option>
                                                <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>User
                                                </option>
                                                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin
                                                </option>
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="register-password" class="form-label ">Password</label>
                                        <input type="password"
                                            class="form-control @error('password')
                                                is-invalid
                                            @enderror"
                                            id="register-password" name="password" placeholder="••••••••">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" form="formUser" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modal --}}
            </div>
            <div class="table-responsive">
                <table id="user" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $user)
                            @php
                                $id = Crypt::encrypt($user->id);
                            @endphp
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td class="row justify-content-center" style="gap: 8px;">
                                    <form action="{{ route('user.destroy', $id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
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
        $('#user').DataTable({
            "columnDefs": [{
                "targets": -1,
                "orderable": false
            }]
        });
    </script>
@endsection

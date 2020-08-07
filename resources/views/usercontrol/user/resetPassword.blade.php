@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card uper">
                <div class="x_panel">
                    <div class="x_title">
                        <h1>Ubah Password User</h1>
                    </div>
                    <div class="x_content">
                        @if (Auth::user() && Auth::user()->name == 'admin')
                        <form action="{{ url('/user/reset') }}" method="get" style="display:inline-block;">
                            @csrf

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @method('GET')
                            @foreach($users as $user)
                            <input type="hidden" name="name" value="{{ $user->name }}" class="form-control">
                            @endforeach
                            <div class="form-group">
                                <label>Password Baru: </label>
                                <input type="password" required="required" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Ulangi Password: </label>
                                <input type="password" required="required" name="password_confirmation" placeholder="Password" class="form-control">
                            </div>
                            <br>
                            <button class="btn btn-success" style="width:120px;">Simpan</button>
                        </form>
                        <form action="{{ url('/user') }}" method="get">
                            <button class="btn btn-danger" style="width:120px;">Batal</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#Tipe').select2();
    });
</script>
@endpush
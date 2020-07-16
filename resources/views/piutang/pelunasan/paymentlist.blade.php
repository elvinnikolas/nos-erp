@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Pelunasan Piutang</h1><br>
                </div>
                <div class="x_body">
                    @if($sisa > 0)
                    <a class="btn btn-primary " href="{{url('/pelunasanpiutang/payment/'.$invoice->KodeInvoicePiutang.'/add')}}">
                        <i class="fa fa-plus" aria-hidden="true"></i> Pembayaran
                    </a>
                    @endif
                    <br><br>
                    <table class="table table-light" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Pelanggan</th>
                                <th>No Tagihan</th>
                                <th>Tanggal</th>
                                <th>Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $pelanggan->NamaPelanggan }}</td>
                                <td>{{ $invoice->KodeInvoicePiutangShow}}</td>
                                <td>{{ $payment->Tanggal}}</td>
                                <td>{{ $payment->Jumlah}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#table').DataTable();
</script>
@endpush
@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Pelunasan Hutang</h1><br>
                </div>
                <div class="x_body">
                    @if($sisa > 0)
                    <a class="btn btn-primary " href="{{url('/pelunasanhutang/payment/'.$invoice->KodeInvoiceHutang.'/add')}}">
                        <i class="fa fa-plus" aria-hidden="true"></i> Pembayaran
                    </a>
                    @endif
                    <br><br>
                    <table class="table table-light" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Pelunasan</th>
                                <th>Tanggal Bayar</th>
                                <th>Total Bayar</th>
                                <th>Metode</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->KodePelunasanHutang }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->Tanggal)->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($payment->Jumlah, 0, ',', '.') }},-</td>
                                <td>{{ $payment->TipeBayar }}</td>
                                <td>{{ $payment->Keterangan}}</td>
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
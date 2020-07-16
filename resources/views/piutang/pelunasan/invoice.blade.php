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
                    <table class="table table-light" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>No Tagihan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Total Bayar</th>
                                <th>Selisih</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice as $inv)
                            @if(($inv->Subtotal - $inv->bayar)<=0) @continue @endif <tr>
                                <td>{{ $inv->KodeInvoicePiutangShow}}</td>
                                <td>{{ $inv->Tanggal}}</td>
                                <td>{{ $inv->Subtotal}}</td>
                                <td>{{ $inv->bayar}}</td>
                                <td>{{ $inv->Subtotal - $inv->bayar}}</td>
                                <td><a href="{{url('pelunasanpiutang/payment/'.$inv->KodeInvoicePiutang)}}" class="btn-xs btn-success">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Pembayaran
                                    </a>
                                </td>
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
    $('#table').DataTable({
        "order": [
            [0, "desc"]
        ]
    });
</script>
@endpush
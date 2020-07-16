@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Invoice Piutang</h1><br>
                </div>
                <div class="x_body">
                    <table class="table table-light" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Pelanggan</th>
                                <th>No Tagihan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Total Bayar</th>
                                <th>Selisih</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice as $inv)
                            @if ($inv->Subtotal == $inv->bayar || \Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term) > \Carbon\Carbon::now())
                            <tr class="success">
                                <td>{{ $inv->NamaPelanggan}}</td>
                                <td>{{ $inv->KodeInvoicePiutangShow}}</td>
                                <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $inv->Subtotal }}</td>
                                <td>{{ $inv->bayar }}</td>
                                <td>{{ $inv->Subtotal - $inv->bayar}}</td>
                                <td>
                                    <a href="{{url('invoicepiutang/print/'.$inv->KodeInvoicePiutangShow)}}" class="btn btn-xs btn-primary">Print</a>
                                </td>
                            </tr>
                            @else
                            <tr class="danger">
                                <td>{{ $inv->NamaPelanggan}}</td>
                                <td>{{ $inv->KodeInvoicePiutangShow}}</td>
                                <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $inv->Subtotal }}</td>
                                <td>{{ $inv->bayar }}</td>
                                <td>{{ $inv->Subtotal - $inv->bayar}}</td>
                                <td>
                                    <a href="{{url('invoicepiutang/print/'.$inv->KodeInvoicePiutangShow)}}" class="btn btn-xs btn-primary">Print</a>
                                </td>
                            </tr>
                            @endif
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
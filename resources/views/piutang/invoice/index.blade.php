@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Invoice Piutang</h1>
                    <span>Keterangan warna</span><br>
                    <span>*hijau : sudah lunas</span><br>
                    <span>*kuning : belum lunas</span><br>
                    <span>*merah : belum lunas dan lewat jatuh tempo</span><br>
                </div>
                <div class="x_body">
                    <table class="table table-light" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>No Invoice</th>
                                <th>No SJ</th>
                                <th>Pelanggan</th>
                                <th>Jatuh Tempo</th>
                                <th>No Faktur</th>
                                <th>Total</th>
                                <th>Total Bayar</th>
                                <th>Selisih</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice as $inv)

                            @if($inv->Subtotal <= 0) @elseif ($inv->Subtotal <= $inv->bayar)
                                    <tr class="success">
                                        <td>{{ $inv->KodeInvoicePiutangShow}}</td>
                                        <td>{{ $inv->KodeSuratJalan}}</td>
                                        <td>{{ $inv->NamaPelanggan}}</td>
                                        <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term)->format('d-m-Y') }}</td>
                                        <td>{{ $inv->NoFaktur}}</td>
                                        <td>Rp. {{ number_format($inv->Subtotal, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->bayar, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->Subtotal - $inv->bayar, 0, ',', '.')}},-</td>
                                        <td>
                                            <a href="{{url('invoicepiutang/print/'.$inv->KodeInvoicePiutangShow)}}" class="btn btn-xs btn-primary">Print</a>
                                            <a href="{{url('invoicepiutang/edit/'.$inv->KodeInvoicePiutangShow)}}" class="btn btn-xs btn-success">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @elseif(\Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term) > \Carbon\Carbon::now())
                                    <tr class="warning">
                                        <td>{{ $inv->KodeInvoicePiutangShow}}</td>
                                        <td>{{ $inv->KodeSuratJalan}}</td>
                                        <td>{{ $inv->NamaPelanggan}}</td>
                                        <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term)->format('d-m-Y') }}</td>
                                        <td>{{ $inv->NoFaktur}}</td>
                                        <td>Rp. {{ number_format($inv->Subtotal, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->bayar, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->Subtotal - $inv->bayar, 0, ',', '.')}},-</td>
                                        <td>
                                            <a href="{{url('invoicepiutang/print/'.$inv->KodeInvoicePiutangShow)}}" class="btn btn-xs btn-primary">Print</a>
                                            <a href="{{url('invoicepiutang/edit/'.$inv->KodeInvoicePiutangShow)}}" class="btn btn-xs btn-success">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr class="danger">
                                        <td>{{ $inv->KodeInvoicePiutangShow}}</td>
                                        <td>{{ $inv->KodeSuratJalan}}</td>
                                        <td>{{ $inv->NamaPelanggan}}</td>
                                        <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term)->format('d-m-Y') }}</td>
                                        <td>{{ $inv->NoFaktur}}</td>
                                        <td>Rp. {{ number_format($inv->Subtotal, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->bayar, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->Subtotal - $inv->bayar, 0, ',', '.')}},-</td>
                                        <td>
                                            <a href="{{url('invoicepiutang/print/'.$inv->KodeInvoicePiutangShow)}}" class="btn btn-xs btn-primary">Print</a>
                                            <a href="{{url('invoicepiutang/edit/'.$inv->KodeInvoicePiutangShow)}}" class="btn btn-xs btn-success">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
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
@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Invoice Hutang</h1>
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
                                <th>No PB</th>
                                <th>Supplier</th>
                                <th>Jatuh Tempo</th>
                                <th>No Faktur</th>
                                <th>Total</th>
                                <th>Total Bayar</th>
                                <th>Total Return</th>
                                <th>Selisih</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice as $inv)

                            @if ($inv->Subtotal <= $inv->bayar + $inv->TotalReturn)
                                <tr class="success">
                                    <td>{{ $inv->KodeInvoiceHutangShow}}</td>
                                    <td>{{ $inv->KodeLPB}}</td>
                                    <td>{{ $inv->NamaSupplier}}</td>
                                    <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term)->format('d-m-Y') }}</td>
                                    <td>{{ $inv->NoFaktur}}</td>
                                    <td>Rp. {{ number_format($inv->Subtotal, 0, ',', '.') }},-</td>
                                    <td>Rp. {{ number_format($inv->bayar, 0, ',', '.') }},-</td>
                                    <td>Rp. {{ number_format($inv->TotalReturn, 0, ',', '.') }},-</td>
                                    <td>Rp. {{ number_format($inv->Subtotal - $inv->bayar - $inv->TotalReturn, 0, ',', '.')}},-</td>
                                    <td>
                                        <a href="{{url('invoicehutang/print/'.$inv->KodeInvoiceHutangShow)}}" class="btn btn-xs btn-primary">Print</a>
                                        @if($inv->PPN == "ya")
                                        <a href="{{url('invoicehutang/edit/'.$inv->KodeInvoiceHutangShow)}}" class="btn btn-xs btn-success">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @elseif(\Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term) > \Carbon\Carbon::now())
                                <tr class="warning">
                                    <td>{{ $inv->KodeInvoiceHutangShow}}</td>
                                    <td>{{ $inv->KodeLPB}}</td>
                                    <td>{{ $inv->NamaSupplier}}</td>
                                    <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term)->format('d-m-Y') }}</td>
                                    <td>{{ $inv->NoFaktur}}</td>
                                    <td>Rp. {{ number_format($inv->Subtotal, 0, ',', '.') }},-</td>
                                    <td>Rp. {{ number_format($inv->bayar, 0, ',', '.') }},-</td>
                                    <td>Rp. {{ number_format($inv->TotalReturn, 0, ',', '.') }},-</td>
                                    <td>Rp. {{ number_format($inv->Subtotal - $inv->bayar - $inv->TotalReturn, 0, ',', '.')}},-</td>
                                    <td>
                                        <a href="{{url('invoicehutang/print/'.$inv->KodeInvoiceHutangShow)}}" class="btn btn-xs btn-primary">Print</a>
                                        @if($inv->PPN == "ya")
                                        <a href="{{url('invoicehutang/edit/'.$inv->KodeInvoiceHutangShow)}}" class="btn btn-xs btn-success">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @else
                                <tr class="danger">
                                    <td>{{ $inv->KodeInvoiceHutangShow}}</td>
                                    <td>{{ $inv->KodeLPB}}</td>
                                    <td>{{ $inv->NamaSupplier}}</td>
                                    <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term)->format('d-m-Y') }}</td>
                                    <td>{{ $inv->NoFaktur}}</td>
                                    <td>Rp. {{ number_format($inv->Subtotal, 0, ',', '.') }},-</td>
                                    <td>Rp. {{ number_format($inv->bayar, 0, ',', '.') }},-</td>
                                    <td>Rp. {{ number_format($inv->TotalReturn, 0, ',', '.') }},-</td>
                                    <td>Rp. {{ number_format($inv->Subtotal - $inv->bayar - $inv->TotalReturn, 0, ',', '.')}},-</td>
                                    <td>
                                        <a href="{{url('invoicehutang/print/'.$inv->KodeInvoiceHutangShow)}}" class="btn btn-xs btn-primary">Print</a>
                                        @if($inv->PPN == "ya")
                                        <a href="{{url('invoicehutang/edit/'.$inv->KodeInvoiceHutangShow)}}" class="btn btn-xs btn-success">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                        @endif
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
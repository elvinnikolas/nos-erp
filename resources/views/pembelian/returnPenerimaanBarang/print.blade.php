<!DOCTYPE html>
<html>

<head>
	<title></title>
	<style>
		p,
		tr {
			font-size: 15px;
			margin: 2;
		}

		form {
			margin: 0;
		}

		form input,
		button {
			padding: 0px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			padding: 0;
			margin: 0;
		}

		table,
		th,
		td {
			border: 1px solid #cdcdcd;
		}

		table th,
		table td {
			padding: 0;
			text-align: left;
		}

		.column {
			margin: 0;
			display: inline-block;
			float: left;
			width: 33%;
		}

		/* Clear floats after the columns */
		.row:after {
			content: "";
			display: table;
			clear: both;
		}

		#center {
			text-align: center;
		}

		#right {
			text-align: right;
		}

		#marginless {
			margin: 0;
		}

		#borderless {
			border-collapse: collapse;
			border: none;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_content">
						@csrf
						<!-- Contents -->
						<div class="form-row">
							<p id="center"><b>SURAT JALAN RETURN</b></p>
						</div>
						<br>
						<div class="form-row">
							<div style="width: 50%; float:left">
								<table id="borderless">
									<tr id="borderless">
                                        <td width="24%" id="borderless">
                                            <p>Kepada yth.</p>
                                        </td>
                                        <td width="3%" id="borderless">
                                            <p>:</p>
                                        </td>
                                        <td width="73%" id="borderless">
                                            <p>{{$supplier->NamaSupplier}}</p>
                                        </td>
                                    </tr>
									<tr id="borderless">
                                        <td width="24%" id="borderless">
                                            <p>Alamat</p>
                                        </td>
                                        <td width="3%" id="borderless">
                                            <p>:</p>
                                        </td>
                                        <td width="73%" id="borderless">
                                            <p>{{$supplier->Alamat}}</p>
                                        </td>
                                    </tr>
								</table>
							</div>
							<div style="width: 50%; float:right">
								<table id="borderless">
									<tr id="borderless">
										<td width="30%" id="borderless">
										</td>
										<td width="30%" id="borderless">
											<p>No. Return</p>
										</td>
										<td width="40%" id="borderless">
											<p>:&nbsp; {{$returnpenerimaanbarang->KodePenerimaanBarangReturn}}</p>
										</td>
									</tr>
									<tr id="borderless">
										<td width="30%" id="borderless">
										</td>
										<td width="30%" id="borderless">
											<p>Tanggal</p>
										</td>
										<td width="40%" id="borderless">
											<p>:&nbsp; {{$returnpenerimaanbarang->Tanggal}}</p>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<br><br><br><br><br>
						<div class="form-row">
							<div class="form-group col-md-12">
								<table id="items">
									<tr>
										<td id="center"><b>No</b></td>
										<td id="center"><b>Nama Barang</b></td>
										<td id="center"><b>Qty</b></td>
										<td id="center"><b>Satuan</b></td>
									</tr>
									{{$no = 1}}
									@foreach($items as $item)
									<tr class="rowinput">
										<td>
											&nbsp;&nbsp;&nbsp;{{$no++}}
										</td>
										<td>
											&nbsp;&nbsp;&nbsp;{{$item->NamaItem}}
										</td>
										<td id="right">
											{{$item->Qty}}&nbsp;&nbsp;&nbsp;
										</td>
										<td id="right">
											{{$item->KodeSatuan}}&nbsp;&nbsp;&nbsp;
										</td>
									</tr>
									@endforeach
								</table>
								<br><br>
								<div class="row">
									<div class="column">
										<!-- <p>Sales : {{$sales->Nama}}</p> -->
										<!-- <p>No. SJ (Supplier) : {{$penerimaanbarang->KodeSJ}}</p>
										<p>Keterangan : {{$returnpenerimaanbarang->Keterangan}}</p> -->
										<table id="borderless">
											<tr id="borderless">
												<td width="27%" id="borderless">
													<p>SJ Supplier</p>
												</td>
												<td width="3%" id="borderless">
													<p>:</p>
												</td>
												<td width="70%" id="borderless">
													<p>{{$penerimaanbarang->KodeSJ}}</p>
												</td>
											</tr>
											<tr id="borderless">
												<td width="27%" id="borderless">
													<p>Keterangan</p>
												</td>
												<td width="3%" id="borderless">
													<p>:</p>
												</td>
												<td width="70%" id="borderless">
													<p>{{$returnpenerimaanbarang->Keterangan}}</p>
												</td>
											</tr>
										</table>
									</div>
									<div class="column">
										<br><br>
										<p id="center">Penerima,</p>
										<br><br>
										<p id="center">( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ) </p>
									</div>
									<div class="column">
										<br><br>
										<p id="center">Hormat kami,</p>
										<br><br>
										<p id="center">( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ) </p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
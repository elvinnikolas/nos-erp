<!DOCTYPE html>
<html>

<head>
	<title></title>
	<style>
		p,
		tr {
			font-size: 12px;
			margin: 0;
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
							<div class="column">
								<p>No. RPB : {{$returnpenerimaanbarang->KodePenerimaanBarangReturn}}</p>
								<p>No. PB : {{$penerimaanbarang->KodePenerimaanBarang}}</p>
								<p>No. PO : {{$penerimaanbarang->KodePO}}</p>
							</div>
							<div class="column">
								<p id="center">Return Penerimaan Barang</p>
								<p id="center">{{$returnpenerimaanbarang->Tanggal}}</p>
							</div>
							<div class="column">
								<p id="right">Kepada yth.</p>
								<p id="right">Supplier/Toko : {{$pelanggan->NamaSupplier}}</p>
							</div>
						</div>
						<br><br><br><br>
						<div class="form-row">
							<div class="form-group col-md-12">
								<table id="items">
									<tr>
										<td id="center"><b>Kode Barang</b></td>
										<td id="center"><b>Nama Barang</b></td>
										<td id="center"><b>Jumlah</b></td>
									</tr>
									@foreach($items as $item)
									<tr class="rowinput">
										<td>
											{{$item->KodeItem}}
										</td>
										<td>
											{{$item->NamaItem}}
										</td>
										<td id="right">
											{{$item->Qty}} &nbsp; {{$item->NamaSatuan}}
										</td>
									</tr>
									@endforeach
								</table>
								<br><br>
								<div class="row">
									<div class="column">
										<p>Total Barang : {{$jml}}</p>
										<p>Sales : {{$sales->Nama}}</p>
									</div>
									<div class="column"></div>
									<div class="column"></div>
								</div>
								<br>
								<div class="row">
									<div class="column"></div>
									<div class="column">
										<p id="center">Penerima,</p>
										<br><br>
										<p id="center">( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ) </p>
									</div>
									<div class="column">
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
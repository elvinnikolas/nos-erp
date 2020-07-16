<!DOCTYPE html>
<html>

<head>
	<title></title>
	<style>
		* {
			box-sizing: border-box;
		}

		/* Create two equal columns that floats next to each other */
		.column {
			float: left;
			width: 50%;
			padding: 10px;
			height: 300px;
			/* Should be removed. Only for demonstration */
		}

		/* Clear floats after the columns */
		.row:after {
			content: "";
			display: table;
			clear: both;
		}

		.judul {
			font-size: 25px;
		}

		.kotak {
			float: right;
		}
	</style>
</head>

<body>
	<center>
		<div class="judul">Surat Permintaan Penjualan</div>
	</center>
	<div class="kotak">
		Kode SO : {{$id}}<br>
		Nama Pelangga :{{$data->NamaPelanggan}} <br>
		Tanggal :{{$data->Tanggal}} <br>
		Kota :{{$namakota}}
	</div>
	<br>
	<br>
	<br>
	<br>
	kami kirimkan barang - barang <br>
	<table width="100%" class="tb" border="1px solid red">
		<thead>
			<tr>
				<td>Kode Item</td>
				<td>Nama Barang</td>
				<td>Jumlah</td>
				<td>Harga</td>
				<td>Subtotal</td>
			</tr>
		</thead>
		<tbody>
			{{$total=0}}
			@foreach($items as $item)
			<tr>
				{{$total=$total+$item->Harga}}
				<td>{{$loop->iteration}}</td>
				<td>{{$item->NamaItem}}</td>
				<td>{{$item->Qty}}</td>
				<td>Rp{{number_format($item->Harga,2)}}</td>
				<td>Rp{{number_format($item->Subtotal,2)}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<table width="100%" border="0">
		<tr height="10px">
			<Td width="25%"></Td>
			<td></td>
			<td></td>
			<td></td>

		</tr>
		<tr>
			<Td width="25%"></Td>
			<td></td>
			<td></td>
			<td></td>

		</tr>
		<tr>
			<Td width="25%">Total Barang</Td>
			<td>{{$jml}}</td>
			<td>Total</td>
			<td align="right">Rp.{{number_format($total,2)}}</td>

		</tr>
		<tr>
			<Td width="25%">Keterangan</Td>
			<td>{{$data->Keterangan}}</td>
			<td>PPn</td>
			<td align="right">Rp.{{number_format($data->NilaiPPN,2)}}</td>
		</tr>
		<tr>
			<Td width="25%"></Td>
			<td></td>
			<td>Sub Total</td>
			<td align="right">Rp.{{number_format($total - $data->NilaiPPN,2)}}</td>
		</tr>
	</table>
	<table width="100%" border="0">
		<tr>
			<td width="25%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td width="10%">Gudang</td>
			<td width="10%">Sopir</td>
			<td width="10%">Penerima</td>
			<td width="20%">Penerima</td>
			<td width="25%"></td>
		</tr>
		<tr>
			<td width="25%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td width="10%">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
			<td width="10%">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
			<td width="10%">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
			<td width="20%">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
			<td width="25%"></td>
		</tr>
	</table>
</body>

</html>
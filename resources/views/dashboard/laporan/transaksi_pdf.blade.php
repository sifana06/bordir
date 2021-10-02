<html>
<head>
	<title>Laporan Transaksi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Transaksi</h4>
	</center>
 
	<table class='table table-bordered'>
        <thead>
        <tr>
            <th width="10">No</th>
            <th>Order ID</th>
            <th>Produk</th>
            <!-- <th>Rekening</th> -->
            <th>Toko</th>
            <th width="150">Total Pembayaran</th>
            <th width="150">Tanggal Pembayaran</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transaksi as $tr)
        <tr>
            <th width="10">{{$loop->iteration}}</th>
            <th>{{$tr->order->order_number}}</th>
            <th>{{$tr->product->nama}}</th>
            <th>{{$tr->store->nama}}</th>
            <th>Rp. {{$tr->order->total}}</th>
            <th>{{$tr->order->tanggal_pembayaran}}</th>
        </tr>
        @endforeach
        </tbody>
	</table>
 
</body>
</html>
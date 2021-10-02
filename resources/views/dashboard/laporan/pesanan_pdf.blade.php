<html>
<head>
	<title>Laporan Pesanan</title>
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
		<h5>Laporan Pesanan</h4>
	</center>
 
	<table class='table table-bordered'>
    <thead>
            <tr>
                <th width="10">No</th>
                <th>Order Number</th>
                <th>Customers</th>
                <th>Products</th>
                <th>Status</th>
                <th>Pembayaran</th>
                <th>Total</th>
            </tr>
          </thead>
          <tbody>
          @foreach($pesanan as $p)
            <tr>
                <th width="10">{{$loop->iteration}}</th>
                <th>{{$p->order_number}}<div><span class="text-warning"><b>Deadline : {{Carbon\Carbon::parse($p->deadline)->format('d/M/y')}}</b></span></div></th>
                <th>{{$p->nama_pelanggan}}</th>
                <th>{{$p->product->nama}}<div>Jenis Bordir: {{$p->jenis_bordir}}</div></th>
                <th>
                    @php
                        switch ($p->status_order) {
                        case 'order':
                            $class = 'style="color:#00c0ef;"';
                        break;
                        case 'cancel':
                            $class = 'style="color:#f56954;"';
                        break;
                        case 'pending':
                            $class = 'style="color:#f1c40f;"';
                        break;
                        case 'success':
                            $class = 'style="color:#00a65a;"';
                        break;
                        default:
                            $class = $p->status_order;
                        break;
                    }
                    switch ($p->status_pengiriman) {
                        case 'belum dikirim':
                            $class_pengiriman = 'style="color:#f1c40f;"';
                        break;
                        case 'sudah dikirim':
                            $class_pengiriman = 'style="color:#00a65a;"';
                        break;
                        default:
                            $class_pengiriman = $p->status_pengiriman;
                        break;
                    }
                    switch ($p->status_pengiriman) {
                        case 'belum dikirim':
                            $status_pengiriman = "Belum Dikirim";
                        break;
                        case 'sudah dikirim':
                            $status_pengiriman = "Sudah Dikirim";
                        break;
                        default:
                            $status_pengiriman = '----------';
                        break;
                    }
                    @endphp
                    <div class="small text-muted">Status Pesanan </div><div> <small><li class="fa fa-circle fa-xs" {{$class}}></li></small> {{ucwords($p->status_order)}}</div>
                    <div class="small text-muted">Status Pengiriman </div><div> <small><li class="fa fa-circle fa-xs" {{$class_pengiriman}}></li></small> {{$status_pengiriman}}<div>
                </th>
                <th>
                @php
                    switch ($p->status_pembayaran) {
                        case 'belum dibayar':
                            $class = 'style="color:#f1c40f;"';
                        break;
                        case 'sudah dibayar':
                            $class = 'style="color:#00a65a;"';
                        break;
                        default:
                            $class = $p->status_pembayaran;
                        break;
                    }
                    
                @endphp
                    @if($p->status_pembayaran == NULL)
                        <div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" {{$class}}></li></small> --------</div>
                    @else
                        <div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" {{$class}}></li></small> {{ucwords($p->status_pembayaran)}}</div>
                    @endif
                </th>
                <th>Rp. {{$p->total}}</th>
            </tr>
            @endforeach
          </tbody>
	</table>
 
</body>
</html>
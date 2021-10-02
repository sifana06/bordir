<html>
<head>
	<title>Laporan User</title>
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
		<h5>Laporan User</h4>
	</center>
 
	<table class='table table-bordered'>
        <thead>
        <tr>
            <th width="10">No</th>
            <th>nama</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Verifikasi Email</th>
            <th width="150">Tanggal Daftar</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $tr => $user)
        <tr>
            <th width="10">{{$loop->iteration}}</th>
            <th>{{$user->name}}</th>
            <th>{{$user->email}}</th>
            <th>{{$user->phone}}</th>
            <th>{{$user->role}}</th>
            <th>{{$user->email_verified_at == null ? 'Belum diverifikasi':'Sudah diverifikasi'}}</th>
            <th>{{$user->created_at}}</th>
        </tr>
        @endforeach
        </tbody>
	</table>
 
</body>
</html>
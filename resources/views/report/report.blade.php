<style>
    td{
        text-align: center;
    }
    
    table{
        border-collapse: collapse;
    }
    th,td{
        padding: 10px;
    }
    
    h1{
        margin-bottom: -13px;
    }

    .tgl-cetak{
        /* margin-top: -15px; */
        float: left;
    }

    .nama{
        float: right;
    }
</style>
<h1>
    @if($type == "all")
    Laporan Semua Peminjaman
    @elseif($type == "today")
    Laporan Peminjaman Hari ini
    @elseif($type == "broken")
    Laporan Barang Kerusakan
    @endif
</h1>
<p class="tgl-cetak">Tanggal Cetak : {{ date("D").",".date("y-m-d") }}</p>
<p class="nama">Nama Pencetak : {{ Auth::user()->name }}</p>
@if($type == "all" || $type == "today")
<table width="100%" border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Borrow Date</th>
            <th>Return Date</th>
            <th>Confirmed By</th>
            <th>Borrow Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $row->borrow_date }}</td>
            <td>{{ $row->return_date }}</td>
            <td>
                @if($row->user_id == null)
                
                @else
                {{ $row->user->name }}
                @endif
            </td>
            <td class="text-center">
                @if($row->borrow_status == "Approved")
                <span class="badge badge-success">Approved</span>
                @endif
                @if($row->borrow_status == "Denied")
                <span class="badge badge-danger">Denied</span>
                @endif
                @if($row->borrow_status == "Booking")
                <span class="badge badge-warning">Booking</span>
                @endif
                @if($row->borrow_status == "Postponed")
                <span class="badge badge-info">Postponed</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@elseif($type == "broken")
<table width="100%" border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Item Name | Item Code</th>
            <th>Total</th>
            <th>Broken Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $row->name }} | {{ $row->inventary_code }}</td>
            <td>{{ $row->mount }}</td>
            <td>{{ $row->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<script>
    window.print();
</script>
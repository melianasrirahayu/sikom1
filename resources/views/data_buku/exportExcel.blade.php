
</table>
<table>
    <thead>
    <tr>
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">No</th> <!-- kolom A -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Judul</th> <!-- kolom B -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Penulis</th> <!-- kolom C -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Penerbit</th> <!-- kolom D -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Tahun Terbit</th> <!-- kolom E -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Waktu Input</th> <!-- kolom F -->
    </tr>
    </thead>
    <tbody>
    @php $no=1; @endphp
    @if(count($data))
    @foreach($data as $dt)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$dt->judul??''}}</td>
            <td>{{$dt->penulis??''}}</td>
            <td>{{$dt->penerbit??''}}</td>
            <td>{{$dt->tahun_terbit??''}}</td>
            <td>{{$dt->created_at??''}}</td>
        </tr>
    @endforeach
    @endif
    </tbody>
</table>
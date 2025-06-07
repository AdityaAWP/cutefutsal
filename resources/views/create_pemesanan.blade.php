<form action="{{ route('pemesanans.store') }}" method="POST">
    @csrf
    <input type="text" name="nama" placeholder="Masukkan nama lengkap"><br>
    <input type="text" name="no_hp" placeholder="08xxxxxxxxxx"><br>
    <input type="date" name="tgl_main"><br>
    <input type="time" name="waktu_main"><br>
    <select name="lapangan_id">
        @foreach ($lapangans as $lapangan)
            <option value="{{ $lapangan->id }}">{{ $lapangan->nama_lapangan }}</option>
        @endforeach
    </select><br>
    <button type="submit">Simpan</button>
</form>

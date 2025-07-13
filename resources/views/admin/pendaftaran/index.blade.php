@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">📋 Data Pendaftar</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="notif-alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif


    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover table-striped align-middle mb-0">
            <thead class="table-success text-center">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Asal Sekolah</th>
                    <th>Jurusan</th>
                    <th>Tanggal Lahir</th>
                    <th>Status</th>
                    <th>Gelombang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($pendaftarans as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->user->email ?? '-' }}</td>
                        <td>{{ $item->asal_sekolah }}</td>
                        <td>
                            @if($item->jurusan)
                                <span class="badge bg-info text-dark">{{ $item->jurusan->nama_jurusan }}</span>
                            @else
                                <span class="badge bg-secondary">Belum Pilih</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td>
                            <form action="{{ route('admin.pendaftaran.status', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="menunggu" {{ $item->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="diterima" {{ $item->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </form>
                            <th>
                                
                                     <form action="{{ route('admin.pendaftaran.updateGelombang', $item->id) }}" method="POST">
                                    @csrf
                                @method('PATCH')
                                <select name="gelombang_id" class="form-select form-select-sm" onchange="this.form.submit()">
                                    @foreach ($gelombangAktif as $gel)
                                        <option value="{{ $gel->id }}" {{ $gel->id == $item->gelombang_id ? 'selected' : '' }}>
                                            {{ $gel->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                </form>

                        </th>
                        </td>
                        <td>
                            <a href="{{ route('admin.pendaftaran.show', $item->id) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.pendaftaran.destroy', $item->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            
                        </td>
                                        </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-muted">Belum ada data pendaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    setTimeout(() => {
        const notif = document.getElementById('notif-alert');
        if (notif) {
            notif.classList.remove('show');
            notif.classList.add('fade');
            notif.style.opacity = 0;
        }
    }, 2000); // 2 detik
</script>
@endpush

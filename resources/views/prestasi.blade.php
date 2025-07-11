@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5">Prestasi SMKN 1 Manokwari</h2>

    <div class="row g-4">
        @foreach([
            ['judul' => 'Juara 1 Lomba Web Design', 'tingkat' => 'Nasional', 'icon' => 'fa-laptop-code', 'deskripsi' => 'Meraih juara dalam ajang desain web tingkat nasional.'],
            ['judul' => 'Olimpiade Sains Kabupaten', 'tingkat' => 'Kabupaten', 'icon' => 'fa-atom', 'deskripsi' => 'Memenangkan kompetisi olimpiade sains tingkat kabupaten.'],
            ['judul' => 'Gold Medal Robotic Asia', 'tingkat' => 'Internasional', 'icon' => 'fa-robot', 'deskripsi' => 'Prestasi emas dalam kompetisi robotik tingkat Asia.'],
            ['judul' => 'Juara 2 LKS IT Network', 'tingkat' => 'Nasional', 'icon' => 'fa-network-wired', 'deskripsi' => 'Runner-up di lomba kompetensi siswa bidang jaringan.'],
            ['judul' => 'Juara Futsal Kabupaten', 'tingkat' => 'Kabupaten', 'icon' => 'fa-futbol', 'deskripsi' => 'Membawa pulang piala dalam turnamen futsal antar sekolah.'],
            ['judul' => 'Best Mobile App ASEAN', 'tingkat' => 'Internasional', 'icon' => 'fa-mobile-alt', 'deskripsi' => 'Aplikasi terbaik versi pelajar di ajang ASEAN.'],
            ['judul' => 'Juara Pidato Bahasa Inggris', 'tingkat' => 'Nasional', 'icon' => 'fa-microphone', 'deskripsi' => 'Pidato inspiratif meraih juara di tingkat nasional.'],
            ['judul' => 'Cerdas Cermat Kabupaten', 'tingkat' => 'Kabupaten', 'icon' => 'fa-lightbulb', 'deskripsi' => 'Menjuarai lomba cerdas cermat antar pelajar.'],
            ['judul' => 'Silver Medal WorldSkills', 'tingkat' => 'Internasional', 'icon' => 'fa-globe', 'deskripsi' => 'Mendapat medali perak di WorldSkills bidang TI.'],
            ['judul' => 'Juara 3 Akuntansi SMK', 'tingkat' => 'Nasional', 'icon' => 'fa-calculator', 'deskripsi' => 'Akuntansi teliti meraih tempat ketiga nasional.'],
            ['judul' => 'Juara Tari Daerah', 'tingkat' => 'Kabupaten', 'icon' => 'fa-masks-theater', 'deskripsi' => 'Menampilkan tarian Papua terbaik tingkat kabupaten.'],
            ['judul' => 'Juara Desain Grafis', 'tingkat' => 'Nasional', 'icon' => 'fa-paint-brush', 'deskripsi' => 'Desain kreatif membawa siswa ke puncak nasional.'],
            ['judul' => 'Film Pendek Pelajar', 'tingkat' => 'Nasional', 'icon' => 'fa-film', 'deskripsi' => 'Film bertema pendidikan sukses raih penghargaan.'],
            ['judul' => 'Juara Cooking Competition', 'tingkat' => 'Kabupaten', 'icon' => 'fa-utensils', 'deskripsi' => 'Kompetisi memasak antar SMK di kabupaten.'],
            ['judul' => 'Finalis Google Code-In', 'tingkat' => 'Internasional', 'icon' => 'fa-code', 'deskripsi' => 'Siswa berhasil masuk final kompetisi global coding.'],
            ['judul' => 'Lomba Essay Keuangan', 'tingkat' => 'Nasional', 'icon' => 'fa-pen-nib', 'deskripsi' => 'Essay ekonomi terbaik di lomba tingkat nasional.'],
            ['judul' => 'Poster Edukasi Kesehatan', 'tingkat' => 'Kabupaten', 'icon' => 'fa-notes-medical', 'deskripsi' => 'Kampanye kesehatan siswa melalui poster visual.'],
            ['judul' => 'Perhotelan Expo Asia', 'tingkat' => 'Internasional', 'icon' => 'fa-hotel', 'deskripsi' => 'Pameran keterampilan hospitality se-Asia.'],
            ['judul' => 'Juara Matematika SMK', 'tingkat' => 'Nasional', 'icon' => 'fa-square-root-variable', 'deskripsi' => 'Logika dan kecepatan hitung diakui nasional.'],
            ['judul' => 'Juara Teknologi Hijau', 'tingkat' => 'Kabupaten', 'icon' => 'fa-leaf', 'deskripsi' => 'Inovasi ramah lingkungan untuk masa depan.'],
            ['judul' => 'Juara Favorit UI/UX Design Nasional','tingkat' => 'Nasional','icon' => 'fa-object-group', 'deskripsi' => 'Desain antarmuka kreatif meraih suara terbanyak dalam kompetisi UI/UX tingkat nasional.']
        ] as $item)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid {{ $item['icon'] }} fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">{{ $item['judul'] }}</h5>
                    <p class="text-muted mb-1"><strong>Tingkat:</strong> {{ $item['tingkat'] }}</p>
                    <p class="text-secondary">{{ $item['deskripsi'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRO-MENTOR — Daftar Mentor</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media(max-width:768px) {
            body {
                padding-bottom: 20px;
            }
            .pm-card {
                padding: 16px !important;
            }
            /* Form grid responsive */
            div[style*="grid-template-columns:1fr 1fr"] {
                grid-template-columns: 1fr !important;
            }
            /* Alert responsive */
            div[style*="display:flex;gap:10px"] {
                flex-direction: column;
                gap: 8px !important;
            }
            /* Submit button area */
            div[style*="display:flex;justify-content:space-between"] {
                flex-direction: column;
                gap: 12px;
                align-items: stretch !important;
            }
            .pm-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
@include('mahasiswa.partials.nav')

<div style="padding:20px 24px;max-width:860px;margin:0 auto;">

    @if($sudahDaftar)
        <div style="background:#fef3c7;border:1px solid #fcd34d;border-radius:8px;padding:14px 16px;margin-bottom:16px;font-size:13px;color:#92400e;display:flex;gap:10px;">
            <i data-lucide="alert-triangle" style="width:20px;height:20px;flex-shrink:0;"></i>
            <div>
                Anda sudah mengirimkan pendaftaran. Status saat ini: <strong>{{ ucfirst($pendaftaran->status) }}</strong>.<br>
                Silakan cek halaman <a href="{{ route('mahasiswa.seleksi') }}" style="color:#185FA5;font-weight:600;">Status Seleksi</a> untuk informasi lebih lanjut.
            </div>
        </div>
    @endif

    <div style="font-size:15px;font-weight:600;margin-bottom:16px;">Formulir Pendaftaran Mentor PRO-MENTOR 2026</div>

    <div class="pm-card">
        <form method="POST" action="{{ route('mahasiswa.daftar.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- BARIS 1: Nama + NIM --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
                <div>
                    <label class="pm-label">Nama Lengkap</label>
                    <input type="text" name="name" class="pm-input" value="{{ old('name', $user->name) }}"
                        placeholder="Masukkan nama lengkap" {{ $sudahDaftar ? 'disabled' : '' }}>
                    @error('name')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="pm-label">NIM</label>
                    <input type="text" name="nim" class="pm-input" value="{{ old('nim', $user->nim) }}"
                        placeholder="Contoh: 220209001" {{ $sudahDaftar ? 'disabled' : '' }}>
                    @error('nim')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- BARIS 2: Prodi + Semester --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
                <div>
                    <label class="pm-label">Program Studi</label>
                    <select name="prodi" class="pm-input" {{ $sudahDaftar ? 'disabled' : '' }}>
                        <option value="">Pilih Prodi</option>
                        <option value="PTIK"            {{ old('prodi',$user->prodi)==='PTIK'            ?'selected':'' }}>PTIK</option>
                        <option value="Teknik Komputer" {{ old('prodi',$user->prodi)==='Teknik Komputer' ?'selected':'' }}>Teknik Komputer</option>
                    </select>
                    @error('prodi')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="pm-label">Semester Aktif</label>
                    <select name="semester" class="pm-input" {{ $sudahDaftar ? 'disabled' : '' }}>
                        <option value="">Pilih Semester</option>
                        @for($s=1;$s<=8;$s++)
                            <option value="{{ $s }}" {{ old('semester',$user->semester)==$s?'selected':'' }}>Semester {{ $s }}</option>
                        @endfor
                    </select>
                    @error('semester')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- BARIS 3: IPK + No WA --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
                <div>
                    <label class="pm-label">IPK Terakhir</label>
                    <input type="text" name="ipk" class="pm-input" value="{{ old('ipk', $user->ipk) }}"
                        placeholder="Contoh: 3.75" {{ $sudahDaftar ? 'disabled' : '' }}>
                    @error('ipk')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="pm-label">No. WhatsApp Aktif</label>
                    <input type="text" name="no_wa" class="pm-input" value="{{ old('no_wa', $user->no_wa) }}"
                        placeholder="0812xxxxxxxx" {{ $sudahDaftar ? 'disabled' : '' }}>
                    @error('no_wa')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- BARIS 4: Email --}}
            <div style="margin-bottom:12px;">
                <label class="pm-label">Email Aktif</label>
                <input type="email" name="email" class="pm-input" value="{{ old('email', $user->email) }}"
                    placeholder="nama@email.com" {{ $sudahDaftar ? 'disabled' : '' }}>
                @error('email')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
            </div>

            {{-- Pengalaman --}}
            <div style="margin-bottom:12px;">
                <label class="pm-label">Pengalaman Organisasi / Kepanitiaan</label>
                <textarea name="pengalaman_organisasi" id="pengalaman_organisasi" class="pm-input" rows="4"
                    maxlength="255"
                    placeholder="Ceritakan pengalaman organisasi atau kepanitiaan yang pernah diikuti..."
                    {{ $sudahDaftar ? 'disabled' : '' }}>{{ old('pengalaman_organisasi') }}</textarea>
                <div style="font-size:11px;color:#888;margin-top:4px;text-align:right;">
                    <span id="char_count">0</span>/255 karakter
                </div>
                @error('pengalaman_organisasi')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
            </div>

            {{-- Ketersediaan Waktu --}}
            <div style="margin-bottom:12px;">
                <label class="pm-label">Ketersediaan Waktu (jam per minggu)</label>
                <select name="ketersediaan_waktu" class="pm-input" {{ $sudahDaftar ? 'disabled' : '' }}>
                    <option value="">Pilih</option>
                    <option value="1-2" {{ old('ketersediaan_waktu')==='1-2' ?'selected':'' }}>1-2 jam per minggu</option>
                    <option value="2-3" {{ old('ketersediaan_waktu')==='2-3' ?'selected':'' }}>2-3 jam per minggu</option>
                    <option value="3-4" {{ old('ketersediaan_waktu')==='3-4' ?'selected':'' }}>3-4 jam per minggu</option>
                    <option value="4+"  {{ old('ketersediaan_waktu')==='4+'  ?'selected':'' }}>4+ jam per minggu</option>
                </select>
                @error('ketersediaan_waktu')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
            </div>

            {{-- Motivation Letter --}}
            <div style="margin-bottom:12px;">
                <label class="pm-label">Motivation Letter (PDF) <span style="color:#991b1b;">*</span></label>
                <div style="font-size:11px;color:#888;margin-bottom:4px;">Unggah motivation letter untuk menjadi pro-mentor.</div>
                <input type="file" name="motivation_letter" class="pm-input" accept="application/pdf" {{ $sudahDaftar ? 'disabled' : '' }}>
                @error('motivation_letter')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
            </div>

            {{-- KHS Terbaru --}}
            <div style="margin-bottom:12px;">
                <label class="pm-label">KHS Terbaru (PDF) <span style="color:#991b1b;">*</span></label>
                <div style="font-size:11px;color:#888;margin-bottom:4px;">Unggah Kartu Hasil Studi (KHS) semester terakhir.</div>
                <input type="file" name="khs" class="pm-input" accept="application/pdf" {{ $sudahDaftar ? 'disabled' : '' }}>
                @error('khs')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
            </div>

            {{-- Sertifikat Organisasi --}}
            <div style="margin-bottom:12px;">
                <label class="pm-label">Sertifikat Organisasi (PDF, Opsional)</label>
                <div style="font-size:11px;color:#888;margin-bottom:4px;">Unggah Sertifikat Organisasi (Jika ada)</div>
                <input type="file" name="sertifikat_organisasi" class="pm-input" accept="application/pdf" {{ $sudahDaftar ? 'disabled' : '' }}>
                @error('sertifikat_organisasi')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
            </div>

            {{-- Sertifikat Mentoring --}}
            <div style="margin-bottom:20px;">
                <label class="pm-label">Sertifikat Mentoring / Pelatihan (PDF, Opsional)</label>
                <div style="font-size:11px;color:#888;margin-bottom:4px;">Unggah sertifikat pelatihan atau program mentoring yang pernah diikuti (Jika ada)</div>
                <input type="file" name="sertifikat_mentoring" class="pm-input" accept="application/pdf" {{ $sudahDaftar ? 'disabled' : '' }}>
                @error('sertifikat_mentoring')<div style="color:#991b1b;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
            </div>

            {{-- SUBMIT --}}
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <div style="font-size:12px;color:#888;">Pastikan semua data terisi dengan <strong>benar</strong>.</div>
                @if(!$sudahDaftar)
                    <button type="submit" class="pm-btn pm-btn-primary" style="padding:10px 24px;font-size:14px;font-weight:600;">
                        Kirim Pendaftaran
                    </button>
                @else
                    <div style="font-size:13px;color:#166534;font-weight:600;display:flex;align-items:center;gap:6px;">
                        <i data-lucide="check-circle-2" style="width:16px;height:16px;"></i> Pendaftaran sudah terkirim
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>

<div style="text-align:center;padding:16px;font-size:11px;color:#aaa;border-top:1px solid #e8eaed;margin-top:20px;">PRO-MENTOR v1.0 · JTIK UNM · 2026</div>

<script>
    lucide.createIcons();

    // Character counter untuk pengalaman_organisasi
    const textarea = document.getElementById('pengalaman_organisasi');
    const charCount = document.getElementById('char_count');
    
    if (textarea && charCount) {
        // Update counter saat halaman dimuat
        charCount.textContent = textarea.value.length;
        
        // Update counter saat user mengetik
        textarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
            
            // Ubah warna jika mendekati limit
            if (this.value.length >= 240) {
                charCount.style.color = '#dc2626'; // merah
                charCount.style.fontWeight = '600';
            } else if (this.value.length >= 200) {
                charCount.style.color = '#ea580c'; // orange
                charCount.style.fontWeight = '600';
            } else {
                charCount.style.color = '#888';
                charCount.style.fontWeight = '400';
            }
        });
    }
</script>
</body></html>

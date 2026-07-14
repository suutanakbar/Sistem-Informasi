# Indeks Dokumentasi

Dokumentasi resmi Sistem Informasi Ormada Temanggung. Baseline dokumen utama diperbarui pada **14 Juli 2026** berdasarkan implementasi commit `996e563`.

## Dokumen Utama

1. **[Product Requirements Document (PRD)](./PRD.md)**
   Ruang lingkup produk, persona, requirement per modul, matriks akses, alur bisnis, risiko, dan backlog.

2. **[Technical Design Document (TDD)](./TDD.md)**
   Arsitektur aktual, stack, route, autentikasi/otorisasi, skema data, validasi, storage, testing, operasional, dan technical debt.

## Rencana Implementasi Historis

Dokumen berikut dipertahankan sebagai referensi historis. Jika terdapat perbedaan, PRD/TDD terbaru dan implementasi aplikasi menjadi acuan utama.

- [Login Admin](./IMPLEMENTATION_PLAN_LOGIN_ADMIN.md)
- [Public Dashboard](./IMPLEMENTATION_PLAN_PUBLIC_DASHBOARD.md)
- [Profil Anggota](./IMPLEMENTATION_PLAN_PROFIL_ANGGOTA.md)
- [Postingan dan Agenda](./IMPLEMENTATION_PLAN_POSTINGAN_AGENDA.md)
- [Aspirasi](./IMPLEMENTATION_PLAN_ASPIRASI.md)
- [Role-based Views](./IMPLEMENTATION_PLAN_ROLE_BASED_VIEWS.md)
- [Modul Berikutnya](./IMPLEMENTATION_PLAN_NEXT_MODULES.md)
- [Hak Akses Agenda](./AGENDA_PERMISSIONS.md)
- [Ringkasan Solusi](./SOLUTION_SUMMARY.md)

## Upload dan Storage

- [Panduan Perbaikan Upload](./README_FILE_UPLOAD_FIX.md)
- [Troubleshooting Upload](./TROUBLESHOOTING_FILE_UPLOAD.md)
- [Contoh Implementasi Helper](./EXAMPLE_IMPLEMENTATION.md)

## Aturan Pemeliharaan

- Perubahan requirement produk harus memperbarui `PRD.md`.
- Perubahan route, skema, authorization, dependency, atau arsitektur harus memperbarui `TDD.md`.
- Fitur yang belum diimplementasikan harus diberi label backlog/rencana, bukan ditulis sebagai kemampuan aktif.
- Tanggal, versi dokumen, dan sumber commit diperbarui bersama perubahan besar.
</parameter>
<task_progress>
- [x] Menganalisis dokumentasi dan implementasi aplikasi terkini
- [x] Menyusun struktur PRD dan TDD yang sesuai kondisi aktual
- [x] Membuat dokumen PRD dan TDD di folder docs
- [ ] Memvalidasi isi dokumen terhadap codebase
</task_progress>
</write_to_file>
# Sistem CRUD Tracer Study

## Overview

Sistem CRUD (Create, Read, Update, Delete) untuk Tracer Study telah berhasil diimplementasikan dengan fitur lengkap untuk admin dan user/alumni.

## Fitur yang Tersedia

### 1. Admin Panel

-   **Index**: Menampilkan semua data tracer dengan pagination
-   **Create**: Form untuk menambah data tracer baru
-   **Show**: Detail lengkap data tracer
-   **Edit**: Form untuk mengedit data tracer
-   **Delete**: Hapus data tracer

### 2. User/Alumni Panel

-   **Index**: Menampilkan data tracer milik alumni yang login
-   **Create**: Form untuk menambah data tracer baru
-   **Show**: Detail data tracer
-   **Edit**: Form untuk mengedit data tracer
-   **Delete**: Hapus data tracer

## Struktur Database

### Model Tracer

```php
protected $fillable = [
    'alumni_id',
    'mulai_kerja',
    'nama_instansi',
    'jabatan',
    'kesesuaian_kerja',
    'kelurahan',
    'kab_kota',
    'provinsi',
    'kode_pos',
    'tgl_update',
];
```

### Relasi

-   `Alumni` has many `Tracer`
-   `Tracer` belongs to `Alumni`

## Routes

### Admin Routes

```php
Route::resource('tracer', TracerController::class, ['as' => 'admin']);
```

### User Routes

```php
Route::resource('tracer', TracerUserController::class, ['as' => 'user']);
```

## Validasi

### Store/Update Request

-   `alumni_id`: Required, exists in alumni table
-   `mulai_kerja`: Required, date format
-   `nama_instansi`: Required, max 255 characters
-   `jabatan`: Required, max 255 characters
-   `kesesuaian_kerja`: Required, max 255 characters
-   `kelurahan`: Required, max 255 characters
-   `kab_kota`: Required, max 255 characters
-   `provinsi`: Required, max 255 characters
-   `kode_pos`: Required, max 10 characters
-   `tgl_update`: Required, date format

## Authorization (Policy)

### TracerPolicy

-   **Admin**: Dapat mengakses semua data tracer
-   **Alumni**: Hanya dapat mengakses data tracer milik mereka sendiri

## Views

### Admin Views

-   `resources/views/admin/tracer_index.blade.php`
-   `resources/views/admin/tracer_create.blade.php`
-   `resources/views/admin/tracer_show.blade.php`
-   `resources/views/admin/tracer_edit.blade.php`

### User Views

-   `resources/views/user/tracer/index.blade.php`
-   `resources/views/user/tracer/create.blade.php`
-   `resources/views/user/tracer/show.blade.php`
-   `resources/views/user/tracer/edit.blade.php`
-   `resources/views/user/tracer/form.blade.php`

## Cara Penggunaan

### Untuk Admin

1. Login sebagai admin
2. Akses `/admin/tracer` untuk melihat semua data
3. Klik "Tambah Tracer" untuk menambah data baru
4. Klik "Detail", "Edit", atau "Hapus" untuk mengelola data

### Untuk Alumni

1. Login sebagai alumni
2. Akses `/user/tracer` untuk melihat data tracer mereka
3. Klik "Tambah Tracer" untuk menambah data baru
4. Klik "Detail", "Edit", atau "Hapus" untuk mengelola data

## Keamanan

-   Menggunakan Laravel Policy untuk authorization
-   Validasi input yang ketat
-   CSRF protection
-   SQL injection protection melalui Eloquent ORM

## Catatan

-   Pastikan user memiliki role yang sesuai untuk mengakses fitur admin
-   Alumni harus memiliki data di tabel alumni untuk dapat mengakses fitur tracer
-   Semua tanggal menggunakan format Y-m-d untuk input dan d/m/Y untuk display

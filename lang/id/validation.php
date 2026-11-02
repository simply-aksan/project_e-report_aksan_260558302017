<?php

return [
    'required' => ':attribute wajib diisi.',
    'string' => ':attribute harus berupa teks.',
    'email' => 'Format email tidak valid.',
    'unique' => ':attribute sudah terdaftar.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'current_password' => 'Password saat ini tidak sesuai.',
    'different' => ':attribute harus berbeda dengan :other.',
    'regex' => 'Format :attribute tidak valid. Gunakan 9–15 digit, boleh diawali +.',
    'date_format' => 'Format :attribute harus tahun-bulan-tanggal.',
    'before_or_equal' => ':attribute tidak boleh di masa depan.',
    'image' => ':attribute harus berupa gambar.',
    'mimes' => ':attribute harus berformat: :values.',
    'uploaded' => ':attribute gagal diunggah.',
    'in' => ':attribute tidak valid.',
    'max' => [
        'string' => ':attribute maksimal :max karakter.',
        'file' => ':attribute maksimal :max KB.',
    ],
    'min' => ['string' => ':attribute minimal :min karakter.'],
    'password' => [
        'letters' => ':attribute harus mengandung huruf.',
        'numbers' => ':attribute harus mengandung angka.',
        'mixed' => ':attribute harus mengandung huruf besar dan kecil.',
        'symbols' => ':attribute harus mengandung simbol.',
    ],
    'attributes' => [
        'name' => 'Nama lengkap', 'email' => 'Email', 'password' => 'Password',
        'no_whatsapp' => 'Nomor WhatsApp', 'alamat' => 'Alamat', 'foto' => 'Foto',
        'judul' => 'Judul pengaduan', 'detail' => 'Deskripsi', 'tanggal' => 'Tanggal kejadian',
        'current_password' => 'Password saat ini', 'status' => 'Status',
    ],
];
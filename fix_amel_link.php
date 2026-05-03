<?php
use App\Models\User;
use App\Models\alumni;

$u = User::where('name', 'Amel')->first();
if ($u) {
    // Create NEW alumni record for Amel
    $a = alumni::create([
        'nama' => 'Amel',
        'nim' => $u->nim,
        'email' => $u->email,
        'no_hp' => '-',
        'angkatan' => '-',
        'tahun_lulus' => '-',
        'program_studi' => '-',
        'password' => $u->password,
        'jenis_kelamin' => 'perempuan',
        'alamat' => '-',
        'bio' => '',
        'linkedin' => '',
        'skill' => ''
    ]);
    $u->alumni_id = $a->id;
    $u->save();
    echo "Corrected profile for: Amel. New Alumni ID: " . $a->id . PHP_EOL;
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV ATS - {{ $user->name }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; line-height: 1.4; color: #000; font-size: 11pt; margin: 0 20px; }
        h1 { font-size: 24pt; text-transform: uppercase; margin-bottom: 5px; text-align: center; }
        .contact-info { text-align: center; font-size: 10pt; margin-bottom: 20px; }
        .contact-info span { margin: 0 5px; }
        h2 { font-size: 14pt; border-bottom: 1px solid #000; padding-bottom: 3px; margin-top: 20px; margin-bottom: 10px; text-transform: uppercase; }
        .item { margin-bottom: 15px; }
        .item-header { font-weight: bold; }
        .item-sub { font-style: italic; font-size: 10.5pt; color: #333; }
        .item-date { float: right; font-size: 10.5pt; }
        .skills { font-size: 10.5pt; }
    </style>
</head>
<body>

    <h1>{{ $user->name }}</h1>
    <div class="contact-info">
        <span>{{ $user->email }}</span> | 
        <span>{{ $alumni->no_hp ?? 'No HP Belum Diisi' }}</span> | 
        <span>{{ $alumni->alamat ?? 'Alamat Belum Diisi' }}</span>
        @if($alumni->linkedin)
            <br><span>LinkedIn: {{ $alumni->linkedin }}</span>
        @endif
    </div>

    @if($alumni->bio)
    <h2>Professional Summary</h2>
    <p>{{ $alumni->bio }}</p>
    @endif

    <h2>Work Experience</h2>
    @php
        $hasExperience = false;
    @endphp

    @foreach($tracers as $tracer)
        @if($tracer->status == 'bekerja' && $tracer->alumni->bekerja)
            @php $hasExperience = true; @endphp
            <div class="item">
                <span class="item-header">{{ $tracer->alumni->bekerja->soal_2 }}</span>
                <span class="item-date">{{ \Carbon\Carbon::parse($tracer->tanggal_mulai)->format('M Y') }} - Present</span>
                <div class="item-sub">{{ $tracer->alumni->bekerja->soal_1 }}</div>
            </div>
        @elseif($tracer->status == 'wiraswasta' && $tracer->alumni->wiraswasta)
            @php $hasExperience = true; @endphp
            <div class="item">
                <span class="item-header">Business Owner / Founder</span>
                <span class="item-date">{{ \Carbon\Carbon::parse($tracer->tanggal_mulai)->format('M Y') }} - Present</span>
                <div class="item-sub">{{ $tracer->alumni->wiraswasta->soal_1 }} ({{ $tracer->alumni->wiraswasta->soal_2 }})</div>
            </div>
        @endif
    @endforeach

    @if(!$hasExperience)
        <p>Fresh Graduate</p>
    @endif

    <h2>Education</h2>
    
    @foreach($tracers as $tracer)
        @if($tracer->status == 'melanjutkan_pendidikan' && $tracer->alumni->melanjutkanPendidikan)
            <div class="item">
                <span class="item-header">{{ $tracer->alumni->melanjutkanPendidikan->soal_1 }}</span>
                <span class="item-date">{{ \Carbon\Carbon::parse($tracer->tanggal_mulai)->format('Y') }} - Present</span>
                <div class="item-sub">{{ $tracer->alumni->melanjutkanPendidikan->soal_3 }} in {{ $tracer->alumni->melanjutkanPendidikan->soal_2 }}</div>
            </div>
        @endif
    @endforeach

    <div class="item">
        <span class="item-header">Universitas Sugeng Hartono</span>
        <span class="item-date">Class of {{ $alumni->angkatan }}</span>
        <div class="item-sub">Bachelor's Degree in {{ $alumni->program_studi }}</div>
    </div>

    @if($alumni->skill)
    <h2>Skills & Competencies</h2>
    <div class="skills">
        {{ $alumni->skill }}
    </div>
    @endif

</body>
</html>
<div class="w-full md:w-1/4">
    <div class="bg-white rounded-xl shadow-sm p-5 text-center sticky top-24 border border-gray-100">
        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 text-blue-600 text-2xl font-bold border-4 border-blue-50 shadow-sm">
            {{ substr(Auth::user()->name, 0, 1) }} 
        </div>
        <h2 class="text-lg font-bold text-gray-900 truncate">{{ Auth::user()->name }}</h2>
        <p class="text-gray-500 text-xs mb-5">Mahasiswa / Alumni</p>

        <div class="space-y-1 text-left">
            
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }}">
                <i class="fas fa-th-large w-4 text-center"></i> Overview
            </a>

            <a href="{{ route('user.tracer.create') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('user.tracer.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }}">
                <i class="fas fa-edit w-4 text-center"></i> Update Tracer
            </a>

            <a href="{{ route('user.lamaran.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('user.lamaran.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }}">
                <i class="fas fa-file-alt w-4 text-center"></i> Lamaran Saya
            </a>

            <a href="{{ route('user.bookmark.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('user.bookmark.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }}">
                <i class="fas fa-bookmark w-4 text-center"></i> Bookmark
            </a>

            <a href="{{ route('dashboard') }}#recommendation-section" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                <i class="fas fa-magic w-4 text-center"></i> Rekomendasi
            </a>

        </div>
    </div>
</div>
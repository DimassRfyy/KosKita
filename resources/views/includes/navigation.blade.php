<div id="BottomNav" class="relative flex w-full h-[138px] shrink-0">
    <nav class="fixed bottom-5 w-full max-w-[640px] px-5 z-10">
        <div class="grid grid-cols-4 h-fit rounded-[40px] justify-between py-4 px-5 bg-ngekos-black">
            <a href="{{ route('index') }}" class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('assets/images/icons/' . (request()->routeIs(['index', 'kosByCategory', 'kosByCity']) ? 'global-green.svg' : 'global.svg')) }}" class="w-8 h-8 flex shrink-0" alt="icon">
                <span class="font-semibold text-sm text-white">Discover</span>
            </a>
            <a href="{{ route('check') }}" class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('assets/images/icons/' . (request()->routeIs('check') ? 'note-favorite-green.svg' : 'note-favorite.svg')) }}" class="w-8 h-8 flex shrink-0" alt="icon">
                <span class="font-semibold text-sm text-white">Orders</span>
            </a>
            <a href="{{ route('find') }}" class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('assets/images/icons/' . (request()->routeIs(['result_find','find']) ? 'search-status-green.svg' : 'search-status.svg')) }}" class="w-8 h-8 flex shrink-0" alt="icon">
                <span class="font-semibold text-sm text-white">Find</span>
            </a>
            <a href="#" class="flex flex-col items-center text-center gap-2">
                <img src="{{ asset('assets/images/icons/' . (request()->routeIs('admin') ? '24-support-green.svg' : '24-support.svg')) }}" class="w-8 h-8 flex shrink-0" alt="icon">
                <span class="font-semibold text-sm text-white">Admin</span>
            </a>
        </div>        
    </nav>
    </div>
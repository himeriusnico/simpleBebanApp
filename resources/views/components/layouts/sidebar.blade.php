<div x-data="{ open: false }" class="relative flex h-screen w-full">

    <nav class="md:w-64 md:flex flex-col bg-white border-r border-gray-200 overflow-hidden shrink-0"
        :class="open ? 'flex w-64' : 'hidden md:flex'">

        <div class="h-16 flex items-center px-4 border-b border-gray-200">
            <span class="font-semibold text-gray-800">Beban App</span>
        </div>

        <div class="flex flex-col flex-1 px-2 py-4 gap-1 overflow-y-auto">

            <a href="{{ route('beban.index') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('beban.index') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>

                Beban
            </a>

            @if(Auth::user()->isAdmin())
                <a href="{{ route('kategori_beban.index') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium
                                                            {{ request()->routeIs('kategori_beban.index') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>


                    Kategori Beban
                </a>
            @endif

        </div>

        <div class="border-t border-gray-200 px-4 py-3">
            <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>

            <div class="flex items-center">
                <p class="text-xs text-gray-400 capitalize">{{ auth()->user()->role }}</p>

                <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </nav>

    {{-- <div class="flex flex-col flex-1 overflow-hidden">

        <header class="h-16 bg-white border-b border-gray-200 flex items-center px-6 shrink-0">

            <button @click="open = !open" class="md:hidden text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                @csrf
                <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium">
                    Logout
                </button>
            </form>

        </header>

        <main class="flex-1 overflow-y-auto p-6">
            {{ $slot }}
        </main>

    </div> --}}
    <main class="flex-1 overflow-y-auto p-6">
        {{ $slot }}
    </main>
</div>
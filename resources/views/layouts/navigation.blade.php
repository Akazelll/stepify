<div class="navbar bg-base-100 shadow-sm border-b border-base-200 sticky top-0 z-50">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </div>

            <ul tabindex="-1"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow lg:hidden">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'active font-bold' : '' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('tutorials.index') }}"
                        class="{{ request()->routeIs('tutorials.*') ? 'active font-bold' : '' }}">
                        Master Tutorial
                    </a>
                </li>
            </ul>
        </div>

        <div class="hidden lg:flex gap-2 ml-2">
            <a href="{{ route('dashboard') }}"
                class="btn btn-ghost btn-sm {{ request()->routeIs('dashboard') ? 'bg-base-200 font-bold' : 'font-normal' }}">
                Dashboard
            </a>
            <a href="{{ route('tutorials.index') }}"
                class="btn btn-ghost btn-sm {{ request()->routeIs('tutorials.*') ? 'bg-base-200 font-bold' : 'font-normal' }}">
                Master Tutorial
            </a>
        </div>
    </div>

    <div class="navbar-center">
        <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xl font-bold tracking-tight">
            Stepify
        </a>
    </div>

    <div class="navbar-end gap-2">

        <button class="btn btn-ghost btn-circle hidden sm:flex">
            <div class="indicator">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="badge badge-xs badge-primary indicator-item"></span>
            </div>
        </button>

        <div class="dropdown dropdown-end">
            @php
                $name = Auth::user()->name ?? 'Guest';
                $words = explode(' ', $name);
                $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
            @endphp

            <div tabindex="0" role="button"
                class="btn btn-ghost btn-circle avatar placeholder border border-base-200 hover:border-primary transition-colors">
                <div class="bg-neutral text-neutral-content w-9 rounded-full">
                    <span class="text-sm font-bold">{{ $initials }}</span>
                </div>
            </div>

            <ul tabindex="-1"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-56 p-2 shadow-lg border border-base-200">
                <li class="menu-title px-4 py-3 flex flex-col gap-0.5">
                    <span
                        class="block text-sm font-bold text-base-content truncate">{{ Auth::user()->name ?? 'Creator' }}</span>
                    <span
                        class="block text-xs font-normal opacity-60 truncate">{{ Auth::user()->email ?? 'Dosen' }}</span>
                </li>

                <div class="divider my-0"></div>

                <li>
                    <form method="POST" action="{{ route('logout') }}" class="p-0 m-0 w-full mt-1">
                        @csrf
                        <button type="submit"
                            class="w-full text-left text-error hover:bg-error/10 hover:text-error px-4 py-2.5 flex justify-between items-center rounded-lg font-medium transition-colors">
                            Log Out
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</div>

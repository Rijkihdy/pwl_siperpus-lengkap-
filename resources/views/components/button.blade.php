<!-- resources/views/components/button.blade.php -->
<a href="{{ $href }}" class="block w-full {{ $bgColor }} text-white text-center py-3 rounded-md ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
    {{ $slot }}
</a>

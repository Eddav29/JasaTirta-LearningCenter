<!-- Global Page Loader -->
<div id="page-loader" class="fixed inset-0 z-9999 hidden items-center justify-center bg-white/80 backdrop-blur-sm transition-opacity duration-300">
    <div class="flex flex-col items-center gap-4">
        <!-- Animated Spinner -->
        <div class="relative">
            <!-- Outer Ring -->
            <div class="h-16 w-16 animate-spin rounded-full border-4 border-slate-200 border-t-blue-600"></div>
            
            <!-- Inner Pulse -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="h-8 w-8 animate-pulse rounded-full bg-blue-600/20"></div>
            </div>
        </div>

        <!-- Loading Text -->
        <div class="text-center">
            <p class="text-sm font-medium text-slate-700">Memuat halaman...</p>
            <p class="text-xs text-slate-500">Mohon tunggu sebentar</p>
        </div>

        <!-- Progress Bar (Optional) -->
        <div class="w-48 h-1 bg-slate-200 rounded-full overflow-hidden">
            <div class="h-full bg-linear-to-r from-blue-600 to-blue-400 animate-pulse" style="width: 60%"></div>
        </div>
    </div>
</div>

<style>
    /* Show loader with flex display */
    #page-loader.show {
        display: flex !important;
    }

    /* Prevent body scroll when loader is active */
    body.loading {
        overflow: hidden;
    }

    /* Smooth fade in animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    #page-loader.show {
        animation: fadeIn 0.2s ease-in;
    }
</style>

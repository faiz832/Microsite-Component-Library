@if(session('success') || session('error') || $errors->any())
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mt-4">
        @if(session('success'))
            <div class="flex">
                <span class="text-sm text-green-600 dark:text-green-400 space-y-1">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
                <div class="flex">
                    <span class="text-sm text-red-600 dark:text-red-400 space-y-1">{{ session('error') }}</span>
                </div>
        @endif
        @if($errors->any())
            <div class="flex">
                @foreach ($errors->all() as $error)
                    <span class="text-sm text-red-600 dark:text-red-400 space-y-1">{{ $error }}</span>
                @endforeach
            </div>
        @endif
    </div>
@endif
<ol class="ml-4 flex text-sm leading-6 whitespace-nowrap min-w-0">
    @foreach($segments as $index => $segment)
        <li @class([
            'flex items-center',
            'text-gray-400 dark:text-gray-400' => !$loop->last,
            'font-semibold text-gray-900 truncate dark:text-gray-200' => $loop->last
        ])>
            {{ ucfirst($segment) }}
            
            @if(!$loop->last && count($segments) > 1)
                <svg width="3" height="6" aria-hidden="true" class="mx-3 overflow-visible text-gray-400">
                    <path d="M0 0L3 3L0 6" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                </svg>
            @endif
        </li>
    @endforeach
</ol>
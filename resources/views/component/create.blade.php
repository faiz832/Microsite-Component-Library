<title>CreateComponent - Microsite Component Library</title>

<x-app-layout>
    <div>
        <div class="p-4 sm:p-8 rounded-md border border-gray-200 dark:border-gray-800">
            <div class="max-w-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Create New component') }}
                    </h2>
    
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Please insert a new component.") }}
                    </p>
                </header>
    
                <!-- Success or Error Message -->
                <x-message/>
    
                <div class="">
                    <form method="POST" action="{{ route('component.store') }}" class="space-y-6" style="margin-bottom: 0;">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="version_id" :value="__('Choose Version')" />
                            <select id="version_id" name="version_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm">
                                <option value="" hidden>Select Version</option>
                                @foreach($versions as $version)
                                    <option value="{{ $version->id }}">
                                        {{ ucfirst($version->version) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="mt-4">
                            <x-input-label for="category_id" value="{{ __('Choose Category') }}"/>
                            <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ ucfirst($category->category) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="mt-4">
                            <x-input-label for="component" value="{{ __('Insert Component') }}"/>
        
                            <x-text-input
                                id="component"
                                name="component"
                                type="text"
                                class="mt-1 block w-full"
                                placeholder="{{ __('component') }}"
                                required
                            />
                        </div>
        
                        <div class="mt-6 flex">
                            <a href="{{ route('component.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none disabled:opacity-25 transition">
                                {{ __('Cancel') }}
                            </a>
        
                            <x-confirm-button class="ml-3">
                                {{ __('Create') }}
                            </x-confirm-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Contoh menggunakan jQuery
        $(document).ready(function() {
            $('#version_id').on('change', function() {
                var versionId = $(this).val();
                
                // Kosongkan dan nonaktifkan dropdown kategori
                $('#category_id').empty().prop('disabled', true);
                
                // Jika version dipilih, ambil kategori
                if (versionId) {
                    $.ajax({
                        url: '/get-categories/' + versionId,
                        type: 'GET',
                        success: function(data) {
                            // Tambahkan opsi default
                            $('#category_id').append('<option value="" hidden>Select Category</option>');
                            
                            // Tambahkan kategori yang sesuai
                            $.each(data, function(key, category) {
                                $('#category_id').append('<option value="' + category.id + '">' + category.category + '</option>');
                            });
                            
                            // Aktifkan dropdown kategori
                            $('#category_id').prop('disabled', false);
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
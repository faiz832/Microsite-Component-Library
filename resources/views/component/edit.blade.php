<title>Edit Component - Microsite Component Library</title>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<x-app-layout>
    <div>
        <div class="p-4 sm:p-8 rounded-md border border-gray-200 dark:border-gray-800">
            <div class="">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Edit Existing component') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Please insert a new component.') }}
                    </p>
                </header>

                <!-- Success or Error Message -->
                <x-message />

                <div class="">
                    <form method="POST" action="{{ route('component.update', $components->id) }}" class="space-y-6"
                        style="margin-bottom: 0;">
                        @csrf
                        @method('PATCH')

                        <div class="mt-4 max-w-xl">
                            <x-input-label for="version_id" :value="__('Choose Version')" />
                            <select id="version_id" name="version_id"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm">
                                <option value="" hidden>Select Version</option>
                                @foreach ($versions as $version)
                                    <option value="{{ $version->id }}"
                                        {{ $version->id == $components->version_id ? 'selected' : '' }}>
                                        {{ $version->version }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4 max-w-xl">
                            <x-input-label for="category_id" value="{{ __('Choose Category') }}" />
                            <select id="category_id" name="category_id"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $components->category_id ? 'selected' : '' }}>
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4 max-w-xl">
                            <x-input-label for="component" value="{{ __('Insert Component') }}" />

                            <x-text-input id="component" name="component" type="text" class="mt-1 block w-full"
                                value="{{ $components->component }}" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="note" value="{{ __('Insert Note') }}" />

                            <div id="note-editor"
                                class="h-56 text-base rounded-b-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            </div>
                            <input type="hidden" name="note" id="note" value="{{ $components->note }}">
                        </div>

                        <div class="mt-4">
                            <x-input-label for="html" value="{{ __('Insert HTML Code') }}" />

                            <textarea id="html" name="html" type="text"
                                class="mt-1 block w-full h-56 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm"
                                required>{{ $components->html }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="scss" value="{{ __('Insert SCSS Code') }}" />

                            <textarea id="scss" name="scss" type="text"
                                class="mt-1 block w-full h-56 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm"
                                required>{{ $components->scss }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="js" value="{{ __('Insert JavaScript Code') }}" />

                            <textarea id="js" name="js" type="text"
                                class="mt-1 block w-full h-56 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm">{{ $components->js }}</textarea>
                        </div>

                        <div class="mt-6 flex">
                            <a href="{{ route('component.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none disabled:opacity-25 transition">
                                {{ __('Cancel') }}
                            </a>

                            <x-confirm-button class="ml-3">
                                {{ __('Update') }}
                            </x-confirm-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editorConfigs = [{
                id: 'note-editor',
                inputId: 'note',
                initialValue: @json($components->note), // Get initial value from $components->note
                modules: {}
            }];

            // Editors storage
            const editors = {};

            // Function to check if content is empty or just whitespace
            function isContentEmpty(content) {
                return !content || content === '<p><br></p>' || content.trim() === '';
            }

            // Initialize Quill editors
            editorConfigs.forEach(config => {
                const editorEl = document.getElementById(config.id);
                const inputEl = document.getElementById(config.inputId);

                if (editorEl && inputEl) {
                    const quill = new Quill(editorEl, {
                        theme: 'snow',
                        modules: config.modules,
                    });

                    // Set initial value if provided and not empty
                    if (config.initialValue && !isContentEmpty(config.initialValue)) {
                        quill.root.innerHTML = config.initialValue;
                    }

                    // Store reference to the editor
                    editors[config.id] = {
                        quill: quill,
                        input: inputEl
                    };

                    // Add event listener to update hidden input
                    quill.on('text-change', () => {
                        const content = quill.root.innerHTML;
                        inputEl.value = isContentEmpty(content) ? '' : content;
                    });

                    // Add classes to toolbar
                    const toolbarEl = document.querySelectorAll('.ql-toolbar');

                    if (toolbarEl.length > 0) {
                        toolbarEl.forEach(toolbar => {
                            toolbar.classList.add(
                                'mt-1',
                                'rounded-t-md',
                                'border',
                                'border-gray-300',
                                'dark:border-gray-700',
                                'dark:text-gray-300',
                                'shadow-sm'
                            );
                        });
                    }
                }
            });

            // Form submission
            var form = document.getElementById('componentForm');
            var submitButton = document.getElementById('submitButton');

            submitButton.addEventListener('click', function(e) {
                e.preventDefault();

                // Update all hidden inputs with editor content
                Object.values(editors).forEach(editor => {
                    const content = editor.quill.root.innerHTML;
                    editor.input.value = isContentEmpty(content) ? '' : content;
                });

                form.submit();
            });
        });
    </script>
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
                            $('#category_id').append(
                                '<option value="" hidden>Select Category</option>');

                            // Tambahkan kategori yang sesuai
                            $.each(data, function(key, category) {
                                $('#category_id').append('<option value="' + category
                                    .id + '">' + category.category + '</option>');
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

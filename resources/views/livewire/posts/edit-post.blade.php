<div>
    <form wire:submit.prevent="submit">
        <div class="mt-4">
            <x-input-label for="title" :value="__('Post title')" />
            <x-text-input id="title" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" type="text"
                wire:model="title" placeholder="Your blog post title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="subtitle" :value="__('Subtitle')" />
            <x-text-input id="subtitle" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" type="text"
                wire:model="subtitle" placeholder="Your blog post subtitle" />
            <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="body" :value="__('Body')" />
            <div wire:ignore>
                <textarea id="body" wire:model="body" placeholder="Create an awesome blog post!">
                    {{ $body }} <!-- This will set the initial content of the editor -->

                </textarea>
            </div>

            <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input id="slug" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" type="text"
                wire:model="slug" placeholder="Friendly URL slug" />
            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="excerpt" :value="__('Excerpt')" />
            <textarea id="excerpt" wire:model="excerpt" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
                rows="3" placeholder="Short summary of the post"></textarea>
            <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="meta_description" :value="__('Meta description')" />
            <textarea id="meta_description" wire:model="meta_description"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" rows="3" placeholder="SEO meta description"></textarea>
            <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
        </div>

        <div class="mt-4">
            @if ($featured_image)
                <div class="mt-4">
                    <x-input-label :value="__('Actual image')" />
                    <img src="{{ asset('storage/featured_images/' . $post->featured_image) }}" alt="Actual image"
                        class="mt-2 rounded-md shadow-md md:w-1/2" />
                </div>
            @endif

            <x-input-error :messages="$errors->get('featured_image')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="new_featured_image" :value="__('Featured image')" />
            <x-text-input id="new_featured_image" type="file" wire:model="new_featured_image"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" />
            @if ($new_featured_image)
                <div class="mt-4">
                    <x-input-label :value="__('Image Preview')" />
                    <img src="{{ $new_featured_image->temporaryUrl() }}" alt="Image Preview"
                        class="mt-2 rounded-md shadow-md md:w-1/2" />
                </div>
            @endif
            <x-input-error :messages="$errors->get('new_featured_image')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="category_id" :value="__('Category')" />
            <select id="category_id" wire:model="category_id"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                <option hidden>Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        <!-- Switch featured post -->
        <div x-data="{ 
            isFeatured: @js($post->is_featured ?? false), 
            toggleFeatured: function() { 
                    this.isFeatured = !this.isFeatured; 
                }
            }" 
            class="my-8">
            <label for="is_featured" class="inline-flex items-center gap-3 cursor-pointer">
                <input 
                    id="is_featured" 
                    type="checkbox" 
                    class="sr-only peer" 
                    role="switch" 
                    :checked="isFeatured" 
                    @change="toggleFeatured"
                    wire:model="is_featured"
                />
                <input 
                    type="hidden" 
                    name="is_featured" 
                    :value="isFeatured ? 1 : 0"
                />
                <span class="text-sm font-medium tracking-wide text-slate-700 peer-checked:text-black peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-slate-300 dark:peer-checked:text-white">Featured post</span>
                
                <div 
                    class="relative h-6 w-11 after:h-5 after:w-5 peer-checked:after:translate-x-5 rounded-full border border-slate-300 bg-slate-100 after:absolute after:bottom-0 after:left-[0.0625rem] after:top-0 after:my-auto after:rounded-full after:bg-slate-700 after:transition-all after:content-[''] peer-checked:bg-yellow-500 peer-checked:after:bg-slate-100 peer-focus:outline peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-slate-800 peer-focus:peer-checked:outline-yellow-500 peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:border-slate-700 dark:bg-slate-800 dark:after:bg-slate-300 dark:peer-checked:bg-yellow-500 dark:peer-checked:after:bg-slate-100 dark:peer-focus:outline-slate-300 dark:peer-focus:peer-checked:outline-yellow-500" 
                    aria-hidden="true">
                </div>
            </label>
        </div>

        <div class="flex items-center justify-center">
            <!-- Submit Button -->
            <div class="mt-6 mr-auto">
                <x-primary-button type="submit" class="px-4 py-2">Update post</x-primary-button>
            </div>

            <!-- Delete Button -->
            <div class="mt-6">
                <x-danger-button class="px-4 py-2 ml-auto"
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-post-deletion')">

                    {{ __('Delete post') }}
                </x-danger-button>
            </div>
        </div>
    </form>

    <x-modal name="confirm-post-deletion">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this post?') }}
            </h3>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('You won\'t be able to revert this.') }}
            </p>

            <div class="flex justify-end mt-6">
                <x-secondary-button class="px-4 py-2" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <livewire:posts.delete-post :postId="$post->id" />
            </div>
        </div>
    </x-modal>

    @script
        <script>
            ClassicEditor
                .create(document.querySelector('#body'))
                .then(body => {
                    body.setData(@this.body);
                    body.model.document.on('change:data', () => {
                        @this.set('body', body.getData());
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endscript

    @script
        <script>
            $(document).ready(function() {
                $('#tag_ids').select2({
                    placeholder: 'Select tags'
                });

                $('#tag_ids').on('change', function() {
                    let data = $(this).val();
                    $wire.set('tag_ids', data, false);
                    // $wire.tag_ids = data;
                })
            });
        </script>
    @endscript
    <div>

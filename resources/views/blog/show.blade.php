<x-app-layout>
    <section class="pt-16 sm:pt-32">
        <x-blog-nav-bar />
    </section>
    
    <livewire:blog.show-blog :blog="$blog" />
</x-app-layout>

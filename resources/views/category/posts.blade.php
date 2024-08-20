<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('category.index') }}">
                    <button type="button" class="btn btn-sm btn-primary">Categories</button>
                </a>
                <a href="{{ route('post.add') }}">
                    <button type="button" class="btn btn-sm btn-primary">Create post</button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="place-content-center h-48">
                        <div class="text-center border-2">
{{--                            <div class="font-bold mb-3 pt-1">All posts in {{ $category->title }}</div>--}}
                            <div>
                                @if($posts && count($posts) > 0)
                                    @foreach($posts as $post)
                                        <div class="post border-1 p-1 m-1">
                                            <a href="{{ route('post.index', $post->id) }}">
                                                {{ $post->title }}
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    No posts yet.
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

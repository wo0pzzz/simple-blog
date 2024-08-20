<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('post.add') }}">
                    <button type="button" class="btn btn-sm btn-primary">Create post</button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('post.search') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm block" id="search" name="search" type="text" required="required" placeholder="Search...">
                            <div class="input-group-text">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-{{ (isset($user_posts) ? '2' : '1') }} gap-4 place-content-center h-48">
                        <div class="text-center border-2">
                            <div class="font-bold mb-3 pt-1">
                                @if (isset($user_posts))
                                    All posts
                                @else
                                    Founded {{ count($all_posts) }} posts
                                @endif
                            </div>
                            <div>
                                @if($all_posts && count($all_posts) > 0)
                                    @foreach($all_posts as $post)
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
                        @if (isset($user_posts))
                            <div class="text-center border-2">
                                <div class="font-bold mb-3 pt-1">My posts</div>
                                <div>
                                    @if($user_posts && count($user_posts) > 0)
                                        @foreach($user_posts as $post)
                                            <div class="post border-1 p-1 m-1">
                                                <a href="{{ route('post.index', $post->id) }}">
                                                    {{ $post->title }}
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <div>No posts yet.</div>
                                        <div>
                                            <a href="{{ route('post.add') }}">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm">Create new</button>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

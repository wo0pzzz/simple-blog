<x-app-layout>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Edit {{ $post->title }}
                        </h2>
                    </header>

                    <div class="mt-3">
                        <form method="POST" action="{{ route('post.update') }}">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Title:</span>
                                    <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
                                </div>
                                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="3" placeholder="Your text here..." required>{{ $post->content }}</textarea>
                                @error('content')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                                <select class="form-select mt-2" name="category[]" multiple required>
                                    @if ($categories && count($categories) > 0)
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ (in_array($category->id,  $post_categories_arr) ? 'selected' : '') }}>{{ $category->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="mt-2 text-right">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mt-2 text-right text-xs">
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>

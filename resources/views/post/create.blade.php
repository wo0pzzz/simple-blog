<x-app-layout>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>* {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Create new post
                        </h2>
                    </header>

                    <div class="mt-3">
                        <form method="POST" action="{{ route('post.store') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Title:</span>
                                    <input type="text" class="form-control" name="title" required value="{{ old('title') }}">
                                </div>
                                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="3" placeholder="Your text here..."  required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                                @if ($categories && count($categories) > 0)
                                    <select class="form-select mt-2" name="category[]" multiple required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="text-center mt-3">
                                        Category list are empty.<br>
                                        @if (Auth::user()->role != 'admin')
                                            Please contact admin to create new category.
                                        @else
                                            <a href="{{ route('category.add') }}">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm">Create new</button>
                                            </a>
                                        @endif
                                    </div>
                                @endif
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

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
                            Create new category
                        </h2>
                    </header>

                    <div class="mt-3">
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Category name:</span>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                @error('content')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
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

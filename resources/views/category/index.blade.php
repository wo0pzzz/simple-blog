<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <div class="row">
                            <div class="col-md-8">
                                <h2 class="text-lg font-medium text-gray-900">
                                    All categories
                                </h2>
                            </div>
                            <div class="col-md-4 text-right">
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('category.add') }}">
                                        <button type="button" class="btn btn-sm btn-primary">Create category</button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </header>

                    <div class="mt-3">
                        @if ($categories && count($categories) > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td><b>Title</b></td>
                                        <td><b>Posts</b></td>
{{--                                        <td></td>--}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <a href="{{ route('category.posts', $category->id) }}">{{ $category->title }}</a>
                                            </td>
                                            <td>{{ count($category->posts) }}</td>
{{--                                            <td>&nbsp;</td>--}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            No categories yet.
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>

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
                            <div class="row">
                                <div class="col-md-8">
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ $post->title }}
                                    </h2>
                                </div>
                                <div class="col-md-4 text-right">
                                    @if ($user->id == $post->author_id)
                                        <div style="display: inline-block;">
                                            <a href="{{ route('post.edit', $post->id) }}">
                                                <button type="submit" class="btn btn-success btn-sm text-xs">Edit</button>
                                            </a>
                                        </div>
                                        <div style="display: inline-block;">
                                            <form action="{{ route('post.delete', $post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm text-xs">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </header>

                        <div class="mt-3">
                            {{ $post->content }}
                        </div>
                        <div class="row mt-2 text-xs">
                            <div class="text-left">
                                @if ($categories && count($categories) > 0)
                                    <b>Categories: </b>
                                    @foreach($categories as $key => $category)
                                        <a href="{{ route('category.posts', $category->id) }}">{{ $category->title }}</a>@if ($key + 1 != count($categories)), @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="text-right">
                                Created by {{ $post->author->name }} <br> {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}
                            </div>
                        </div>
                    </section>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Comments
                            </h2>
                        </header>

                        <div class="mt-3">
                            @if ($comments && count($comments) > 0)
                                @foreach($comments as $comment)
                                    <div class="comment border-2 p-2 m-1">
                                        <div class="row">
                                            <div class="col-md-8 font-bold">{{ $comment->author->name }}:</div>
                                            <div class="col-md-4 text-right">
                                                @if ($user->id == $comment->author_id)
                                                    <form action="{{ route('comment.delete', $comment->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm text-xs">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                        <div>{{ $comment->comment }}</div>
                                        <div class="text-xs text-right">
                                            {{ \Carbon\Carbon::parse($comment->created_at)->format('H:i d/m/Y')}}
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                No comments yet.
                            @endif

                            <div class="comment border-2 p-2 m-1 mt-5">
                                <form method="POST" action="{{ route('comment.store') }}">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="form-group">
                                        <label class="font-bold">New comment</label>
                                        <textarea id="comment" name="comment" class="form-control @error('comment') is-invalid @enderror" rows="3" required></textarea>
                                        @error('comment')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="mt-2 text-right">
                                            <button type="submit" class="btn btn-primary btn-sm">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
            </div>
        </div>
    </div>
</x-app-layout>

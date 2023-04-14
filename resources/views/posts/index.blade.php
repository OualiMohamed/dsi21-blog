@extends('layouts.app')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <a href="{{ url('posts/create') }}" class="btn btn-primary">New Post</a>
    <h2 class="py-4">Posts List</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Category</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ substr($post->content, 1, 40) . '...' }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        {{-- <a href="{{ url('/posts/' . $post->id) }}" class="btn btn-outline-info">Show</a> --}}
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-info">Show</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-warning">Edit</a>
                        <button class="btn btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#deletePostModal{{ $post->id }}">Delete</button>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1" aria-labelledby="deletePostModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deletePostModalLabel">Delete Post</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure to delete this Post #{{ $post->id }} ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <form id="delete-post-form-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Delete Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection

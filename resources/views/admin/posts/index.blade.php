@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Insights Manager</h4>
            <p class="text-muted mb-0">Create, publish and manage posts</p>
        </div>

        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>New Post
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>
                                <strong>{{ $post->title }}</strong>
                                <div class="text-muted small">/{{ $post->slug }}</div>
                            </td>

                            <td>
                                <span class="badge bg-{{ $post->type === 'news' ? 'info' : 'secondary' }}">
                                    {{ strtoupper($post->type) }}
                                </span>
                            </td>

                            <td>
                                @if($post->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-warning text-dark">Draft</span>
                                @endif
                            </td>

                            <td class="text-muted small">
                                {{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}
                            </td>

                            <td class="text-end d-flex justify-content-end gap-2">
                                <form method="POST" action="{{ route('admin.posts.toggle', $post->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary" type="submit">
                                        {{ $post->is_published ? 'Unpublish' : 'Publish' }}
                                    </button>
                                </form>

                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}"
                                      onsubmit="return confirm('Delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                @if($post->is_published)
                                    <a class="btn btn-sm btn-outline-success"
                                       target="_blank"
                                       href="{{ route('posts.public.show', $post->slug) }}">
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-5">No posts yet.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $posts->links() }}
            </div>
        </div>
    </div>

</div>
@endsection

@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h4 class="mb-1">Edit Post</h4>
        <p class="text-muted mb-0">Update your article</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-semibold mb-2">Fix the following:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-lg-8">
                        <label class="form-label">Title</label>
                        <input name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                        <div class="text-muted small mt-1">Slug: {{ $post->slug }}</div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-control" required>
                            <option value="news" {{ old('type', $post->type)==='news'?'selected':'' }}>News</option>
                            <option value="blog" {{ old('type', $post->type)==='blog'?'selected':'' }}>Blog</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Excerpt (optional)</label>
                        <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="10" required>{{ old('content', $post->content) }}</textarea>
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Cover Image (optional)</label>
                        <input type="file" name="cover_image" class="form-control" accept="image/*">

                        @if($post->cover_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$post->cover_image) }}" alt="Cover" style="max-height:120px;border-radius:10px;">
                            </div>
                        @endif
                    </div>

                    <div class="col-12 col-lg-6 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label">Published</label>
                        </div>
                        <div class="ms-3 text-muted small">
                            {{ $post->published_at ? 'Published: '.$post->published_at->format('d M Y') : 'Not published' }}
                        </div>
                    </div>

                    <div class="col-12 d-flex gap-2">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Back</a>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection

@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h4 class="mb-1">Create Post</h4>
        <p class="text-muted mb-0">Write a new blog/news post</p>
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
            <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-lg-8">
                        <label class="form-label">Title</label>
                        <input name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="col-12 col-lg-4">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-control" required>
                            <option value="news" {{ old('type')==='news'?'selected':'' }}>News</option>
                            <option value="blog" {{ old('type')==='blog'?'selected':'' }}>Blog</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Excerpt (optional)</label>
                        <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt') }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="10" required>{{ old('content') }}</textarea>
                        <div class="text-muted small mt-2">You can paste formatted text/HTML here.</div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Cover Image (optional)</label>
                        <input type="file" name="cover_image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-12 col-lg-6 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published')?'checked':'' }}>
                            <label class="form-check-label">Publish immediately</label>
                        </div>
                    </div>

                    <div class="col-12 d-flex gap-2">
                        <button class="btn btn-primary">Save</button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection

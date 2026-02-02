@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Upload Study Material</h3>
            <p class="text-muted mb-0">Add lectures or helping material in PDF format.</p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm">
            <div class="fw-semibold mb-2">Please fix the following:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-3 p-md-4">

            <form method="POST"
                  action="{{ route('admin.materials.store') }}"
                  enctype="multipart/form-data"
                  class="row g-3">

                @csrf

                {{-- Type --}}
                <div class="col-12 col-md-4">
                    <label class="form-label fw-semibold">Material Type</label>
                    <select name="type" class="form-select" required>
                        <option value="lecture" {{ old('type') === 'lecture' ? 'selected' : '' }}>Lectures</option>
                        <option value="resource" {{ old('type') === 'resource' ? 'selected' : '' }}>Helping Material</option>
                    </select>
                    @error('type')
                        <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sort Order --}}
                <div class="col-12 col-md-4">
                    <label class="form-label fw-semibold">Sort Order</label>
                    <input type="number"
                           name="sort_order"
                           class="form-control"
                           value="{{ old('sort_order', 0) }}"
                           min="0">
                    <div class="form-text">Lower number appears first (optional).</div>
                    @error('sort_order')
                        <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Publish --}}
                <div class="col-12 col-md-4 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               type="checkbox"
                               role="switch"
                               id="is_published"
                               name="is_published"
                               value="1"
                               {{ old('is_published', 1) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_published">
                            Published
                        </label>
                        <div class="form-text">Unpublish to hide from users.</div>
                    </div>
                </div>

                {{-- Title --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           placeholder="e.g., Lecture 1 — Market Structure"
                           value="{{ old('title') }}"
                           required>
                    @error('title')
                        <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Description (Optional)</label>
                    <textarea name="description"
                              class="form-control"
                              rows="4"
                              placeholder="Short summary of what this PDF contains...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- File --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">PDF File</label>
                    <div class="p-3 border rounded-3 bg-light">
                        <input type="file"
                               name="file"
                               class="form-control"
                               accept="application/pdf"
                               required>
                        <div class="form-text mt-2">
                            Only PDF allowed. Keep file size reasonable (e.g., 10–20MB).
                        </div>
                    </div>
                    @error('file')
                        <div class="small text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="col-12 d-flex gap-2 justify-content-end mt-2">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload me-2"></i>Upload Material
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

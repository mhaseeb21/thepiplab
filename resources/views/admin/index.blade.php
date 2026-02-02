@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Study Materials</h4>
            <p class="text-muted mb-0">Manage lectures and helping materials</p>
        </div>

        <a href="{{ route('admin.materials.create') }}" class="btn btn-primary">
            <i class="fas fa-upload me-2"></i>Upload Material
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Materials Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">

            @if($materials->count())

                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>File</th>
                            <th>Size</th>
                            <th>Status</th>
                            <th>Uploaded</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials as $index => $material)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <span class="badge bg-{{ $material->type === 'lecture' ? 'info' : 'secondary' }}">
                                        {{ ucfirst($material->type) }}
                                    </span>
                                </td>

                                <td>
                                    <strong>{{ $material->title }}</strong>
                                    @if($material->description)
                                        <div class="text-muted small">
                                            {{ $material->description }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ asset('storage/'.$material->file_path) }}"
                                       target="_blank"
                                       class="text-decoration-none">
                                        <i class="fas fa-file-pdf text-danger me-1"></i>
                                        {{ $material->original_name }}
                                    </a>
                                </td>

                                <td class="text-muted small">
                                    {{ number_format(($material->size ?? 0) / 1024 / 1024, 2) }} MB
                                </td>

                                <td>
                                    @if($material->is_published)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Hidden</span>
                                    @endif
                                </td>

                                <td class="text-muted small">
                                    {{ $material->created_at->format('d M Y') }}
                                </td>

                                <td class="text-end">
                                    <form action="{{ route('admin.materials.destroy', $material->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this material?')"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else
                <div class="text-center py-5">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <p class="mb-0">No study materials uploaded yet.</p>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection

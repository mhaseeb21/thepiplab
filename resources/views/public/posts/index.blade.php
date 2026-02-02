@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="mb-1" style="color:#091E3E;">Market Insights</h2>
        <p class="text-muted mb-0">Latest updates, analysis and educational content from PipLab.</p>
    </div>

    <div class="row g-4">
        @forelse($posts as $post)
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ route('posts.public.show', $post->slug) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius:14px;">
                        @if($post->cover_image)
                            <img src="{{ asset('storage/'.$post->cover_image) }}" class="card-img-top" style="border-top-left-radius:14px;border-top-right-radius:14px;object-fit:cover;height:180px;">
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-{{ $post->type === 'news' ? 'info' : 'secondary' }}">
                                    {{ strtoupper($post->type) }}
                                </span>
                                <span class="text-muted small">{{ $post->published_at?->format('d M Y') }}</span>
                            </div>

                            <h5 class="mb-2" style="color:#091E3E;">{{ $post->title }}</h5>
                            <p class="text-muted mb-0">{{ \Illuminate\Support\Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <div class="text-muted">No posts published yet.</div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection

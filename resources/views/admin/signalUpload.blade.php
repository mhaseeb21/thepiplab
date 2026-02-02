@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Upload New Signal</h3>
            <div class="text-muted">Create and publish a new signal for clients</div>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light text-dark border px-3 py-2">
                Default Status: Pending
            </span>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <div class="fw-semibold mb-2">Please fix the following:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        {{-- Form --}}
        <div class="col-12 col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 p-md-4">

                    <form action="{{ route('admin.signalUpload') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">

                            {{-- Pair Name --}}
                            <div class="col-12">
                                <label for="pair_name" class="form-label">Pair Name</label>
                                <input
                                    type="text"
                                    name="pair_name"
                                    id="pair_name"
                                    class="form-control"
                                    placeholder="e.g., EUR/USD"
                                    required
                                >
                                <div class="form-text">Use standard format like EUR/USD, XAU/USD, GBP/JPY etc.</div>
                            </div>

                            {{-- Signal Type --}}
                            <div class="col-12 col-md-6">
                                <label for="signal_type" class="form-label">Signal Type</label>
                                <select name="signal_type" id="signal_type" class="form-select" required>
                                    <option value="buy">Buy</option>
                                    <option value="sell">Sell</option>
                                </select>
                            </div>

                            {{-- TP1 --}}
                            <div class="col-12 col-md-6">
                                <label for="tp1" class="form-label">TP1 (optional)</label>
                                <input
                                    type="text"
                                    name="tp1"
                                    id="tp1"
                                    class="form-control"
                                    placeholder="e.g., 1.08750"
                                >
                            </div>

                            {{-- TP2 --}}
                            <div class="col-12 col-md-6">
                                <label for="tp2" class="form-label">TP2 (optional)</label>
                                <input
                                    type="text"
                                    name="tp2"
                                    id="tp2"
                                    class="form-control"
                                    placeholder="e.g., 1.09000"
                                >
                            </div>

                            {{-- Entry Criteria --}}
                            <div class="col-12">
                                <label for="entry_criteria" class="form-label">Entry Criteria (optional)</label>
                                <textarea
                                    name="entry_criteria"
                                    id="entry_criteria"
                                    class="form-control"
                                    rows="3"
                                    placeholder="e.g., Enter on retracement to 1.08500 with confirmation candle..."
                                ></textarea>
                            </div>

                            {{-- Description --}}
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea
                                    name="description"
                                    id="description"
                                    class="form-control"
                                    rows="5"
                                    placeholder="Add key levels, entry, SL/TP, and notes..."
                                    required
                                ></textarea>
                            </div>

                            {{-- Before Image --}}
                            <div class="col-12">
                                <label for="image" class="form-label">Before Image (Signal Chart)</label>
                                <input
                                    type="file"
                                    name="file"
                                    id="image"
                                    class="form-control"
                                    accept="image/*"
                                    required
                                >
                                <div class="form-text">Upload the signal chart/screenshot (Before).</div>

                                {{-- Local preview --}}
                                <div class="mt-3">
                                    <img id="imgPreview" class="img-fluid rounded border d-none" alt="Preview">
                                </div>
                            </div>

                        </div>

                        <div class="d-grid d-md-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-cloud-arrow-up me-2"></i> Upload Signal
                            </button>

                            <button type="reset" class="btn btn-outline-secondary">
                                Reset
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        {{-- Tips --}}
        <div class="col-12 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 p-md-4">
                    <div class="fw-semibold mb-2">Posting Tips</div>
                    <ul class="text-muted mb-0">
                        <li>Keep pair formatting consistent (EUR/USD, XAU/USD).</li>
                        <li>Add TP1/TP2 if you want them shown publicly.</li>
                        <li>Entry Criteria helps users understand when a signal is valid.</li>
                        <li>Result Status will stay <strong>Pending</strong> until you update it from Signals List.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // Image preview (no jQuery)
    const input = document.getElementById('image');
    const preview = document.getElementById('imgPreview');

    if (input) {
        input.addEventListener('change', (e) => {
            const file = e.target.files?.[0];
            if (!file) {
                preview.classList.add('d-none');
                preview.src = '';
                return;
            }
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        });
    }
</script>
@endsection
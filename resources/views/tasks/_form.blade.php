{{-- Title --}}
<div class="form-outline mb-4">
    <input type="text" name="title" id="title"
           class="form-control form-control-lg @error('title') is-invalid @enderror"
           value="{{ old('title', $task->title ?? '') }}" required>
    <label class="form-label" for="title">
        <span class="material-icons me-1" style="font-size:16px;vertical-align:middle">title</span>
        Название задачи <span class="text-danger">*</span>
    </label>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Description --}}
<div class="form-outline mb-4">
    <textarea name="description" id="description" rows="4"
              class="form-control @error('description') is-invalid @enderror"
              >{{ old('description', $task->description ?? '') }}</textarea>
    <label class="form-label" for="description">
        <span class="material-icons me-1" style="font-size:16px;vertical-align:middle">notes</span>
        Описание
    </label>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Status --}}
<div class="mb-4">
    <label class="form-label fw-medium">
        <span class="material-icons me-1" style="font-size:16px;vertical-align:middle">flag</span>
        Статус <span class="text-danger">*</span>
    </label>
    <div class="d-flex gap-3 flex-wrap">
        @foreach($statuses as $key => $label)
        @php $icons = ['new' => 'fiber_new', 'in_progress' => 'pending', 'done' => 'check_circle']; @endphp
        <label class="status-radio-label status-{{ $key }} rounded-4 px-4 py-3 d-flex align-items-center gap-2"
               style="cursor:pointer;border:2px solid transparent;transition:all .2s;"
               data-status="{{ $key }}">
            <input type="radio" name="status" value="{{ $key }}" class="d-none status-radio"
                   {{ old('status', $task->status ?? 'new') === $key ? 'checked' : '' }}>
            <span class="material-icons">{{ $icons[$key] }}</span>
            <span class="fw-medium">{{ $label }}</span>
        </label>
        @endforeach
    </div>
    @error('status')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const labels = document.querySelectorAll('.status-radio-label');
    function updateLabels() {
        labels.forEach(label => {
            const radio = label.querySelector('.status-radio');
            label.style.borderColor = radio.checked ? 'currentColor' : 'transparent';
            label.style.opacity = radio.checked ? '1' : '.65';
        });
    }
    labels.forEach(label => {
        label.addEventListener('click', function () {
            this.querySelector('.status-radio').checked = true;
            updateLabels();
        });
    });
    updateLabels();
});
</script>

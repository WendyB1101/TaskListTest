@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('tasks.index') }}" class="text-decoration-none">
                        <span class="material-icons" style="font-size:14px;vertical-align:middle">home</span> Задачи
                    </a>
                </li>
                <li class="breadcrumb-item active">{{ Str::limit($task->title, 40) }}</li>
            </ol>
        </nav>

        {{-- Main card --}}
        <div class="card border-0 shadow rounded-4 mb-3">
            {{-- Colored top bar by status --}}
            <div class="rounded-top-4" style="height:6px;background:
                {{ $task->status === 'done' ? '#4caf50' : ($task->status === 'in_progress' ? '#ff9800' : '#2196f3') }}">
            </div>

            <div class="card-body p-4">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $task->title }}</h4>
                        <span class="status-badge status-{{ $task->status }}">
                            <span class="material-icons" style="font-size:14px">
                                {{ $task->status === 'done' ? 'check_circle' : ($task->status === 'in_progress' ? 'pending' : 'radio_button_unchecked') }}
                            </span>
                            {{ $statuses[$task->status] }}
                        </span>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('tasks.edit', $task) }}"
                           class="btn btn-outline-primary btn-sm rounded-3 d-flex align-items-center gap-1">
                            <span class="material-icons" style="font-size:16px">edit</span> Изменить
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                              onsubmit="return confirm('Удалить задачу?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm rounded-3 d-flex align-items-center gap-1">
                                <span class="material-icons" style="font-size:16px">delete</span> Удалить
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Description --}}
                <div class="bg-light rounded-3 p-3 mb-4">
                    @if($task->description)
                        <p class="mb-0" style="white-space:pre-wrap;line-height:1.7">{{ $task->description }}</p>
                    @else
                        <p class="text-muted mb-0 fst-italic">Описание не указано.</p>
                    @endif
                </div>

                {{-- Meta --}}
                <div class="row g-3 text-center mb-4">
                    <div class="col-6">
                        <div class="bg-light rounded-3 p-3">
                            <div class="text-muted small mb-1">
                                <span class="material-icons" style="font-size:14px;vertical-align:middle">calendar_today</span>
                                Создана
                            </div>
                            <div class="fw-semibold">{{ $task->created_at->format('d.m.Y') }}</div>
                            <div class="text-muted small">{{ $task->created_at->format('H:i') }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-light rounded-3 p-3">
                            <div class="text-muted small mb-1">
                                <span class="material-icons" style="font-size:14px;vertical-align:middle">update</span>
                                Обновлена
                            </div>
                            <div class="fw-semibold">{{ $task->updated_at->format('d.m.Y') }}</div>
                            <div class="text-muted small">{{ $task->updated_at->format('H:i') }}</div>
                        </div>
                    </div>
                </div>

                {{-- Quick status change --}}
                <div class="border rounded-3 p-3">
                    <p class="fw-medium mb-3 d-flex align-items-center gap-1">
                        <span class="material-icons text-primary" style="font-size:18px">swap_horiz</span>
                        Изменить статус
                    </p>
                    <form action="{{ route('tasks.status', $task) }}" method="POST"
                          class="d-flex gap-2 flex-wrap align-items-center">
                        @csrf @method('PATCH')
                        @foreach($statuses as $key => $label)
                        @php $icons = ['new' => 'fiber_new', 'in_progress' => 'pending', 'done' => 'check_circle']; @endphp
                        <button type="submit" name="status" value="{{ $key }}"
                                class="btn btn-sm rounded-pill d-flex align-items-center gap-1
                                       {{ $task->status === $key ? 'btn-primary' : 'btn-outline-secondary' }}">
                            <span class="material-icons" style="font-size:14px">{{ $icons[$key] }}</span>
                            {{ $label }}
                        </button>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>

        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
            <span class="material-icons" style="font-size:18px">arrow_back</span> Назад к списку
        </a>

    </div>
</div>
@endsection

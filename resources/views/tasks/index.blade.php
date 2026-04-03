@extends('layouts.app')

@section('content')

{{-- Page Header --}}
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h4 class="mb-1 fw-bold">Task list</h4>
        <p class="mb-0 opacity-75">Manage your tasks effectively</p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        @php
            $counts = ['new' => 0, 'in_progress' => 0, 'done' => 0];
            foreach ($tasks as $t) $counts[$t->status]++;
        @endphp
        <span class="badge rounded-pill bg-white text-primary px-3 py-2">
            Всего: {{ $tasks->total() }}
        </span>
    </div>
</div>

{{-- Filters --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('tasks.index') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <span class="material-icons text-muted" style="font-size:20px">search</span>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0"
                           placeholder="Поиск по названию..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">Все статусы</option>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Найти</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                        <span class="material-icons" style="font-size:18px">close</span>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- Status filter chips --}}
<div class="d-flex gap-2 mb-3 flex-wrap">
    <a href="{{ route('tasks.index', array_merge(request()->except('status','page'), [])) }}"
       class="chip {{ !request('status') ? 'chip-active status-new' : 'bg-white text-muted border' }}">
        Все
    </a>
    @foreach($statuses as $key => $label)
        <a href="{{ route('tasks.index', array_merge(request()->except('page'), ['status' => $key])) }}"
           class="chip status-{{ $key }} {{ request('status') === $key ? 'chip-active' : '' }}">
            <span class="material-icons" style="font-size:14px">
                {{ $key === 'new' ? 'fiber_new' : ($key === 'in_progress' ? 'pending' : 'check_circle') }}
            </span>
            {{ $label }}
        </a>
    @endforeach
</div>

{{-- Tasks --}}
@if($tasks->isEmpty())
    <div class="text-center py-5">
        <span class="material-icons text-muted" style="font-size:64px">inbox</span>
        <p class="text-muted mt-2">Задачи не найдены</p>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mt-2">Создать первую задачу</a>
    </div>
@else
    <div class="row g-3">
        @foreach($tasks as $task)
        <div class="col-12">
            <div class="card task-card border-0 shadow-sm rounded-4">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    {{-- Icon --}}
                    <div class="avatar-icon flex-shrink-0">
                        <span class="material-icons" style="font-size:20px">
                            {{ $task->status === 'done' ? 'check_circle' : ($task->status === 'in_progress' ? 'pending' : 'radio_button_unchecked') }}
                        </span>
                    </div>

                    {{-- Info --}}
                    <div class="flex-grow-1 min-w-0">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <a href="{{ route('tasks.show', $task) }}"
                               class="fw-semibold text-dark text-decoration-none stretched-link-title">
                                {{ $task->title }}
                            </a>
                            <span class="status-badge status-{{ $task->status }}">
                                {{ $statuses[$task->status] }}
                            </span>
                        </div>
                        @if($task->description)
                            <p class="text-muted small mb-0 mt-1 text-truncate" style="max-width:500px">
                                {{ $task->description }}
                            </p>
                        @endif
                        <small class="text-muted">
                            <span class="material-icons" style="font-size:12px;vertical-align:middle">schedule</span>
                            {{ $task->created_at->format('d.m.Y H:i') }}
                        </small>
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex gap-1 flex-shrink-0">
                        <a href="{{ route('tasks.show', $task) }}"
                           class="btn btn-sm btn-light rounded-3" title="Просмотр">
                            <span class="material-icons" style="font-size:18px">visibility</span>
                        </a>
                        <a href="{{ route('tasks.edit', $task) }}"
                           class="btn btn-sm btn-light rounded-3" title="Редактировать">
                            <span class="material-icons" style="font-size:18px">edit</span>
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                              onsubmit="return confirm('Удалить задачу «{{ addslashes($task->title) }}»?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-light rounded-3 text-danger" title="Удалить">
                                <span class="material-icons" style="font-size:18px">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $tasks->links() }}
    </div>
@endif

{{-- FAB --}}
<a href="{{ route('tasks.create') }}" class="fab btn btn-primary btn-lg rounded-circle shadow-lg"
   style="width:56px;height:56px;display:flex;align-items:center;justify-content:center;" title="Новая задача">
    <span class="material-icons">add</span>
</a>

@endsection

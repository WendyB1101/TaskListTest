@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('tasks.index') }}" class="text-decoration-none">
                        <span class="material-icons" style="font-size:14px;vertical-align:middle">home</span> Задачи
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none">
                        {{ Str::limit($task->title, 30) }}
                    </a>
                </li>
                <li class="breadcrumb-item active">Редактировать</li>
            </ol>
        </nav>

        <div class="card border-0 shadow rounded-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="avatar-icon" style="background:#fff8e1;color:#f57f17;width:48px;height:48px;">
                        <span class="material-icons">edit_note</span>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Редактировать задачу</h5>
                        <small class="text-muted">#{{ $task->id }} · {{ $task->created_at->format('d.m.Y') }}</small>
                    </div>
                </div>

                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf @method('PUT')
                    @include('tasks._form')
                    <div class="d-flex gap-2 mt-2">
                        <button type="submit" class="btn btn-primary px-4 d-flex align-items-center gap-1">
                            <span class="material-icons" style="font-size:18px">save</span> Сохранить
                        </button>
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                            <span class="material-icons" style="font-size:18px">arrow_back</span> Отмена
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

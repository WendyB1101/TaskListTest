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
                <li class="breadcrumb-item active">Новая задача</li>
            </ol>
        </nav>

        <div class="card border-0 shadow rounded-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="avatar-icon" style="background:#e8f5e9;color:#2e7d32;width:48px;height:48px;">
                        <span class="material-icons">add_task</span>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Новая задача</h5>
                        <small class="text-muted">Заполните поля ниже</small>
                    </div>
                </div>

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    @include('tasks._form')
                    <div class="d-flex gap-2 mt-2">
                        <button type="submit" class="btn btn-primary px-4 d-flex align-items-center gap-1">
                            <span class="material-icons" style="font-size:18px">save</span> Создать
                        </button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                            <span class="material-icons" style="font-size:18px">arrow_back</span> Отмена
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

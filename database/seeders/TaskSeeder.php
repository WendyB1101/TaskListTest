<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            ['title' => 'Настроить окружение разработки', 'description' => 'Установить PHP, Composer, Laravel и настроить .env файл.', 'status' => 'done'],
            ['title' => 'Разработать CRUD для задач', 'description' => 'Реализовать создание, чтение, обновление и удаление задач.', 'status' => 'in_progress'],
            ['title' => 'Добавить фильтрацию и поиск', 'description' => 'Фильтрация по статусу и поиск по названию задачи.', 'status' => 'in_progress'],
            ['title' => 'Написать документацию', 'description' => 'Описать установку и запуск проекта в README.md.', 'status' => 'new'],
            ['title' => 'Опубликовать на GitHub', 'description' => 'Создать репозиторий и загрузить проект.', 'status' => 'new'],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}

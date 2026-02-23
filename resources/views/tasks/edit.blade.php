@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Task</h2>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}">
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <select name="priority" id="priority" class="form-select">
                <option value="low" {{ $task->priority=='low'?'selected':'' }}>Low</option>
                <option value="medium" {{ $task->priority=='medium'?'selected':'' }}>Medium</option>
                <option value="high" {{ $task->priority=='high'?'selected':'' }}>High</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="pending" {{ $task->status=='pending'?'selected':'' }}>Pending</option>
                <option value="in_progress" {{ $task->status=='in_progress'?'selected':'' }}>In Progress</option>
                <option value="completed" {{ $task->status=='completed'?'selected':'' }}>Completed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $task->due_date) }}">
        </div>

        <button type="submit" class="btn btn-success">Update Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
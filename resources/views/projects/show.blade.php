<x-app-layout>
    <div class="container">
        <div class="mb-4">
            <h2 class="h2">{{ $project->title }}</h2>
            <p>{{ $project->description }}</p>
        </div>

        <form method="POST" action="{{ route('tasks.store', $project) }}">
            @csrf
            <div class="">
                <div class="mb-3">
                    <label for="Title">Title</label>
                    <input name="title" class="form-control" required placeholder="Task title">
                </div>

                <div class="mb-3">
                    <label for="Status">Status</label>
                    <select name="status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Due date">Due date</label>
                    <input type="date" class="form-control" name="due_date">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-dark">Add Task</button>
                </div>
            </div>
        </form>


        <br><br>

        <h2 class="h2">Tasks</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('tasks.filter', $project) }}">
            <select name="status">
                <option value="">All</option>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="done">Done</option>
            </select>
            <input type="date" name="due_date">
            <button type="submit" class="btn btn-dark">Filter</button>
        </form>


        <ul class="list-group">
            @foreach ($project->tasks as $task)
                <li id="task-{{ $task->id }}" class="list-group-item my-2 d-flex justify-content-between">
                    <div class="task-view">
                        <span>{{ $task->title }}</span> |
                        <span>{{ ucfirst($task->status) }}</span> |
                        <span>{{ $task->due_date ?? 'No date' }}</span>
                    </div>

                    <div>
                        <button onclick="editTask({{ $task->id }})" class="fa fa-edit text-primary mx-2"></button>

                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="mx-2"
                            style="display:inline;"
                            onsubmit="return confirm('Are you sure you want to delete this task? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="fa fa-trash text-danger"></button>
                        </form>
                    </div>

                    <form method="POST" action="{{ route('tasks.update', $task) }}" class="task-edit"
                        style="display:none; margin-top: 10px;">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $task->title }}" required>

                        <select name="status">
                            <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In
                                Progress</option>
                            <option value="done" {{ $task->status === 'done' ? 'selected' : '' }}>Done</option>
                        </select>

                        <input type="date" name="due_date" value="{{ $task->due_date }}">

                        <button type="submit">💾 Save</button>
                        <button type="button" onclick="cancelEdit({{ $task->id }})">❌ Cancel</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>

   <script>
        function editTask(id) {
            const taskItem = document.getElementById(`task-${id}`);
            const view = taskItem.querySelector('.task-view');
            const edit = taskItem.querySelector('.task-edit');

            view.style.display = 'none';
            edit.style.display = 'block';
        }

        function cancelEdit(id) {
            const taskItem = document.getElementById(`task-${id}`);
            const view = taskItem.querySelector('.task-view');
            const edit = taskItem.querySelector('.task-edit');

            view.style.display = 'flex';
            edit.style.display = 'none';
        }
    </script>
<x-app-layout>
    <div class="container">
        <div class="">
            <fieldset class="border rounded-3 p-3">
                <legend class="float-none w-auto px-3">
                    <h2 class="h2">Your Projects</h2>
                </legend>

                <form method="POST" action="{{ route('projects.store') }}">
                    @csrf
                    <div>
                        <div class="mb-3">
                            <label for="Title">Title</label>
                            <input name="title" class="form-control" placeholder="Project Title" required>
                        </div>

                        <div class="mb-3">
                            <label for="Description">Description</label>
                            <textarea name="description" class="form-control" placeholder="Description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="Deadline">Deadline</label>
                            <input type="date" class="form-control" name="deadline">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark">Create Project</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>

        <br>

        <h2 class="h2">Projects</h2>
        <ul class="list-group">
            @foreach ($projects as $project)
                <li class="list-group-item my-2">
                    <a href="{{ route('projects.show', $project) }}" class="text-primary">{{ $project->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>

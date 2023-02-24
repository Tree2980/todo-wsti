

@foreach($todos_end as $todo_end)
        <li class="list-group-item">
            {{ $todo_end->task }}
        </li>
        @endforeach

@include('layouts/app')
<?php
$nowdate = Carbon\Carbon::now();
    ?>
    <body>

        <hr>
        <section class="pt-1 pb-1">
            <div class="container">
              <div class="row d-flex ">
                  <div class="clear_button">
       

        <form action="{{ url('/todo_clear_all') }}" method="POST">
            @csrf
            <button class="btn btn-danger" type="submit">Clear all tasks</button>
        </form>
        <form action="{{ url('/todo_clear_completed') }}" method="POST">
            @csrf
            <button class="btn btn-danger" type="submit">Clear completed tasks</button>
        </form>
    </div>
    </div>
    </div>
    </section>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <section class="pt-5 pb-5">
            <div class="container">
              <div class="row d-flex ">
                  <div class="col-12 col-md-4 mb-4 mt-2">
                      <div class="card  h-100 border-light  bg-light shadow">
                          
                          <div class="card-body d-flex-row">
                              <blockquote class="blockquote mb-4 pb-2">
                                  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                                <h2>Add tasks</h2>
                                <form action="{{ url('/todos') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" name="task" placeholder="Write your task!">
                                    <br>
                                    {{ __('Enter date expired')}}
                                    <input type="date" class="form-control" name="date_expired">
                                    <br>
                                    <button class="btn btn-primary" type="submit">Add task</button>
                                </form>
                              </blockquote>
                              <div class="w-100 pb-1"></div>

                          </div>
                      </div>
                  </div>
                  <div class="col-12 col-md-4 mb-4 mt-2">
                      <div class="card  h-100 border-light  bg-light shadow">
                          <div class="card-body ">
                              <blockquote class="blockquote mb-4 pb-2">
                                <h2>Tasks in progress</h2>
                                </blockquote>
                                <ul class="list-group">
                                    @foreach($todos as $todo)
                                    <li class="list-group-item">
                                        <div class="todo_elements">
                                        @if($todo->date_expired > $nowdate)
                                        {{ $todo->task }} -
                                            {{ $todo->date_expired}}
                                        @else
                                         {{ $todo->task }} -
                                         {{ $todo->date_expired}}                                      
                                            <div class="expired_text">
                                            {{ __('!! EXPIRED !!')}}
                                            </div>
                                        </div>
                                         @endif
                                         <br>
                                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                                            Edit
                                        </button>

                                        <div class="collapse mt-2" id="collapse-{{ $loop->index }}">
                                            <div class="card card-body">
                                                <form action="{{ url('todos/'.$todo->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="textarea" name="task" value="{{ $todo->task }}">
                                                    <input type="date" name="date_expired" value="{{ $todo->date_expired }}">
                                                    <button class="btn btn-secondary" type="submit">Update</button>
                                                </form>

                                            </div>
                                        </div>
                                        <form action="{{ url('todos/'.$todo->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                        <form action="{{ url('todos/'.$todo->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-success" type="submit">Complete</button>
                                        </form>
                                    </li>
                                </ul>
                                @endforeach
                                
                                
                              <div class="w-100 pb-1"></div>

                          </div>
                      </div>
                  </div>
                  <div class="col-12 col-md-4 mb-4 mt-2">
                      <div class="card h-100  border-light  bg-light shadow">
                          <div class="card-body  ">
                              <blockquote class="blockquote mb-4 pb-2">
                                <h2>Tasks completed</h2>
                                @foreach($todos_end as $todo_end)
                                <li class="list-group-item">
                                    {{ $todo_end->task }}
                                    -
                                    {{ __('Date end:')}}
                                    {{ $todo_end->date_end}}
                                </li>
                                @endforeach
                              </blockquote>

                              <div class="w-100 pb-1"></div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
          </section>




        <hr>

    </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


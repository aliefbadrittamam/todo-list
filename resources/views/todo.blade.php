<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List Modern</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .card-header {
            background: linear-gradient(45deg, #6B46C1, #805AD5);
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #6B46C1, #805AD5);
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .list-group-item {
            border-left: none;
            border-right: none;
            padding: 1rem;
            transition: all 0.3s ease;
        }
        
        .list-group-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }
        
        .todo-input {
            border-radius: 10px;
            padding: 0.8rem;
            border: 2px solid #e9ecef;
        }
        
        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            margin-left: 0.5rem;
        }
        
        .btn-edit {
            background-color: #4299e1;
            color: white;
        }
        
        .btn-delete {
            background-color: #f56565;
            color: white;
        }
        
        .collapse-content {
            background-color: #f8fafc;
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 0.5rem;
        }
        
        .radio-group {
            display: flex;
            gap: 1.5rem;
            margin-top: 0.5rem;
        }
        
        .radio-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        
        .completed-task {
            color: #718096;
            text-decoration: line-through;
        }
        
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #718096;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #a0aec0;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="h3 text-white mb-0 d-flex align-items-center">
                            <i class="fas fa-clipboard-list me-3"></i>
                            Todo List
                        </h1>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success m-3 rounded-3">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form id="todo-form" class="mb-4" action="{{ route('todo.post') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" id="todo-input" class="form-control todo-input" 
                                    placeholder="Tambahkan tugas baru..." name="title" required>
                                <button class="btn btn-primary px-4" type="submit">
                                    <i class="fas fa-plus me-2"></i>Tambah
                                </button>
                            </div>
                        </form>

                        <ul class="list-group list-group-flush" id="todo-list">
                            @foreach ($data as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="{{ $item->is_done == 1 ? 'completed-task' : '' }}">
                                        <i class="fas {{ $item->is_done == 1 ? 'fa-check-circle text-success' : 'fa-circle text-muted' }} me-2"></i>
                                        {{ $item->title }}
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-action btn-edit" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTodo{{ $loop->index }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('todo.delete', ['id' => $item->todo_id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tugas ini?');"->
                                            @csrf
                                            <button type="submit" class="btn btn-action btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                                <div class="collapse" id="collapseTodo{{ $loop->index }}">
                                    <div class="collapse-content">
                                        <form action="{{ route('todo.update', ['id' => $item->todo_id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Tugas</label>
                                                <input type="text" class="form-control todo-input" name="title"
                                                    value="{{ $item->title }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Status</label>
                                                <div class="radio-group">
                                                    <label>
                                                        <input type="radio" name="is_done" value="1" 
                                                            {{ $item->is_done == 1 ? 'checked' : '' }}>
                                                        <span>Selesai</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="is_done" value="0" 
                                                            {{ $item->is_done == 0 ? 'checked' : '' }}>
                                                        <span>Belum Selesai</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="fas fa-save me-2"></i>Update
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </ul>

                        @if(count($data) == 0)
                            <div class="empty-state">
                                <i class="fas fa-clipboard"></i>
                                <p class="mb-0">Belum ada tugas. Tambahkan tugas baru!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="py-4">
        <div class="container">
            <div class="text-center text-white">
                <div class="social-links mb-3">
                    <a href="https://instagram.com/abt_code" class="text-white mx-2" target="_blank">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                    <a href="https://github.com/abt-code" class="text-white mx-2" target="_blank">
                        <i class="fab fa-github fa-2x"></i>
                    </a>
                    <a href="https://linkedin.com/in/abt-code" class="text-white mx-2" target="_blank">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                </div>
                <p class="mb-0">© 2024 ABT_CODE. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
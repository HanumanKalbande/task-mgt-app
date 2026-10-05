<!-- resources/views/tasks/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management Table</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        .form-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        input, select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="text"] {
            flex: 2;
        }
        select {
            flex: 1;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-add { background-color: #28a745; color: white; }
        .btn-add:hover { background-color: #218838; }
        .btn-edit { background-color: #ffc107; color: #212529; margin-right: 5px; }
        .btn-edit:hover { background-color: #e0a905; }
        .btn-delete { background-color: #dc3545; color: white; }
        .btn-delete:hover { background-color: #c82333; }
        .btn-save { background-color: #007bff; color: white; margin-right: 5px; }
        .btn-save:hover { background-color: #0069d9; }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .edit-input {
            width: 90%;
            padding: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📋 Task Management Matrix</h2>
    
    <!-- Create Task Form -->
    <form action="{{ route('tasks.store') }}" method="POST">
    <!-- Input Form to Add Tasks -->
        <div class="form-group" id="addTaskDiv">
            <input type="text" id="name" name="name" placeholder="Enter task name..." require/>
            <select id="priority" name="priority">
                <option value="1">Low Priority</option>
                <option value="2">Medium Priority</option>
                <option value="3">High Priority</option>
            </select>
            <button class="btn-add" type="submit">Add Task</button>
        </div>
    </form>
    <!-- Data Table -->
     <table id="taskTable">
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Rows will be injected here dynamically -->
             @foreach ($tasks as $task)
                <tr id="taskDetailsRow">
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>
                        <button class="btn-edit" onclick="editRow({{$task->id}})">Edit</button>
                        <!-- Delete Form -->
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                            <button class="btn-delete" type="submit" onclick="return confirm('Delete task?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <!-- Update Task Form -->
                        <!-- Input Form to Add Tasks -->
                        <div class="form-group" style="display:none" id="editDiv{{$task->id}}">
                            <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display:inline;">
                                @csrf @method('PUT')
                                <input type="text" id="name" name="name" value="{{ $task->task_name }}">
                                <select id="priority" name="priority">
                                    <option value="1" @selected($task->priority == "Low")>Low Priority</option>
                                    <option value="2" @selected($task->priority == "Medium")>Medium Priority</option>
                                    <option value="3" @selected($task->priority == "High")>High Priority</option>
                                </select>
                                <button class="btn-add" type="submit">Update Task</button>
                            </form>
                        </div>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function editRow(id){
    let editInputDiv = document.getElementById('editDiv'+id);
        document.getElementById("addTaskDiv").style.display = "none";
        document.getElementById("taskTable").style.display = "none";
        editInputDiv.style.display = "block";
}
</script>

</body>
</html>

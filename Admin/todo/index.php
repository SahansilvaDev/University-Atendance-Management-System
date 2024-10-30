<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Todo List</title>
   <style>
    /* Styles for the todo list */
/* Styles for the todo list */
.container {

    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
}

form {
    display: flex;
    margin-bottom: 10px;
}

input[type="text"] {
    flex: 1;
    padding: 8px;
    font-size: 16px;
}

button {
    padding: 8px 15px;
    font-size: 16px;
    cursor: pointer;
}

ul {
    list-style: none;
    padding: 0;
    max-height: 250px; /* Maximum height for the list */
    overflow-y: auto; /* Enable vertical scrolling */
}

li {
    background-color: #fff;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: cadetblue;
    
}

.completed {
    text-decoration: line-through;
    color:black;
    height: auto;
    width: auto;
    padding-right: 10px;
   
}

/* Media query for smaller screens */
@media screen and (max-width: 600px) {
    .container {
        max-width: 100%;
        margin: 20px auto;
        padding: 10px;
    }

    input[type="text"] {
        flex: 1;
        padding: 6px;
        font-size: 14px;
    }

    button {
        padding: 6px 10px;
        font-size: 14px;
    }

    li {
        padding: 8px;
        font-size: 14px;
    }
}

   </style>
</head>
<body>
    <div class="container">
        <h1>Todo List</h1>
        <form id="todo-form">
            <input type="text" id="task-input" placeholder="Enter task">
            <button type="submit"><i class="fa fa-paper-plane"></i></button>
        </form>
        <ul id="task-list"></ul>
    </div>

    <script >
       document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('todo-form');
    const taskInput = document.getElementById('task-input');
    const taskList = document.getElementById('task-list');
    let tasks = [];

    // Load tasks from local storage
    if (localStorage.getItem('tasks')) {
        tasks = JSON.parse(localStorage.getItem('tasks'));
        renderTasks();
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const taskText = taskInput.value.trim();
        if (taskText !== '') {
            addTask(taskText);
            taskInput.value = '';
        }
    });

    taskList.addEventListener('click', function(event) {
        const target = event.target;
        if (target.classList.contains('delete-btn')) {
            const index = parseInt(target.parentElement.parentElement.dataset.index);
            deleteTask(index);
        } else if (target.classList.contains('edit-btn')) {
            const index = parseInt(target.parentElement.parentElement.dataset.index);
            editTask(index);
        } else if (target.classList.contains('complete-btn')) {
            const index = parseInt(target.parentElement.parentElement.dataset.index);
            toggleComplete(index);
        }
    });

    function addTask(taskText) {
        tasks.push({ text: taskText, completed: false });
        saveTasks();
        renderTasks();
    }

    function deleteTask(index) {
        tasks.splice(index, 1);
        saveTasks();
        renderTasks();
    }

    function editTask(index) {
        const newText = prompt('Enter new task text:', tasks[index].text);
        if (newText !== null && newText.trim() !== '') {
            tasks[index].text = newText.trim();
            saveTasks();
            renderTasks();
        }
    }

    function toggleComplete(index) {
        tasks[index].completed = !tasks[index].completed;
        saveTasks();
        renderTasks();
    }

    function saveTasks() {
        localStorage.setItem('tasks', JSON.stringify(tasks));
    }

    function renderTasks() {
        taskList.innerHTML = '';
        tasks.forEach((task, index) => {
            const li = document.createElement('li');
            li.innerHTML = `
                <span class="${task.completed ? 'completed' : ''}">${task.text}</span>
                <div>
                    <button class="edit-btn"><i class="fa fa-pencil"></i></button>
                    <button class="delete-btn"><i class="fa fa-trash"></i></button>
                    <button class="complete-btn">${task.completed ? '<i class="fa fa-undo"></i>' : '<i class="fa fa-check"></i>'}</button>
                </div>
            `;
            li.dataset.index = index;
            taskList.appendChild(li);
        });
    }
});


    </script>
</body>
</html>

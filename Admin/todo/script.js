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
            const index = parseInt(target.parentElement.dataset.index);
            deleteTask(index);
        } else if (target.classList.contains('edit-btn')) {
            const index = parseInt(target.parentElement.dataset.index);
            editTask(index);
        } else if (target.classList.contains('complete-btn')) {
            const index = parseInt(target.parentElement.dataset.index);
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
        const newText = prompt('Enter new task text:');
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
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Delete</button>
                    <button class="complete-btn">${task.completed ? 'Undo' : 'Complete'}</button>
                </div>
            `;
            li.dataset.index = index;
            taskList.appendChild(li);
        });
    }
});

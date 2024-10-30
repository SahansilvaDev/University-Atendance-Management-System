const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})






const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 570) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})


document.addEventListener("DOMContentLoaded", function () {
	const taskInput = document.getElementById("taskInput");
	const addTaskButton = document.getElementById("addTaskButton");
	const taskList = document.getElementById("taskList");

	addTaskButton.addEventListener("click", function () {
			const taskText = taskInput.value.trim();
			if (taskText !== "") {
					addTaskToList(taskText);
					taskInput.value = "";
			}
	});

	function addTaskToList(taskText) {
			const listItem = document.createElement("li");
			listItem.className = "list-group-item d-flex justify-content-between align-items-center mb-2  bg-lightblue bg-gradient ";
			listItem.innerHTML = `
					<input type="radio" class="form-check-input me-2 " name="taskStatus" aria-label="Task Done">
					<span>${taskText}</span>
					<span class="badge bg-danger delete-task ">X</span>
			`;
			listItem.className += "bg_color";
			taskList.appendChild(listItem);

			const deleteButton = listItem.querySelector(".delete-task");
			const radioInput = listItem.querySelector("input[type='radio']");

			deleteButton.addEventListener("click", function () {
					taskList.removeChild(listItem);
			});

			radioInput.addEventListener("change", function () {
					listItem.querySelector("span").classList.toggle("done", this.checked);
			});
	}
});

$('.pin-input').on('input', function() {
	var index = $('.pin-input').index(this);
	if (index < 3 && $(this).val().length === 1) {
			$('.pin-input').eq(index + 1).focus();
	}
});


function previewImage(input) {
	var preview = document.getElementById('image-preview');
	preview.innerHTML = '';
	
	if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
					var img = document.createElement('img');
					img.src = e.target.result;
					preview.appendChild(img);
			}

			reader.readAsDataURL(input.files[0]);
	}
}
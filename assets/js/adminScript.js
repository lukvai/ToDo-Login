var task = new XMLHttpRequest();

task.onreadystatechange = function(){
    if(task.readyState === 4){
        var tasks = JSON.parse(task.responseText);
        var output= '<table class="table" >';
        output += '<tr>';
        output += '<th>ID</th>';
        output += '<th>Subject</th>';
        output += '<th>For</th>';
        output += '<th>Completion</th>';
        output += '<th>Remove</th>';
        output += '<th>Edit</th>';
        output += '</tr>';

        for(key in tasks){
            output += '<tr>';
            output += '<td>' + tasks[key]['id'] + '</td>';
            output += '<td>' + tasks[key]['taskSubject'] + '</td>';
            output += '<td>' + tasks[key]['uname'] + '</td>';

            if(tasks[key]['finished'] == 0) {
                output += '<td>'  +  '<a' + tasks[key]['id'] + ' ><i class="fas fa-check-square" style="color: #ff5454"></i></a></td>';
            }else{
                output += '<td>' +  '<a' + tasks[key]['id'] + ' class="completed"><i class="fas fa-check-square" style="color: #18ff3b"></i></a></td>';
            }
            output += '<td><a href=?delete&id=' + tasks[key]['id'] + ' class="btn btn-danger">Delete Task</a></td>';
            output += '<td><a href="#newTaskForm" class="btn btn-warning editTask">Edit Task</a></td>';

            output += '</tr>';
        }

        output += '</table>';
        output += '<a class="btn btn-primary" id="addTask" href="#newTaskForm">Add Task</a>';
        output += '<a class="btn btn-danger" onclick="hideCompleted()" style="margin-left: 15px">Hide Completed</a>';
        document.getElementById('tasks').innerHTML = output;

        var addTask_btn = document.getElementById('addTask');
        addTask_btn.addEventListener('click',addTask);

        var editTask_btn = document.getElementsByClassName('editTask');
        for(i=0; i<editTask_btn.length; i++){
            editTask_btn[i].onclick = function(e){
                var IDValue = e.target.parentElement.parentElement.cells[0].innerText;
                var taskValue = e.target.parentElement.parentElement.cells[1].innerText;
                var form = '<form class="col-md-4" style="padding-left: 0; margin: 15px 0">';
                form += '<div class="form-group">'
                form += '<input type="text" class="form-control" name="editID" placeholder="Subject" id="editID" value="Task ID '+IDValue+'"" readonly>';
                form +='</div>';
                form += '<div class="form-group">'
                form += '<input type="text" class="form-control" name="editSubject" placeholder="Subject" id="editSubject" value="'+taskValue+'"" required pattern="[aA-zZ0-9_ ]{3,30}">';
                form +='</div>';
                form += '<div class="form-group"><select name="done" class="form-control">';
                form += '<option selected disabled>Done?</option>';
                form += '<option value="1">Yes</option>';
                form += '<option value="0">No</option>';
                form +='</select></div>';
                form += '<button id="confirm" name="edit" class="btn btn-primary">Confirm</button><button type ="button" id="cancel" onClick="cancelForm()" class="btn btn-dark float-right">Cancel</button>';
                form += '</form>';
                document.getElementById('newTaskForm').innerHTML = form;
            }
       
        }

    }
}

task.open('GET', '../tasks.json');
task.send();

function addTask(){
    var username = new XMLHttpRequest();
    username.onreadystatechange = function(){
      if(username.readyState === 4){
        var usernames = JSON.parse(username.responseText);
        var form = '<form class="col-md-4" style="padding-left: 0; margin: 15px 0">';
        form += '<div class="form-group"><select name="userid" class="form-control">';
          for(key in usernames){
            form += '<option value='+usernames[key]["uid"]+'>' + usernames[key]['uname'] + '</option>';
          }
      }
    form +='</select></div>';
    form += '<div class="form-group"><input type="text" class="form-control" name="subject" placeholder="Subject" id="newSubject" required pattern="[aA-zZ0-9_ ]{3,30}"></div>';
    form += '<button id="confirm" name="confirm" class="btn btn-primary">Confirm</button><button type ="button" id="cancel" onClick="cancelForm()" class="btn btn-dark float-right">Cancel</button>';
    form += '</form>';
    document.getElementById('newTaskForm').innerHTML = form;
    }
    username.open('GET', '../usernames.json');
    username.send();
}

function cancelForm(){
    document.getElementById('newTaskForm').innerHTML = "";

}

function hideCompleted(){
   var x = document.getElementsByClassName('completed');
   for(i = 0; i<x.length; i++){
      x[i].parentElement.parentElement.style.display = 'none';
    }
}


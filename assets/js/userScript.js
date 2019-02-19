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
        output += '<th>Set Completion</th>';
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
            output += '<td><a href="#newTaskForm" class="btn btn-dark editTask">Finished ?</a></td>';

            output += '</tr>';
        }

        output += '</table>';
        output += '<a class="btn btn-danger" onClick="hideCompleted()">Hide Completed</a>';
        document.getElementById('tasks').innerHTML = output;

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

function cancelForm(){
    document.getElementById('newTaskForm').innerHTML = "";

}

function hideCompleted(){
   var x = document.getElementsByClassName('completed');
   for(i = 0; i<x.length; i++){
      x[i].parentElement.parentElement.style.display = 'none';
    }
}
$("document").ready(function() 
{
    checkLogIn();
});

function checkLogIn()
{
    $.ajax({

        url: "lib/router/router.php?action=checkLogIn&controller=user",
        type: "GET",
        data: '',
        success: function(data) {
            if (data == '1')
            {
                getTables(); 
                $("#usercontent").fadeIn(1500); 
                $("#authorizationform").css("display", "none");
            }
        },
            
        error: function() {
            alert('Error');
        }
    });
}


function logOut()
{
    $.ajax({

        url: "lib/router/router.php?action=logOut&controller=user",
        type: "GET",
        data: '',
        success: function(data) {
            $("#usercontent").fadeOut(1000);
            $("#authorizationform").fadeIn(1500);
        },
            
        error: function() {
            alert('Error');
        }
    });

}

function logIn()
{
    authData = $("#authorizationform").serialize();
    $("#errorsection").empty();

    $.ajax({

        url: "lib/router/router.php?action=logIn&controller=user",
        type: "POST",
        data: authData,
        success: function(data) {
            //$("#errorsection").append(data);
            if (data === '1') {
                $("#usercontent").fadeIn(1000);
                $("#authorizationform").fadeOut(1000);
                getTables();
            }
            if (data == '0') {
                $("#errorsection").append('Неверный логин или пароль');
            }
        },
        error: function() {
            alert('Error');
        }
    });
}

function register()
{
    authData = $("#authorizationform").serialize();
    $("#errorsection").empty();

    $.ajax({

        url: "lib/router/router.php?action=register&controller=user",
        type: "POST",
        data: authData,
        success: function(data) {
            //alert(data);
            if (data == '7') {
                $("#errorsection").append('Пользователь с таким именем уже зарегестрирован');
            }
            if (data == '1') {
                $("#errorsection").append('Вы успешно зарегестрировались. Теперь войдите');
            }
            if (data == '0') {
                $("#errorsection").append('Произошла неизвестная ошибка, попробуйте еще раз');
            }
        },
            
        error: function() {
            alert('Error');
        }
    });
}


function sortTasks()
{
    sortParametr = $("#sortform").serialize();
    getTables(sortParametr);
}


function insertTask()
{
    taskBody = $("#taskaddform").serialize();

    $.ajax({

        url: "lib/router/router.php?action=insertTask&controller=task",
        type: "POST",
        data: taskBody,
        success: function(data) {
            $("#errorsection").append(data);
            getTables();
        },
            
        error: function() {
            alert('Error');
        }
    });
}

function getTables (sortParametr = '') {

	$("#tableholder").empty();
    $("#tableholder").css('dislpay', 'none');

    if (sortParametr == '')
    {
        sortParametr = {sort: 'date_added DESC'};
    }
    
	$.ajax({

	    url: "lib/router/router.php?action=getInfoTaskTable&controller=task",
	    type: "POST",
	    data: sortParametr,
	    success: function(data) {
            table1 = data;
            $("#tableholder").append(table1);
            getInfoMyTaskTable(sortParametr);
	    },

	    error: function() {
	        alert('Error');
	    }
	});

        $("#tableholder").fadeIn(500);
}

function getInfoMyTaskTable(sortParametr)
{
    $.ajax({

        url: "lib/router/router.php?action=getInfoMyTaskTable&controller=task",
        type: "POST",
        data: sortParametr,
        success: function(data) {
            table2 = data;
            $("#tableholder").append(table2);
        },

        error: function() {
            alert('Error');
        }
    });

}
			
		

function setUserInCharge (formId, id)
{
	userData = $("#"+formId).serializeArray();
	
	$.ajax({

		url: ("lib/router/router.php?action=setUserInCharge&controller=task&id="+id),
	    type: "GET",
	    data: userData,
	    success: function(data) {
	    	getTables();
	        //$("#errorsection").append(data);
	    },

	    error: function() {
	        alert('Error');
	    }
	});
}


function changeStatus(id, value) {
				
	$.ajax({

        url: ("lib/router/router.php?action=changeStatus&controller=task&id="+id+"&value="+value),
        type: "GET",
        data: '',
        success: function(data) {
       		getTables();
        },
            
        error: function() {
        	alert('Error');
        }
	});
}

function deleteTask(id) {
	$.ajax({

        url: ("lib/router/router.php?action=deleteTask&controller=task&id="+id),
        type: "GET",
        data: '',
        success: function() {
            getTables();
        },
                    
        error: function() {
            alert('Error');
        }
	});
}

function changeTaskDescription () {

	description = $("#taskchangeform").serialize();

	$.ajax({

        url: "lib/router/router.php?action=changeTaskDescription&controller=task",
        type: "POST",
        data: description,
        success: function() {
            getTables();
        },
                    
        error: function() {
            alert('Error');
        }
	});

}

function openChangeForm (description, id) {

	form = '<div class="a"><form id="taskchangeform" class="popupform"><p>Закрыть окно - кнопка close</p> <input placeholder="Описание задачи" type="text" name="description" value="'+description+'"> <input type="hidden" name="id" value="'+id+'"> <input type="button" value="Изменить" onclick="changeTaskDescription()"> </form></div>';

	$(form).fadeIn(500).dialog({
  	autoOpen: true,
  	height: 200,
  	width: 300,
  	
	});
}
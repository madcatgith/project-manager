function build_project_list(order,search){
//Получаем список проектов
    var options={"select_all":"true","order":order,"search":search}; //опция получения
    jQuery.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "ajax/select.php", //url-адрес, по которому будет отправлен запрос
            dataType:"json", // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
            data:options, //данные, которые будут отправлены на сервер (post переменные)
            success:function(response){
              
              var first=true;
              //выводим список проектов
              $('.list-group').empty();
              if (response!="no_data"){
                $('#results').hide();
              for(key in response){
                $('.list-group').append('<a href="#"  id="'+response[key]['pid']+'" class="list-group-item">'+response[key]['name']+'</a>');
                if (first){
                  $('#'+response[key]['pid']).addClass('active');
                  //первый проект в списке
                  $.post("ajax/select.php",{show_acc:'true',p_id:response[key]['pid']},function(data){//запрос на выборку данных первого проекта и выделение
                    $('.panel-body').empty();
                    parse_project_data(data);
                    },"json");
                        first=false;
                    }

                    $('#total').html(parseInt(key)+1);
                }
                //Событие при нажатии
                    $('.list-group-item').on('click',function(){
                        $('.list-group-item').removeClass('active');
                        $(this).addClass('active');
                        $.post("ajax/select.php",{show_acc:'true',p_id:$(this).attr("id")},function(data){
                        $('.main-panel').empty();
                        parse_project_data(data);
                    },"json");
                        $('body,html').animate({
                            scrollTop: 0
                        }, 400);
                        return false;
                });
            } else {
                $('#results').show();
                $('#results').html('No such items');}
        },
            error:function (xhr, ajaxOptions, thrownError){
                console.log(thrownError); //выводим ошибку
            }
        });
}


function parse_project_data(data_arr){
    $('#project_name').empty();
    $('#project_name').append(data_arr['name']);
    $('.main-panel').append('<div class="row"><div class="col-md-12" id="url_box"></div></div>');
    $('#url_box').append('<p><a class="url" href="'+data_arr['url']+'">'+data_arr['url']+'</a></p>');
    var ftpbox='<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">FTP</h3></div><div class="panel-body" id="ftp_holder"></div></div>';
    var cmsbox='<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">CMS</h3></div><div class="panel-body" id="cms_holder"></div></div>';
    var hostbox='<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">HOST</h3></div><div class="panel-body" id="host_holder"></div></div>';
    var dbbox='<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">Database</h3></div><div class="panel-body" id="db_holder"></div></div>';
    var boxes=[];
    if ((data_arr['cms_type']!='')&&(data_arr['cms_type']!=null)){
        boxes.push(cmsbox);
    }
    if ((data_arr['ftp_server']!='')&&(data_arr['ftp_server']!=null)){
        boxes.push(ftpbox);
    }
    if ((data_arr['host_server']!='')&&(data_arr['host_server']!=null)){
        boxes.push(hostbox);
    }
    if ((data_arr['db']!='')&&(data_arr['db']!=null)){
        boxes.push(dbbox);
    }

    for (i=0;i<boxes.length;i++) {
        if ((i%2)==0){
        $('.main-panel').append('<div class="row">'); if (boxes[i+1]!=null){
            col='<div class="col-md-6">';
        } else {col='<div class="col-md-12">';}
    }
        else {col='<div class="col-md-6">';}
        $('.main-panel').append(col+boxes[i]+'</div>');
        if ((i%2)!=0){
        $('.main-panel').append('</div>');}
    }

    $('#cms_holder').append('<p><strong>Type: </strong><a class="copy" id="cms1" data-clipboard-target="#cms1">'+data_arr['cms_type']+'</a></p>');
    $('#cms_holder').append('<p><strong>Login: </strong><a class="copy" id="cms2" data-clipboard-target="#cms2">'+data_arr['cms_login']+'</p>');
    $('#cms_holder').append('<p><strong>Password: </strong><a class="copy" id="cms3" data-clipboard-target="#cms3">'+data_arr['cms_password']+'</p>');
    $('#ftp_holder').append('<p><strong>Server: </strong><a class="copy" id="ftp1" data-clipboard-target="#ftp1">'+data_arr['ftp_server']+'</p>');
    $('#ftp_holder').append('<p><strong>Login: </strong><a class="copy" id="ftp2" data-clipboard-target="#ftp2">'+data_arr['ftp_login']+'</p>');
    $('#ftp_holder').append('<p><strong>Password: </strong><a class="copy" id="ftp3" data-clipboard-target="#ftp3">'+data_arr['ftp_password']+'</p>');
    $('#host_holder').append('<p><strong>Server: </strong><a href="'+data_arr['host_server']+'">'+data_arr['host_server']+'</a></p>');
    $('#host_holder').append('<p><strong>Login: </strong><a class="copy" id="host1" data-clipboard-target="#host1">'+data_arr['host_login']+'</p>');
    $('#host_holder').append('<p><strong>Password: </strong><a class="copy" id="host2" data-clipboard-target="#host2">'+data_arr['host_password']+'</p>');
    $('#db_holder').append('<p><strong>DB Name: </strong><a class="copy" id="db1" data-clipboard-target="#db1">'+data_arr['db']+'</p>');
    $('#db_holder').append('<p><strong>Login: </strong><a class="copy" id="db2" data-clipboard-target="#db2">'+data_arr['db_login']+'</p>');
    $('#db_holder').append('<p><strong>Password: </strong><a class="copy" id="db3" data-clipboard-target="#db3">'+data_arr['db_password']+'</p>');
    $('#desc').hide();
    if ((data_arr['desc']!=null) && (data_arr['desc']!='')){
    $('#desc').show();
    $('#desc .panel-body').empty();
    $('#desc .panel-body').append('<p>'+data_arr['desc']+'</p>');}
    $('#curr_id').val(data_arr['p_id']);
    $('#curr_name').val(data_arr['name']);
    $('#curr_url').val(data_arr['url']);
    $('#curr_cms_type').val(data_arr['cms_type']);
    $('#curr_cms_login').val(data_arr['cms_login']);
    $('#curr_cms_password').val(data_arr['cms_password']);
    $('#curr_ftp_server').val(data_arr['ftp_server']);
    $('#curr_ftp_login').val(data_arr['ftp_login']);
    $('#curr_ftp_password').val(data_arr['ftp_password']);
    $('#curr_host_server').val(data_arr['host_server']);
    $('#curr_host_login').val(data_arr['host_login']);
    $('#curr_host_password').val(data_arr['host_password']);
    $('#curr_db').val(data_arr['db']);
    $('#curr_db_login').val(data_arr['db_login']);
    $('#curr_db_password').val(data_arr['db_password']);
    $('#curr_desc').val(data_arr['desc']);

    if(data_arr['cms_type']=='Webmanager'){
        $('#wurl').val(data_arr['url']);
        $('#admlogin').val(data_arr['cms_login']);
        $('#admpass').val(data_arr['cms_password']);
        $('#login').show();
    }
    else{
      $('#login').hide();  
    }
}

function deletebyid(id){
    $.post("ajax/delete.php",{p_id:id},function(response){
        if ($('#sorter').attr('data')=='ASC'){
            build_project_list('DESC');
        }
        else{
            build_project_list('ASC');
        }
        alert(response);});
}

$(document).ready(function(){
	$('#add_project').on('click',function(){
		var form_data = $('#project').serialize();
		jQuery.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "ajax/add.php", //url-адрес, по которому будет отправлен запрос
            //dataType:"text", // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
            data:form_data, //данные, которые будут отправлены на сервер (post переменные)
            success:function(response){
                if(response!=1){
                    $('#results').addClass('alert alert-success');
            	   $('#results').html(response);
                }
                else
                {
                    $('#results').addClass('alert alert-danger');
                     $('#results').html('Project name is  <strong>empty</strong>');
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                $('#results').addClass('alert alert-danger');
                $('#results').html('<strong>'+thrownError+'</strong>');
            }
        });
        $('input').val('');
        $('#cms_type').val('Bitrix');
        $('#host_pick_server').val('other');
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
	});

    $('#host_pick_server').on('change', function() {
        if ($(this).val()!='other') {
            $('#host_server').val('https://'+$(this).val()+':1500');
            } else {$('#host_server').val('');}
    });

    $('#edit').on('click',function(){
        $('#editform').submit();
    });

    $('#login').on('click',function(){
        $('#login_form').submit();
    });

    $('#exit').on('click',function(){
        return location.href="index.php";
    });

    $('#delete').on('click',function(){
        deletebyid($('#curr_id').val());
    });

    $('#sorter').on('click',function(){
        build_project_list($(this).attr('data'));
        if ($(this).attr('data')=='DESC'){
            $(this).attr('data','ASC');
        }
        else
        {
            $(this).attr('data','DESC');
        }
    });

    $('#search').on('change paste keyup',function(){
        build_project_list('ASC',$(this).val());
    });
});
"use strict";
console.log("hello I'm connected to the world");

$(document).ready(function(){
    console.log("All Elements in the Page was successfully loaded, we can begin our application logic");
    retrieveProjects();

    $("#signinBtn").click(function(){

        //grabs data from the form elements
        var data = {
            username: $("#username").val(),
            password:  $("#password").val()
        };

        $.post('../index.php/loginAction', data, function(response) {
            response = JSON.parse(response);
            if(response.status == "success"){
                window.location.href = "../profile.php/home";
                localStorage.setItem("Login-userid", response.userid);
            }else{
                alert("Invalid Login");
            }

        });
    });


});


function retrieveProjects(){

    $.get("../index.php/projects", processAllProjects, "json");
    
}

function retrieveProjects2(){

    //$.get("download.php/viewDld", processAllProjects, "json");
    
}

function processAllProjects(records){
    console.log(records);
    createTable2(records);
   
}

function createTable(records){
    var key;
    var sec_id = "#table_sec";
    var htmlStr = $("#table_heading").html(); //Includes all the table, thead and tbody declarations

    records.forEach(function(el){
        htmlStr += "<tr> <td>" + el['id'] + "</td>" + "<td>" + el['projname'] + "</td>"+"<td>"+ el['coursecode'] +"</td> <td>"+ el['coursename'] +"</td> <td>"+ el['githublink'] +"</td>"+ "<td>"+ el['year'] +"</td> <td>"+ el['file'] +"</td> </tr>"+ el['members'] +"</td> </tr>";
    });
    
    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
}

function createTable2(records){
    var key;
    var sec_id = "#table_sec";
    var htmlStr = $("#table_heading").html(); //Includes all the table, thead and tbody declarations

   records.forEach(function(el){
        htmlStr += "<tr> <td>" 
                    //+el['id'] +"</td>" 
                    //+"<td>"
                    + el['projname'] + "</td>"
                    +"<td>"+ el['coursecode'] +"</td>"
                    +"<td>"+ el['coursename'] +"</td>"
                    +"<td>"+ el['coursename'] +"</td>"
                    +"<td>"+ el['githublink'] +"</td>"
                    +"<td>"+ el['year'] +"</td>"
                    +"<td>"+ el['file'] +"</td>"
                    +"<td>"+ el['members'] +"</td> </tr>" ;
    });
    
    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
}

/*
$(function() {
    
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });

}); */

$(function(){
    $('INPUT[type="file"]').change(function () {
        var ext = this.value.match(/\.(.+)$/)[1];
        switch (ext) {
            case 'zip':
            case 'rar':
            case '7z':
                $('#saveBtn').attr('disabled', false);
                break;
            default:
                alert('This is not an allowed file type.');
                this.value = '';
        }
    });
});
console.log("JavaScript file was successfully loaded in the page");
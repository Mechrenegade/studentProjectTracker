"use strict";
console.log("hello I'm connected to the world");

$(document).ready(function(){
    console.log("All Elements in the Page was successfully loaded, we can begin our application logic");
    retrieveProjects();
});


function retrieveProjects(){
    $.get("index.php/projects", processAllProjects, "json");
    
}

function processAllProjects(records){
    console.log(records);
    createTable(records);
   
}

function createTable(records){
    var key;
    var sec_id = "#table_sec";
    var htmlStr = $("#table_heading").html(); //Includes all the table, thead and tbody declarations
    console.log("hey3");

    records.forEach(function(el){
        htmlStr += "<tr> <td>" + el['id'] + "</td>" + "<td>" + el['projname'] + "</td>"+"<td>"+ el['coursecode'] +"</td> <td>"+ el['coursename'] +"</td> <td>"+ el['githublink'] +"</td> </tr>"+ el['year'] +"</td> <td>"+ el['file'] +"</td> </tr>"+ el['members'] +"</td> </tr>";
    });
    console.log("hey4");

    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
}
/*
function createTable(records){
    var key;
    var sec_id = "#table_sec";
    var htmlStr = $("#table_heading").html(); //Includes all the table, thead and tbody declarations

    records.forEach(function(el){
        htmlStr += "<tr> <td>" + el['name'] + "</td>" + "<td>" + el['price'] + "</td>"+"<td>"+ el['country'] +"</td> <tr>" ;
    });
    
    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
} */
console.log("JavaScript file was successfully loaded in the page");
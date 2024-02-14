<?php

/*

{
    "success":true,
    "tasks":[
        {
            "name":"task1",
            "description":"description1",
            "project":"project1"
        },
        {
            "name":"task2",
            "description":"description2",
            "project":"project2"
        }
    ],
    "tickets":[
        {
            "name":"ticket1",
            "description":"description1",
            "active":true,
        }
    ]

}
*/
require_once 'utils/security.php';



requireLogin();

$uid = $_SESSION['id'];

//print_r($_SESSION);

$sql =
    "SELECT tasks.id, tasks.title, tasks.description,  tasks.projects_id
FROM tasks
inner JOIN works_on_task ON tasks.id = works_on_task.tasks_id
inner join users ON works_on_task.users_id = users.id
WHERE works_on_task.users_id = '$uid';";


$sql2 =
    "SELECT  tickets.id, tickets.name, tickets.description, tickets.projects_id
    from tickets
    WHERE tickets.users_id= '$uid' and active = 1;";



$rs1 = $db->query($sql);
$rs2 = $db->query($sql2);


//$projectResult=$db->query($project);

$json = array();

if ($rs1->num_rows === 0) {
    $json['success'] = false;
    die(json_encode($json));
}

if ($rs2->num_rows === 0) {
    $json['success'] = false;
    die(json_encode($json));
}


$json['success'] = true;

$tasks = array();

while ($row = $rs1->fetch_assoc()) {
    $project_sql = "SELECT projects.name FROM projects WHERE projects.id= '$row[projects_id]';";
    $project_result = $db->query($project_sql);

    $row['project'] = $project_result->fetch_assoc()['name'];
    $tasks[] = $row;
}


$tickets = array();
while ($row = $rs2->fetch_assoc()) {
    $tickets_sql = "SELECT projects.name FROM projects WHERE projects.id= '$row[projects_id]';";
    $tickets_result = $db->query($tickets_sql);

    $row['project'] = $tickets_result->fetch_assoc()['name'];
    $tickets[] = $row;
}



$json['tasks'] = $tasks;
$json['tickets'] = $tickets;

die(json_encode($json));



<?php
try{
    $DB=new mysqli("localhost","root","","gas");
    
}catch(Exception $e){
    $DB=new mysqli("localhost","root","");
    if($DB->connect_error){
        die("Database Server Down");
    }
    ########################################## CREATE DATABASE #
    require __DIR__."/structure.php";

    create_database($DB);
    create_users_table($DB);
    create_admins_table($DB);
    create_teachers_table($DB);
    create_departments_table($DB);
    create_programs_table($DB);
    create_batches_table($DB);
    create_students_table($DB);
    create_semesters_table($DB);
    create_courses_table($DB);
    create_buildings_table($DB);
    create_rooms_table($DB);
    create_sections_table($DB);
    create_student_semester_table($DB);
    create_sessions_table($DB);
    create_attendances_table($DB);
    
}


?>
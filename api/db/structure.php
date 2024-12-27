<?php
    ############################################################## CREATE DATABASE #
    function create_database($DB){
        $DB->query("CREATE DATABASE IF NOT EXISTS GAS");
        $DB->select_db("GAS");
    }
    ############################################################# CREATE TABLES #
    ///////////////////////////////////////////////////////////// USERS #
    function create_users_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255),
            password VARCHAR(255) DEFAULT '123'
        )");
    }
    ///////////////////////////////////////////////////////////// ADMINS #
    function create_admins_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS admins(
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255),
            name VARCHAR(255),
            email VARCHAR(255),
            phone VARCHAR(255),
            position VARCHAR(255),
            added_by INT DEFAULT 0,
            user_id INT DEFAULT 0,
    
            FOREIGN KEY (added_by) REFERENCES admins(id),
            FOREIGN KEY (user_id) REFERENCES users(id)
        )");
    }
    ///////////////////////////////////////////////////////////// TEACHERS #
    function create_teachers_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS teachers(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            email VARCHAR(255),
            phone VARCHAR(255),
            position VARCHAR(255),
            added_by INT DEFAULT 0,
            user_id INT DEFAULT 0,
    
            FOREIGN KEY (added_by) REFERENCES admins(id),
            FOREIGN KEY (user_id) REFERENCES users(id)
        )");
    }
    ///////////////////////////////////////////////////////////// STUDENTS #
    function create_students_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS students(
            `index` INT AUTO_INCREMENT PRIMARY KEY,
            id INT,
            name VARCHAR(255),
            email VARCHAR(255),
            phone VARCHAR(255),
            department INT DEFAULT 0,
            program INT DEFAULT 0,
            batch INT DEFAULT 0,
            added_by INT DEFAULT 0,
            user_id INT DEFAULT 0,
            is_Active BOOLEAN DEFAULT 1,
    
            FOREIGN KEY (added_by) REFERENCES admins(id),
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (department) REFERENCES departments(id),
            FOREIGN KEY (program) REFERENCES programs(id),
            FOREIGN KEY (batch) REFERENCES batches(id),
            UNIQUE (id, email)
        )");
    }
    ///////////////////////////////////////////////////////////// DEPARTMENTS #
    function create_departments_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS departments(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) UNIQUE,
            added_by INT DEFAULT 0,
    
            FOREIGN KEY (added_by) REFERENCES admins(id)
        )");
    }
    ///////////////////////////////////////////////////////////// PROGRAMS #
    function create_programs_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS programs(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            duration INT DEFAULT 0, # day example 365day => 1year (Masters)
            department INT DEFAULT 0,
    
            FOREIGN KEY (department) REFERENCES departments(id),
            UNIQUE (name)
        )");
    }
    ///////////////////////////////////////////////////////////// BATCHES #
    function create_batches_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS batches(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            type ENUM('Regular','Weekend','Evening'),
    
            UNIQUE (name)
        )");
    }
    
    ///////////////////////////////////////////////////////////// SEMESTERS #
    function create_semesters_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS semesters(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            start_date DATE,
            end_date DATE,
            program INT DEFAULT 0,
            batch INT DEFAULT 0,

            FOREIGN KEY (program) REFERENCES programs(id),
            FOREIGN KEY (batch) REFERENCES batches(id),
            UNIQUE (name, program, batch, start_date, end_date)
        )");
    }

    ///////////////////////////////////////////////////////////// COURSES #
    function create_courses_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS courses(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            code VARCHAR(255),
            credit INT DEFAULT 0,
            
            UNIQUE (code)
        )");
    }

    ///////////////////////////////////////////////////////////// SECTIONS #
    function create_sections_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS sections(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            room INT DEFAULT 0,

            FOREIGN KEY (room) REFERENCES rooms(id),
            UNIQUE (name)
        )");
    }

    ///////////////////////////////////////////////////////////// ROOMS #
    function create_rooms_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS rooms(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            capacity INT DEFAULT 30,
            type VARCHAR(255) DEFAULT 'Classroom',
            floor INT DEFAULT 0,
            building INT DEFAULT 0,

            FOREIGN KEY (building) REFERENCES buildings(id),
            UNIQUE (name, building, floor)
        )");
    }

    ///////////////////////////////////////////////////////////// BUILDINGS #
    function create_buildings_table($DB) {
        $DB->query("CREATE TABLE IF NOT EXISTS buildings(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            location VARCHAR(255),
            type VARCHAR(255) DEFAULT 'Academic',
           
            UNIQUE (name, location)
        )");
    }

    ///////////////////////////////////////////////////////////// STUDENT-SEMESTER #
    function create_student_semester_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS student_semester(
            id INT AUTO_INCREMENT PRIMARY KEY,
            student INT DEFAULT 0,
            semester INT DEFAULT 0,
            
            FOREIGN KEY (student) REFERENCES students(id),
            FOREIGN KEY (semester) REFERENCES semesters(id),
            UNIQUE (student, semester)
        )");
    }
    
    ///////////////////////////////////////////////////////////// SESSIONS #
    function create_sessions_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS sessions(
            id INT AUTO_INCREMENT PRIMARY KEY,
            day VARCHAR(255), # json string-> array of days ['Monday', 'Tuesday']
            start_time VARCHAR(255), # 24 hour format
            end_time VARCHAR(255), # 24 hour format
            course INT DEFAULT 0,
            teacher INT DEFAULT 0,
            section INT DEFAULT 0,
            semester INT DEFAULT 0,
            room INT DEFAULT 0,
            is_Active BOOLEAN DEFAULT 1,
            
            FOREIGN KEY (course) REFERENCES courses(id),
            FOREIGN KEY (teacher) REFERENCES teachers(id),
            FOREIGN KEY (section) REFERENCES sections(id),
            FOREIGN KEY (semester) REFERENCES semesters(id),
            FOREIGN KEY (room) REFERENCES rooms(id),
            UNIQUE (start_time, end_time, day, course, teacher, section, room)
        )");

        ///////////////////////////////////////////////////////////// SESSION-STUDENTS #
        $DB->query("CREATE TABLE IF NOT EXISTS session_students(
            id INT AUTO_INCREMENT PRIMARY KEY,
            session INT DEFAULT 0,
            student INT DEFAULT 0,
            is_Active BOOLEAN DEFAULT 1,
            
            FOREIGN KEY (session) REFERENCES sessions(id),
            FOREIGN KEY (student) REFERENCES students(id),
            UNIQUE (session, student)
        )");
    }

    ///////////////////////////////////////////////////////////// ATTENDANCES #
    function create_attendances_table($DB){
        $DB->query("CREATE TABLE IF NOT EXISTS attendances(
            id INT AUTO_INCREMENT PRIMARY KEY,
            session INT DEFAULT 0,
            student INT DEFAULT 0,
            is_Present BOOLEAN DEFAULT 1,
            date VARCHAR(255), # date format 'd-m-y'
            
            FOREIGN KEY (session) REFERENCES sessions(id),
            FOREIGN KEY (student) REFERENCES students(id)
        )");
        
    }

    ///////////////////////////////////////////////////////////// CREATE 1 default USER + ADMIN #
    function create_default_user($DB){
        $DB->query("INSERT INTO users(username) VALUES('admin')");
        $DB->query("INSERT INTO admins(username, name, email, phone, position, user_id)
         VALUES('admin', 'Admin', 'ashikur.gub@gmail.com', '01700000000', 'Admin', 1)");
    } 
?>
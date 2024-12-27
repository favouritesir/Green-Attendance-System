<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Page</title>
</head>
<body>
    
    <h1>
        <c-icon>event_available</c-icon>
        Green Attendance System
    </h1>
    <!-- <form> -->
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <button id="login">Login</button>

    <!-- </form> -->
   
    <script>
        $("#login").addEventListener('click',()=>{
            let username=$('#username').value;
            let password=$('#password').value;
            let data=new FormData();
            data.append('username',username);
            data.append('password',password);
            $post('auth',data,function(res){
                console.log(res.body);
            });
            
        });

        function handleLogin(){
            // console.log("start")
        }
    </script>
    
</body>
</html>

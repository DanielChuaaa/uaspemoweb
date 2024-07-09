<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
         body {
            font-family: "Poppins", sans-serif;
            background: #f3f4f6;
            color: #333;
        }
        label{
            color: rgb(248 113 113);
            font-weigth: 500;
        }
         .animate-slide-down {
            animation: slideDown 0.5s ease forwards;
        }
       .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: pulse 2s infinite;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
         @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
    </style>
    <title>Home</title>
</head>
<body>
     <section class="px-8 pt-2">
      <h1 class="showingEmailPassword cursor-pointer absolute text-red-300 hover:text-red-400 transition ease-in-out duration-300 font-bold opacity-60" onclick="toggleEmailPassword()">Click here to Show email and password</h1>
      <div id="emailPassword" class="hidden absolute text-red-300 mt-6 animate-slide-down opacity-60">
          <p>Email: danielchua@gmail.com</p>
          <p>Password: wkwk</p>
      </div>

      <div>
        <h1 class="absolute right-0 pr-8 text-xl"><a href="index.php">Kembali ke artikel</a></h1>
      </div>
    </section>
    <form action="login.php" method="post">
        <div class="containerr flex justify-center items-center px-8 py-8 h-screen pulse">
            <div class="card p-8 rounded-md bg-white"  style="width:400px">
                <h1 class="text-4xl text-center font-bold text-red-400">Welcome</h1>
                <img src="../assets/logo.png" alt="logoIcon" class="mx-auto py-4">
                <div class="flex flex-col gap-6 mt-4">
                    <div class="flex flex-col">
                        <label>Name:</label>
                        <input type="name" name="email" class="font-medium border-b-2 focus:outline-0" style="background:none" required>
                    </div>
                    <div class="flex flex-col">
                        <label>password:</label>
                        <input type="password" name="password"  class="font-medium border-b-2 focus:outline-0" style="background:none" required>
                    </div>
                    <button class="buttonLogin bg-red-300 hover:bg-red-400 rounded-md px-4 py-2 text-white font-medium transition ease-in-out duration-300">Login</button>
                </div>
            </div>
        </div>
    </form>

    <script >
        function toggleEmailPassword() {
            const emailPasswordDiv = document.getElementById("emailPassword");
            if (emailPasswordDiv.classList.contains("hidden")) {
                    emailPasswordDiv.classList.remove("hidden");
            } else {
                emailPasswordDiv.classList.add("hidden");
            }
        }
    </script>
</body>
</html>
    
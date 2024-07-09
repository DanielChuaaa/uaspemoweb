<?php
require_once("koneksi.php");

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case "hapus":
        require_once "hapus.php";
        break;
}
?>

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
        nav ul li a:hover {
            color: rgb(248 113 113);
            transition: color 0.3s;
        }
        nav ul li a {
            transition: color 0.3s;
        }
        .logo img:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }
        .navLink a:hover {
            color: rgb(248 113 113);
            transition: color 0.3s ease-in-out;
        }
        .search button:hover {
            background-color: rgb(239 68 68);
            transition: background-color 0.3s ease-in-out;
        }
        .socialLinks a img:hover {
            transform: scale(1.2);
            transition: transform 0.3s ease-in-out;
        }
        .footerWrapper h5:hover {
            color: rgb(248 113 113);
            transition: color 0.3s ease-in-out;
        }
    </style>
    <title>About Us</title>
</head>
<body>
<header>
    <nav class="flex justify-between items-center px-8 py-4 w-full text-black bg-white">
        <div>
            <a href="#" class="logo">
                <img src="../assets/logo.png" alt="logoimg" style="width:150px;">
            </a>
        </div>
        <ul>
            <div class="navLink flex gap-6 font-medium text-xl">
                <li><a href="index.php">Artikel</a></li>
                <li><a href="#">About Us</a></li>
            </div>
        </ul>
        <div class="search relative flex items-center">
        <button class="font-bold rounded-md bg-red-300 hover:bg-red-400 transition ease-in-out text-white px-4 py-2">
            <a href="loginAdmin.php"> Login </a>
        </button>
        </div>
    </nav>
</header>
<section>
<div class="gridWrapper grid grid-cols-2 justify-items-center items-center py-8 px-4">
    <div>
        <div>
            <h2 class="text-4xl font-bold">Hello Buds I Am</h2>
            <h1 class="text-6xl text-red-500 font-bold mt-4">Daniel Chua</h1>
        </div>
        <div class="border w-40 my-6"></div>
        <p style="max-width:52ch">Hello, my name is Daniel Chua I am a second-year student at STMIK Widya Cipta Dharma studying computer science with interest in Front-end web development. I have spent the last two years studying the foundations of web development, becoming proficient in HTML, CSS, and JavaScript. More recently, I have begun investigate frameworks, like Tailwind CSS.</p>
    </div>
    <div>
        <img src="../assets/foto.jpeg" alt="fotodaniel" width="220px">
    </div>
</div>
</section>

<footer class="absolute w-full bottom-0">
    <div class="footerWrapper flex justify-between items-center p-4 px-8 bg-white">
        <h5 class="text-red-400 text-2xl font-medium">Pemograman Web</h5>
        <div class="flex items-center gap-3 mt-4">
            <p class="text-xl">Find Me On</p>
            <div class="socialLinks flex items-center gap-4">
                <a href="https://www.instagram.com/danieelc28._/?hl=id">
                    <img src="../assets/ig.png" alt="iglogo">
                </a>
                <a href="https://www.linkedin.com/in/daniel-chua-a743a51bb/">
                    <img src="../assets/linkedin.png" alt="linkeinlogo">
                </a>
                <a href="https://www.linkedin.com/in/daniel-chua-a743a51bb/">
                    <img src="../assets/github.png" alt="githublogo">
                </a>
            </div>
        </div>
        <p class="text-red-400 font-medium">Daniel Chua 2243010 TIPB</p>
    </div>
</footer>
</body>
</html>

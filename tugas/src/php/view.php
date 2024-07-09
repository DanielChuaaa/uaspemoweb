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
        .text {
            height: 90px;
            overflow: hidden;
            transition: height 0.5s ease;
        }  
        .text.expanded {
            height: auto;
        }
         nav ul li a:hover {
            color: rgb(248 113 113);
            transition:  color 0.3s;
        }
        .zoom{
             transition: transform .2s;
        }
        .zoom:hover {
            -ms-transform: scale(1.5); /* IE 9 */
            -webkit-transform: scale(1.5); /* Safari 3-8 */
            transform: scale(1.03); 
        }
        .cardChild {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .cardChild:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
    </style>
    <title>Home</title>
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
                <li><a href="#">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </div>
        </ul>
        <div class="search relative flex items-center">
            <img src="../assets/searcha.png" alt="searchicon" class="absolute px-2">
            <input type="text" class="bg-red-400 text-white rounded-md pl-9 py-1" style="outline:none">
        </div>
    </nav>
</header>
<main class="px-8 pb-8">
    <div class="newImage">
        <img id="imagePreview" src="#" alt="New Image" style="display: none;"/>
    </div>


    <div class="inputArticle flex justify-center py-8">
        <div class="relative transition ease-in-out rounded-md pr-4 pl-10 py-4 bg-red-300 hover:bg-red-400 transition ease-in-out delay-150" >
            <img src="../assets/input.png" alt="input logo" class="absolute left-2" style="top:1.2rem">
            <a href="input.php" class="text-white text-xl font-medium"><button>Input Article</button></a>
        </div>
    </div>
    <section>
        <div class="card grid grid-cols-2 gap-8">
            <?php
            $sql = "SELECT artikel.id, artikel.judul, artikel.deskripsi, artikel.isi, artikel.tanggal_publikasi, penulis.nama, artikel.image FROM artikel JOIN penulis ON penulis.id = artikel.penulis";
            $result = $conn->query($sql);
            $articles = $result->fetchAll(PDO::FETCH_ASSOC);

            if ($articles) {
                foreach ($articles as $article) {
                    ?>
                    <div class="cardChild relative text-black p-8 rounded-xl" style="background:#fff">
                        <h1 class="text-4xl text-red-400 font-bold capitalize"><?php echo htmlspecialchars($article['judul']); ?></h1>
                        <?php if (!empty($article['image'])): ?>
                            <img src="uploads/<?php echo htmlspecialchars($article['image']); ?>" alt="Article Image" class="zoom w-full my-2"/>
                        <?php endif; ?>
                        <div class="flex flex-col gap-4">
                            <div >
                                <label>Deskripsi:</label>
                                <p class="text"><?php echo htmlspecialchars($article['deskripsi']); ?></p>
                            </div>

                            <div >
                                <label>Isi:</label>
                                <div class="flex flex-col">
                                    <p class="text" id="text-<?php echo $article['id']; ?>"><?php echo htmlspecialchars($article['isi']); ?></p>
                                    <button class="text-red-400 underline font-medium" id="toggleButton-<?php echo $article['id']; ?>" onclick="toggleText('<?php echo $article['id']; ?>')">Show More</button>
                                </div>
                            </div>

                            <div> 
                                 <label>Date:</label>
                                 <p class=""><?php echo htmlspecialchars($article['tanggal_publikasi']); ?></p>
                            </div>

                            <div>
                                 <label>Penulis:</label>
                                <p class=""><?php echo htmlspecialchars($article['nama']); ?></p>
                            </div>
                        </div>
                        <div class="flex gap-4 mt-4">
                            <a class="bg-red-300 hover:bg-red-400 transition ease-in-out delay-150 px-6 py-2 rounded-md text-white font-medium" href="edit.php?action=edit&id=<?php echo $article['id']; ?>">Edit</a>
                            <a class="bg-red-300 hover:bg-red-400 transition ease-in-out delay-150 px-6 py-2 rounded-md text-white font-medium" href="?action=hapus&id=<?php echo $article['id']; ?>">Delete</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No articles found.</p>";
            }
            ?>
        </div>
    </section>
</main>

<footer>
    <div class="footerWrapper flex justify-between items-center p-4 px-8 bg-white" >
        <h5 class="text-red-400 text-2xl font-medium">Pemograman Web</h5>
        <p class="text-red-400 font-medium">Daniel Chua 2243010 TIPB</p>
    </div>
</footer>

<script src="main.js"></script>
</body>
</html>
    
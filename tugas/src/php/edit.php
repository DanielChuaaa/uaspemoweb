<?php
require_once("koneksi.php");

$action = isset($_GET['action']) ? $_GET['action'] : '';
$article = [
    'id' => '',
    'judul' => '',
    'deskripsi' => '',
    'isi' => '',
    'tanggal_publikasi' => '',
    'penulis' => '',
    'image' => ''
];

if ($action == 'edit') {
    $id = $_GET['id'];
    $sql = "SELECT id, judul, deskripsi, isi, tanggal_publikasi, penulis, image FROM artikel WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $isi = $_POST['isi'];
    $tglpublish = $_POST['tglpublish'];
    $penulis = $_POST['penulis'];
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);

        // Check if directory exists, if not, create it
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move uploaded file to the target directory
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    } else {
        $image = $article['image'];
    }

    if (!empty($id)) {
        if (!empty($image)) {
            $sql = "UPDATE artikel SET judul = ?, deskripsi = ?, isi = ?, tanggal_publikasi = ?, penulis = ?, image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$judul, $deskripsi, $isi, $tglpublish, $penulis, $image, $id]);
        } else {
            $sql = "UPDATE artikel SET judul = ?, deskripsi = ?, isi = ?, tanggal_publikasi = ?, penulis = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$judul, $deskripsi, $isi, $tglpublish, $penulis, $id]);
        }
    } else {
        $sql = "INSERT INTO artikel (judul, deskripsi, isi, tanggal_publikasi, penulis, image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$judul, $deskripsi, $isi, $tglpublish, $penulis, $image]);
    }

    header("Location: view.php");
    exit;
}


$penulis_sql = "SELECT id, nama FROM penulis";
$penulis_stmt = $conn->query($penulis_sql);
$penulis_list = $penulis_stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #f3f4f6;
            color: #333;
        }
        .ffp{
            font-family: "Poppins", sans-serif;
        }
        nav ul li a:hover {
            color: rgb(248 113 113);
            transition:  color 0.3s;
        }
        label{
            font-weight: 500;
            color: black;
            font-size: 1.5rem;
        }
        input[type="file"] {
            display: none;
        }  
    </style>
</head>
<body>
    
<nav class="flex justify-between items-center px-8 py-4 w-full text-black bg-white">
        <div>
            <a href="#" class="logo">
                <img src="../assets/logo.png" alt="logoimg" style="width:150px;">
            </a>
        </div>
        <ul>
            <div class="navLink flex gap-6 font-medium text-xl">
                <li><a href="view.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </div>
        </ul>
        <div class="search relative flex items-center">
           <button class="font-bold rounded-md bg-red-300 hover:bg-red-400 transition ease-in-out delay-150 text-white px-4 py-2">
            <a href="https://www.linkedin.com/in/daniel-chua-a743a51bb/"> Contact Me </a>
        </button>
        </div>
</nav>

<br>
<br>

<form method="POST" class="flex flex-col gap-4 p-8 pb-8 mb-12 mx-auto w-9/12 rounded-md bg-white" action="input.php" enctype="multipart/form-data">
    <h1 class="text-4xl ffp font-bold text-red-400 text-center pt-3" >Edit Article</h1>

    <div class="mt-4" >
        <div class="relative flex items-center mx-auto" style="width:150px">
            <img src="../assets/upload.png" alt="uploadIcon" class="absolute left-2.5">
            <label for="file-upload" class="text-base text-white rounded-md cursor-pointer pl-11 pr-6 py-2 bg-red-300 hover:bg-red-400 transition ease-in-out delay-150"  >
                Upload
            </label>
            <input id="file-upload" type="file" name="image" required onchange="previewImage(event)"><br><br>
        </div>
    </div>
    <?php if (!empty($article['image'])): ?>
        <img id="image-preview" src="uploads/<?php echo htmlspecialchars($article['image']); ?>">
    <?php else: ?>
        <img id="image-preview" style="display: none;">
    <?php endif; ?>

    <div>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($article['id']); ?>" />
    </div>
    
    <div>
        <label for="judul">Judul:</label><br>
        <input type="text" class="border-2 rounded-md w-full p-2" style="border-color:#332b1e" id="judul" name="judul" required value="<?php echo htmlspecialchars($article['judul']); ?>"><br>
    </div>
    
    <div>
        <label for="deskripsi">Deskripsi:</label><br>
        <textarea name="deskripsi" maxlength="150" class="border-2 rounded-md w-full p-2" style="border-color:#332b1e" required><?php echo htmlspecialchars($article['deskripsi']); ?></textarea><br>
    </div>
    
    <div>
        <label for="isi">Isi:</label><br>
        <textarea name="isi" maxlength="700" class="border-2 rounded-md w-full p-2" style="border-color:#332b1e" required><?php echo htmlspecialchars($article['isi']); ?></textarea><br>
    </div>
    
    <div>
        <label for="tglpublish">Tgl Publish:</label><br>
        <input type="date" class="border-2 rounded-md w-full p-2" id="tglpublish" style="border-color:#332b1e" style="border-color:#332b1e" name="tglpublish" required value="<?php echo htmlspecialchars($article['tanggal_publikasi']); ?>"><br>
    </div>
    
    <label for="penulis">Penulis</label>
    <select id="penulis" name="penulis" class="border-2 rounded-md w-full p-2 -mt-4" style="border-color:#332b1e" >
        <?php foreach ($penulis_list as $penulis) { ?>
            <option value="<?php echo $penulis['id']; ?>" <?php echo $penulis['id'] == $article['penulis'] ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($penulis['nama']); ?>
            </option>
        <?php } ?>
    </select>

    <input type="submit" value="Simpan" class="submit cursor-pointer border-2 font-medium text-white px-6 py-4 rounded-md bg-red-300 hover:bg-red-400 transition ease-in-out delay-150" style="border:none"  />
    <button class="back border-2 font-medium text-white text-center px-6 py-4 rounded-md bg-red-300 hover:bg-red-400 transition ease-in-out delay-150" style="border:none"> 
    <a href="view.php">Kembali</a> 
    </button>
</form>

<footer>
    <div class="footerWrapper flex justify-between items-center p-4 px-8 bg-white" >
        <h5 class="text-red-400 text-2xl font-medium">Pemograman Web</h5>
        <p class="text-red-400 font-medium">Daniel Chua 2243010 TIPB</p>
    </div>
</footer>

<script>
    function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('image-preview');
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
<?php
require "db.php";

$sql = "SELECT * FROM items";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Store Management</title>
    <style>
        /* Custom font for vintage look */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Quicksand:wght@300;400;500&display=swap');

        body {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-[#f7f2d4] to-[#f1f0eb]">

    <div class="container mx-auto px-4 py-10">
        <h3 class="text-4xl font-semibold text-center text-[#8c7b5c] py-4">Store Items</h3>
        <div class="py-4 flex justify-end">
            <a href="add.php"
                class="rounded-full bg-[#d4a6c8] text-white px-4 py-2 font-semibold hover:bg-[#c68c9d] transition-all duration-300 shadow-lg">Add
                New Item</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="bg-[#f9e1d6] rounded-lg shadow-xl overflow-hidden">
                    <div class="relative">
                        <img src="<?php echo htmlspecialchars($result['image']); ?>"
                            alt="<?php echo htmlspecialchars($result['name']); ?>"
                            class="w-full h-48 object-cover filter grayscale sepia hover:grayscale-0 hover:sepia-0 transition-all duration-300">
                    </div>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-[#8c7b5c]"><?php echo htmlspecialchars($result['name']); ?>
                        </h2>
                        <p class="text-sm text-[#8c7b5c]"><?php echo htmlspecialchars($result['description']); ?></p>
                        <p class="text-sm text-[#8c7b5c] mt-2">Stock: <?php echo htmlspecialchars($result['instock']); ?>
                        </p>
                        <p class="text-xl font-semibold text-[#8c7b5c] mt-2">Price:
                            ฿<?php echo number_format($result['price'], 2); ?></p>

                        <div class="pt-4 flex justify-end gap-2">
                            <a href="edit.php?id=<?php echo $result['id']; ?>"
                                class="rounded-full bg-[#d4a6c8] text-white px-4 py-2 text-sm font-semibold hover:bg-[#c68c9d] transition-all duration-300 shadow-lg">Edit</a>
                            <a href="delete.php?id=<?php echo $result['id']; ?>"
                                class="rounded-full bg-[#f96b6b] text-white px-4 py-2 text-sm font-semibold hover:bg-[#f96363] transition-all duration-300 shadow-lg">Delete</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

</body>

</html>
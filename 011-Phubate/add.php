<?php
require "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="script.js"></script>
    <title>Store Management</title>
</head>

<body class="bg-gradient-to-r from-[#f7f2d4] to-[#f1f0eb] font-serif">
    <div class="container mx-auto px-6 py-10">
        <h1 class="text-4xl font-semibold text-center text-[#8c7b5c] py-6">Add New Item</h1>
        <form action="add.php" method="post" id="adding-form"
            class="space-y-6 bg-[#f9e1d6] shadow-lg rounded-xl p-8 border-2 border-[#d4a6c8]">

            <!-- Item Name -->
            <div class="sm:col-span-4">
                <label for="item-name" class="block text-sm font-medium text-[#8c7b5c]">Item Name</label>
                <div class="mt-2">
                    <input type="text" name="item-name" id="item-name"
                        class="block w-full px-4 py-2 rounded-md text-[#8c7b5c] border bg-[#f1f0eb] border-[#d4a6c8] focus:outline-none focus:ring-2 focus:ring-[#d4a6c8]"
                        placeholder="Item name">
                </div>
            </div>

            <!-- Category -->
            <div class="sm:col-span-3">
                <label for="category" class="block text-sm font-medium text-[#8c7b5c]">Category</label>
                <div class="mt-2 relative">
                    <select id="category" name="category"
                        class="block w-full py-2 pl-4 pr-10 rounded-md border text-[#8c7b5c] bg-[#f1f0eb] focus:outline-none focus:ring-2 focus:ring-[#d4a6c8]">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM categories");
                        $stmt->execute();
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value={$result['id']}>" . $result['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Price -->
            <div class="sm:col-span-4">
                <label for="price" class="block text-sm font-medium text-[#8c7b5c]">Price</label>
                <div class="mt-2">
                    <input type="number" name="price" id="price"
                        class="block w-full px-4 py-2 rounded-md text-[#8c7b5c] border bg-[#f1f0eb] border-[#d4a6c8] focus:outline-none focus:ring-2 focus:ring-[#d4a6c8]"
                        placeholder="Price">
                </div>
            </div>

            <!-- Description -->
            <div class="col-span-full">
                <label for="description" class="block text-sm font-medium text-[#8c7b5c]">Description</label>
                <div class="mt-2">
                    <textarea name="description" id="description" rows="3"
                        class="block w-full px-4 py-2 rounded-md text-[#8c7b5c] border bg-[#f1f0eb] border-[#d4a6c8] focus:outline-none focus:ring-2 focus:ring-[#d4a6c8]"
                        placeholder="Describe the item..."></textarea>
                </div>
            </div>

            <!-- Image -->
            <div class="sm:col-span-4">
                <label for="item-image" class="block text-sm font-medium text-[#8c7b5c]">Item Image</label>
                <div class="mt-2">
                    <input type="text" name="item-image" id="item-image"
                        class="block w-full px-4 py-2 rounded-md text-[#8c7b5c] border bg-[#f1f0eb] border-[#d4a6c8] focus:outline-none focus:ring-2 focus:ring-[#d4a6c8]"
                        placeholder="Image URL">
                </div>
            </div>

            <!-- Instock -->
            <div class="sm:col-span-4">
                <label for="instock" class="block text-sm font-medium text-[#8c7b5c]">Instock</label>
                <div class="mt-2">
                    <input type="number" name="instock" id="instock"
                        class="block w-full px-4 py-2 rounded-md text-[#8c7b5c] border bg-[#f1f0eb] border-[#d4a6c8] focus:outline-none focus:ring-2 focus:ring-[#d4a6c8]"
                        placeholder="Stock quantity">
                </div>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <a href="index.php" class="text-sm text-[#8c7b5c] font-semibold hover:text-[#d4a6c8]">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-[#d4a6c8] text-white font-semibold rounded-md hover:bg-[#c68c9d] transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#c68c9d]">
                    Save Item
                </button>
            </div>
        </form>
    </div>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST['item-name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? 0;
    $description = $_POST['description'] ?? '';
    $itemImage = $_POST['item-image'] ?? '';
    $instock = $_POST['instock'] ?? 0;

    if (empty($itemName) || empty($category) || empty($price) || empty($description) || empty($itemImage) || empty($instock)) {
        echo "<script>window.alert('Please fill out all required fields.');</script>";
        exit;
    }

    try {
        // Prepare the SQL query to insert data
        $sql = "INSERT INTO items (name, category, price, description, image, instock) 
                VALUES (:name, :category, :price, :description, :image, :instock)";

        $stmt = $conn->prepare($sql);

        // Bind values to parameters
        $stmt->bindParam(':name', $itemName);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $itemImage);
        $stmt->bindParam(':instock', $instock);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>window.alert('Item added successfully!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>window.alert('Error adding item.');</script>";
        }
    } catch (PDOException $e) {
        // Handle any errors with the database
        echo "<script>window.alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
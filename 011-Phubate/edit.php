<?php
require "db.php";

// Check if item ID is provided in the URL
$itemId = isset($_GET['id']) ? $_GET['id'] : null;
if ($itemId) {
    // Fetch the existing data for the item to populate the form
    $stmt = $conn->prepare("SELECT * FROM items WHERE id = :id");
    $stmt->bindParam(':id', $itemId);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        echo "Item not found.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="script.js"></script>
    <title>Store Management - Edit Item</title>
</head>

<body class="bg-gradient-to-r from-[#f7f2d4] to-[#f1f0eb] font-serif">
    <div class="container mx-auto px-6 py-10">
        <h1 class="text-4xl font-semibold text-center text-[#8c7b5c] py-6">Edit Item</h1>
        <form action="edit.php?id=<?php echo $itemId; ?>" method="post" id="editing-form"
            class="space-y-6 bg-[#f9e1d6] shadow-lg rounded-xl p-8 border-2 border-[#d4a6c8]">

            <!-- Item Name -->
            <div class="sm:col-span-4">
                <label for="item-name" class="block text-sm font-medium text-[#8c7b5c]">Item Name</label>
                <div class="mt-2">
                    <input type="text" name="item-name" id="item-name"
                        class="block w-full px-4 py-2 rounded-md text-[#8c7b5c] border bg-[#f1f0eb] border-[#d4a6c8] focus:outline-none focus:ring-2 focus:ring-[#d4a6c8]"
                        placeholder="Item name" value="<?php echo htmlspecialchars($item['name']); ?>">
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
                            $selected = ($result['id'] == $item['category']) ? 'selected' : '';
                            echo "<option value={$result['id']} $selected>" . $result['name'] . "</option>";
                        }
                        ?>
                    </select>
                    <svg class="absolute top-3 right-4 w-5 h-5 text-[#8c7b5c]" viewBox="0 0 16 16" fill="currentColor"
                        aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd"
                            d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <!-- Price -->
            <div class="sm:col-span-4">
                <label for="price" class="block text-sm font-medium text-[#8c7b5c]">Price</label>
                <div class="mt-2">
                    <input type="number" name="price" id="price"
                        class="block w-full px-4 py-2 rounded-md text-[#8c7b5c] border bg-[#f1f0eb] border-[#d4a6c8] focus:outline-none focus:ring-2 focus:ring-[#d4a6c8]"
                        placeholder="Price" value="<?php echo htmlspecialchars($item['price']); ?>">
                </div>
            </div>

            <!-- Description -->
            <div class="col-span-full">
                <label for="description" class="block text-sm font-medium text-[#8c7b5c]">Description</label>
                <div class="mt-2">
                    <textarea name="description" id="description" rows="3"
                        class="block w-full px-4 py-2 rounded-md text-[#8c7b5c] border bg-[#f1f0eb] border-[#d4a6c8] focus:outline-none focus:ring-2 focus:ring-[#d4a6c8]"
                        placeholder="Describe the item..."><?php echo htmlspecialchars($item['description']); ?></textarea>
                </div>
            </div>

            <!-- Image URL -->
            <div class="sm:col-span-4">
                <label for="item-image" class="block text-sm font-medium text-[#8c7b5c]">Item Image</label>
                <div class="mt-2">
                    <input type="text" name="item-image" id="item-image"
                        class="block w-full px-4 py-2 rounded-md text-[#8c7b5c] border bg-[#f1f0eb] border-[#d4a6c8] focus:outline-none focus:ring-2 focus:ring-[#d4a6c8]"
                        placeholder="Item image URL" value="<?php echo htmlspecialchars($item['image']); ?>">
                </div>
            </div>

            <!-- Instock -->
            <div class="sm:col-span-4">
                <label for="instock" class="block text-sm font-medium text-[#8c7b5c]">Instock</label>
                <div class="mt-2">
                    <input type="number" name="instock" id="instock"
                        class="block w-full px-4 py-2 rounded-md text-[#8c7b5c] border bg-[#f1f0eb] border-[#d4a6c8] focus:outline-none focus:ring-2 focus:ring-[#d4a6c8]"
                        placeholder="Stock quantity" value="<?php echo htmlspecialchars($item['instock']); ?>">
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
    // Collect the updated values from the form
    $itemName = $_POST['item-name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? 0;
    $description = $_POST['description'] ?? '';
    $itemImage = $_POST['item-image'] ?? '';
    $instock = $_POST['instock'] ?? 0;

    // Validate the input
    if (empty($itemName) || empty($category) || empty($price) || empty($description) || empty($itemImage) || empty($instock)) {
        echo "Please fill out all required fields.";
        exit;
    }

    try {
        // Prepare the SQL query to update the item
        $sql = "UPDATE items SET name = :name, category = :category, description = :description, price = :price, image = :image, instock = :instock WHERE id = :id";

        $stmt = $conn->prepare($sql);

        // Bind the values to the parameters
        $stmt->bindParam(':name', $itemName);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $itemImage);
        $stmt->bindParam(':instock', $instock);
        $stmt->bindParam(':id', $itemId);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>window.alert('Item updated successfully!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>window.alert('Error updating item.');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>window.alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
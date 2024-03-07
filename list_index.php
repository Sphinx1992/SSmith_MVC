<?php
require('database.php');

  // Connect to the database
    $conn = mysqli_connect('localhost', 'root', 'Godzilla@1992', 'todolist');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    

    }
    

    // Retrieve the ToDo List items
    $sql = "SELECT * FROM todoitems";
    $result = mysqli_query($conn, $sql);

    
    

    // Close the database connection
    mysqli_close($conn);

if (!isset($todoitems)) {
    $todoitems = filter_input(INPUT_GET, 'todoitems',);
    if ($todoitems == NULL || $todoitems = []) {
        $todoitems = [];
    }
}


// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}
// Get name for selected category
$queryCategory = 'SELECT * FROM categories
                  WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['CategoryName'];
$statement1->closeCursor();


// Get all categories
$query = 'SELECT * FROM categories
                       ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

// Get items for selected category
$query = 'SELECT * FROM todoitems
                  WHERE categoryID = :category_id
                  ORDER BY ItemNum';
$statement3 = $db->prepare($query);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>To Do List</title>
    <link rel="stylesheet" type="text/css" href="list.css" />
</head>

<!-- the body section -->
<body>
<header><h1>To Do List Application</h1></header>
<main>
    <h1> List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['CategoryName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of items -->
        <h2><?php echo $category_name; ?></h2>
        <table>
            <tr>
                <th>Item Number</th>
                <th>Title</th>
                <th class="right">Description</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ( $todoitems as $todoitem): ?>
            <tr>
                <td><?php echo $todoitem['ItemNum']; ?></td>
                <td><?php echo $todoitem['Title']; ?></td>
                <td class="right"><?php echo $todoitem['Description']; ?></td>
                <td><form action="delete_item.php" method="post">
                    <input type="hidden" name="item_num"
                           value="<?php echo $todoitem['ItemNum']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $todoitem['categoryID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="add_item_form.php">Add Item</a></p>
        <p><a href="category_list.php">List Categories</a></p>        
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Steven Smith To Do List.</p>
</footer>
</body>
</html>
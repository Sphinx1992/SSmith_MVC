<?php
function get_items_by_category($category_id){
    global $db;
    $query = 'SELECT * FROM todoitems
            WHERE todoitems.categoryID = :category_id
            ORDER BY productID';
    $statement = $db -> prepare($query);
    $statement -> bindValue( ':category_id', $category_id);
    statement -> execute();
    $todoitems = $statement -> fetchAll();
    $statement ->closeCursor();
    return $todoitems;
}

function get_ToDoItem ($todoitems){
    global $db;
    $query = 'SELECT * FROM todoitems
            WHERE ItemNum = :itemNum';
    $statement = $db -> prepare($query);
    $statement -> bindValue( ':todoitems', $todoitems);
    statement -> execute();
    $todoitems = $statement -> fetch();
    $statement ->closeCursor();
    return $todoitems;
}

function delete_todoitems ($toditems){
    global $db;
    $query = 'DELETE * FROM todoitems
            WHERE ItemNum = :itemNum';
    $statement = $db -> prepare($query);
    $statement -> bindValue( ':todoitems', $todoitems);
    statement -> execute();
    $statement ->closeCursor();
    
}

function add_toditems ($category_id, $itemNum, $title, $description) {
    global $db;
    $query = 'INSERT INTO toditems 
            (categoryID, ItemNum, Title, Description)
            VALUES (:category_id, :itemNum, :title, :description)';
    
    $statement = $db -> prepare($query);
    $statement -> bindValue( ':category_id', $category_id);
    $statement -> bindValue (':itemNum', $itemNum);
    $statement -> bindValue ('title', $title);
    $statement -> bindValue ('description', $description);
    statement -> execute();
    $statement ->closeCursor();  
}


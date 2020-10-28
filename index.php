<?php
require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $task = trim($_POST['todo']);

    $error = "";

    if (empty($task))
    $error = "Enter a task.";
    
    if (empty($error)){
        $query = "INSERT INTO todo (task) VALUES (:task)";
        $statement = $pdo->prepare($query);

        $statement->bindValue(':task', $task, \PDO::PARAM_STR);

        $statement->execute();
        $friends = $statement->fetchAll();
        header("location:index.php");
    }else{
        ?>
            <span style="color=red"><?=$error;?></span>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $query = 'select * from todo';
    $statement = $pdo->query($query);
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
    <ul>
    <?php 
        foreach($tasks as $task) {
    ?>
        <li><?= $task[task];?></li>
    <?php 
         }
    ?>

    </ul>
    <form action="" method="post">
    <div>
        <label for="task">Task: </label>
        <input type="text" name="todo" id="todo" required>
    </div>
    <div>
        <input type="submit" value="Envoier">
    </div>
    </form>

</body>
</html>
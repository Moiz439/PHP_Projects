<?php
  include 'db.php';

  function getMembersTree($parentId=0,$level=0){
    global $pdo;
    $stmt=$pdo->prepare("Select * from members where parentId= :parentId Order by name ASC");
    $stmt->execute(['parentId'=>$parentId]);
    if($stmt->rowCount()>0)
    {
        echo '<ul>';
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<li data-id="'.$row['id'].'">'. htmlspecialchars($row['name']);
            getMembersTree($row['id'],$level+1);
            echo '</li>';

        }
        echo '</ul>';
    }
  }
?>
<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Members List</h2>
    <div id="members_tree">
        <?php getMembersTree(); ?>
    </div>
    
    <button id="addMemberBtn">Add Member</button>

    <!-- Modal Popup -->
    <div id="memberModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Add New Member</h3>
            <form id="addMemberForm">
                <label for="parent">Parent:</label>
                <select id="parent" name="parent">
                    <option value="0">No Parent</option>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM members ORDER BY name ASC");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    ?>
                </select>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>

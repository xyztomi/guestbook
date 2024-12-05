<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'guestbook');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $message = $conn->real_escape_string($_POST['message']);
    $conn->query("INSERT INTO entries (name, message) VALUES ('$name', '$message')");
}

// Retrieve all entries
$result = $conn->query("SELECT * FROM entries ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        form input, form textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form button:hover {
            background: #0056b3;
        }
        .entries {
            margin-top: 20px;
        }
        .entry {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .entry:last-child {
            border-bottom: none;
        }
        .entry h3 {
            margin: 0;
        }
        .entry p {
            margin: 5px 0;
        }
        .entry time {
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Guestbook</h1>
        <form method="POST">
            <input type="text" name="name" placeholder="Your name" required>
            <textarea name="message" placeholder="Your message" rows="4" required></textarea>
            <button type="submit">Add Entry</button>
        </form>

        <div class="entries">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="entry">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p><?php echo htmlspecialchars($row['message']); ?></p>
                    <time><?php echo $row['created_at']; ?></time>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

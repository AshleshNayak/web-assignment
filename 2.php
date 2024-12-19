<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .form-container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#registrationForm').on('submit', function () {
                alert("Form Submitted Successfully!");
            });
        });
    </script>
</head>
<body>
    <?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "registration");

    // Check connection
    if ($conn->connect_error) {
        die("<div class='form-container'><h1>Database Connection Failed: " . $conn->connect_error . "</h1></div>");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $dob = htmlspecialchars($_POST['dob']);
        $gender = htmlspecialchars($_POST['gender']);

        // Insert data into formdata table

        $sql = "INSERT INTO formtable (name, email, phone, dob, gender) 
        VALUES ('$name', '$email', '$phone', '$dob', '$gender')";

        // $stmt = $conn->prepare("INSERT INTO formtable (name, email, phone, dob, gender) VALUES (?, ?, ?, ?, ?)");
        // $stmt->bind_param("sssss", $name, $email, $phone, $dob, $gender);

        if ($conn->query($sql) === TRUE) {
            echo "
            <div class='form-container'>
                <h1>Form Submission Successful</h1>
                <h2>Submitted Information:</h2>
                <p><strong>Full Name:</strong> $name</p>
                <p><strong>Email Address:</strong> $email</p>
                <p><strong>Phone Number:</strong> $phone</p>
                <p><strong>Date of Birth:</strong> $dob</p>
                <p><strong>Gender:</strong> $gender</p>
            </div>";
        } else {
            echo "<div class='form-container'><h1>Failed to Submit Data</h1></div>";
        }


        $conn->close();
    } else {
    ?>
    <div class="form-container">
        <h1>Online Registration Form</h1>
        <form id="registrationForm" action="" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}">

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <button type="submit" id="submitBtn">Submit</button>
        </form>
    </div>
    <?php
    }
    ?>
</body>
</html>

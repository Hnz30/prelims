<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment and Grade Processing System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Remove outer borders and margins */
        .no-border {
            border: none;
            padding: 0;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Student Enrollment and Grade Processing System</h2>
    
    <!-- Student Enrollment Form -->
    <form method="post" class="p-4 mt-4 no-border">
        <h3>Student Enrollment Form</h3>
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" required>
        </div><br>

        <div class="form-group">
            <label>Gender</label><br>
            <div class="form-check form-check-inline">
                <input type="radio" name="gender" id="male" value="Male" class="form-check-input" checked>
                <label for="male" class="form-check-label">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="gender" id="female" value="Female" class="form-check-input">
                <label for="female" class="form-check-label">Female</label>
            </div>
        </div><br>

        <div class="form-group">
            <label for="course">Course</label>
            <select name="course" id="course" class="form-control" required>
                <option value="BSIT" disabled selected>BSIT</option>
                <option value="BSBA">BSBA</option>
                <option value="BSHRM">BSHRM</option>
            </select>
        </div><br>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <!-- Separate Grade Section -->
        <fieldset class="p-3 mt-4 no-border">
            <legend class="w-auto px-3">Enter Grades</legend>

            <div class="form-group">
                <label for="prelim">Prelim</label>
                <input type="number" name="prelim" id="prelim" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="midterm">Midterm</label>
                <input type="number" name="midterm" id="midterm" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="final">Final</label>
                <input type="number" name="final" id="final" class="form-control" required>
            </div>
        </fieldset>

        <button type="submit" class="btn btn-primary btn-block mt-4">Submit Student Information</button>
    </form>

    <!-- Display Student Details and Grades -->
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <?php
            // Capture form data
            $firstName = htmlspecialchars($_POST['firstName']);
            $lastName = htmlspecialchars($_POST['lastName']);
            $age = htmlspecialchars($_POST['age']);
            $gender = htmlspecialchars($_POST['gender']);
            $email = htmlspecialchars($_POST['email']);
            $prelim = floatval($_POST['prelim']);
            $midterm = floatval($_POST['midterm']);
            $final = floatval($_POST['final']);

            // Calculate average grade
            $average = ($prelim + $midterm + $final) / 3;
            $status = $average >= 75 ? "Passed" : "Failed";

            // Set Bootstrap class based on status
            $statusClass = $status == "Passed" ? "text-success" : "text-danger";
        ?>

        <div class="card mt-4 no-border">
            <div class="card-body">
                <h4 class="card-title">Student Details</h4>
                <p><strong>First Name:</strong> <?php echo $firstName; ?></p>
                <p><strong>Last Name:</strong> <?php echo $lastName; ?></p>
                <p><strong>Age:</strong> <?php echo $age; ?></p>
                <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>

                <h4>Grades</h4>
                <p><strong>Prelim:</strong> <?php echo $prelim; ?></p>
                <p><strong>Midterm:</strong> <?php echo $midterm; ?></p>
                <p><strong>Final:</strong> <?php echo $final; ?></p>
                <p><strong>Average Grade:</strong> <?php echo number_format($average, 2); ?></p>
                <p><strong>Status:</strong> <span class="<?php echo $statusClass; ?>"><?php echo $status; ?></span></p>
            </div>
        </div>
    <?php endif; ?>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

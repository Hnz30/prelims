<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment and Grade Processing System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
        }
        form, .student-details {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .student-details h2, form h2 {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="email"], input[type="number"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        .submit-btn {
            padding: 10px 20px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<body>

<h1>Student Enrollment and Grade Processing System</h1>

<?php
// Initialize variables
$studentInfoSubmitted = false;
$gradesSubmitted = false;
$firstName = $lastName = $age = $gender = $course = $email = "";
$prelim = $midterm = $final = $averageGrade = 0;
$gradeStatus = "";

// Check if the student info form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitStudentInfo'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    $studentInfoSubmitted = true;
}

// Check if the grades form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitGrades'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    
    $prelim = $_POST['prelim'];
    $midterm = $_POST['midterm'];
    $final = $_POST['final'];
    $averageGrade = ($prelim + $midterm + $final) / 3;
    $gradeStatus = $averageGrade >= 75 ? "Passed" : "Failed";
    $gradesSubmitted = true;
}
?>

<!-- Student Enrollment Form -->
<?php if (!$studentInfoSubmitted): ?>
    <form method="post">
        <h2>Student Enrollment Form</h2>
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName" required>

        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName" required>

        <label for="age">Age</label>
        <input type="number" id="age" name="age" required>

        <label>Gender</label>
        <input type="radio" id="male" name="gender" value="Male" checked>
        <label for="male">Male</label>
        <label for="female">Female</label>
        <input type="radio" id="female" name="gender" value="Female">

        <label for="course">Course</label>
        <select id="course" name="course" required>
            <option value="BSIT">BSIT</option>
            <option value="BSCS">BSCS</option>
        </select>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <button type="submit" name="submitStudentInfo" class="submit-btn">Submit Student Information</button>
    </form>
<?php endif; ?>

<!-- Grades Form -->
<?php if ($studentInfoSubmitted && !$gradesSubmitted): ?>
    <form method="post">
        <h2>Enter Grades for <?php echo htmlspecialchars($firstName . " " . $lastName); ?></h2>
        
        <!-- Hidden fields to pass student info -->
        <input type="hidden" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
        <input type="hidden" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        <input type="hidden" name="age" value="<?php echo htmlspecialchars($age); ?>">
        <input type="hidden" name="gender" value="<?php echo htmlspecialchars($gender); ?>">
        <input type="hidden" name="course" value="<?php echo htmlspecialchars($course); ?>">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        
        <label for="prelim">Prelim</label>
        <input type="number" id="prelim" name="prelim" required>

        <label for="midterm">Midterm</label>
        <input type="number" id="midterm" name="midterm" required>

        <label for="final">Final</label>
        <input type="number" id="final" name="final" required>

        <button type="submit" name="submitGrades" class="submit-btn" style="background-color: #28a745;">Submit Grades</button>
    </form>
<?php endif; ?>

<!-- Display Student Details and Grades -->
<?php if ($gradesSubmitted): ?>
    <div class="student-details">
        <h2>Student Details</h2>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstName); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastName); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($age); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
        <p><strong>Course:</strong> <?php echo htmlspecialchars($course); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>

        <h2>Grades</h2>
        <p><strong>Prelim:</strong> <?php echo htmlspecialchars($prelim); ?></p>
        <p><strong>Midterm:</strong> <?php echo htmlspecialchars($midterm); ?></p>
        <p><strong>Final:</strong> <?php echo htmlspecialchars($final); ?></p>
        <p><strong>Average Grade:</strong> 
            <?php echo number_format($averageGrade, 2); ?> - 
            <span class="<?php echo $gradeStatus == 'Passed' ? 'text-success' : 'text-danger'; ?>">
                <?php echo $gradeStatus; ?>
            </span>
        </p>
    </div>
<?php endif; ?>
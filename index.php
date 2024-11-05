<?php
session_start();

setcookie('user', 'visitor', time() + (86400 * 30), "/");

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

$dataFile = 'group7_data.txt';
if (file_exists($dataFile)) {
    $teamArray = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    $teamData = 
        "Rechelle|image1.png|Group Member|candidorechelleanne@gmail.com|I'm Rechelle Anne Candido, a third-year BSIT student. A working student, nail tech, makeup artist and I own a small business. I work hard because I want to pursue my course and become successful in the future.\n" .
        "Johnn Vhelle|Image2.jpg|Group Member|johnnvhellebasbas@gmail.com|Hi there! I'm Vhelle, and I'm a third-year college student at PLMun. I currently take the BSIT program. Watching movies and reading stories are two of my interests, and I'd like to master digital art someday.\n" .
        "Ian Christoper|Image5.jpeg|Group Leader|icasenci12@gmail.com|I'm Ian, a third-year BSIT student at PLMun! Just a guy trying to do better every passing day and hoping that life takes me to a simple yet better place.\n" .
        "Justin|Image4.jpg|Group Member|Justinpadora@gmail.com|I'm Justin Padora, a third-year BSIT student who also works as a crew leader at a fast food restaurant. I'm motivated to work hard in order to achieve my goal of graduating.\n";
    file_put_contents($dataFile, $teamData);
    $teamArray = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 7 Team Portfolio</title>
    <link rel="stylesheet" href="style.css">
    <button class="manage" onclick="window.location.href='submit.php'">Manage Team</button>
</head>
<body>
    <div class="group-name">BSIT 3L - Group 7</div>
    <p class="group-description">"Integrative Programming"</p>
    <div class="team-members">
        <?php foreach ($teamArray as $index => $memberData): 
            $member = explode('|', sanitizeInput($memberData)); ?>
        <div class="team-member">
            <img id="imagePreview<?php echo $index + 1; ?>" src="<?php echo $member[1]; ?>" alt="Team Member <?php echo $index + 1; ?>">
            <h2><?php echo htmlspecialchars($member[0]); ?></h2>
            <div class="role-label">Role</div>
            <p class="role"><?php echo htmlspecialchars($member[2]); ?></p>
            <div class="contact-label">Contact</div>
            <p class="contact"><?php echo htmlspecialchars($member[3]); ?></p>
            <div class="bio-label">Bio</div>
            <p class="bio"><?php echo htmlspecialchars($member[4]); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Inquiry Form -->
    <div class="inquiry-form">
        <h2>Contact Us</h2>
        <form id="inquiryForm" action="form.php" method="post">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('inquiryForm').addEventListener('submit', function(event) {
            event.preventDefault(); 
            // Prevent the default form submission
            // Fetch the form data and send it via AJAX (optional)
            // Clear the form inputs
            this.reset();
        });
    </script>
</body>
</html>
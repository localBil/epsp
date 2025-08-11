<?php
include('database/connection.php');

// Create the new table
$sql = "CREATE TABLE IF NOT EXISTS doctor_availability (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT NOT NULL,
    day_id INT NOT NULL,
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctors_id),
    FOREIGN KEY (day_id) REFERENCES dates(dates_id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table doctor_availability created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Migrate the data
$sql = "SELECT doctors_id, day_id FROM doctors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $doctor_id = $row['doctors_id'];
        $day_ids = explode(',', $row['day_id']);
        foreach ($day_ids as $day_id) {
            $day_id = trim($day_id);
            if (!empty($day_id)) {
                $insert_sql = "INSERT INTO doctor_availability (doctor_id, day_id) VALUES ($doctor_id, $day_id)";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "Migrated doctor $doctor_id, day $day_id<br>";
                } else {
                    echo "Error migrating doctor $doctor_id, day $day_id: " . $conn->error . "<br>";
                }
            }
        }
    }
} else {
    echo "No doctors found to migrate.<br>";
}

// After running this script, you can remove the day_id column from the doctors table.
// ALTER TABLE doctors DROP COLUMN day_id;

echo "Migration complete.<br>";

$conn->close();
?>

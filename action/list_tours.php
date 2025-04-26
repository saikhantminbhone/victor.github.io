<?php
include('../config/database.php');

$sql = "SELECT * FROM tours";
$result = $conn->query($sql);
print_r($result);
die;
$tours = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tours[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'image' => $row['image'],
            'description' => $row['description'],
            'price' => $row['price'],
            'duration' => $row['duration'],
            'besttime' => $row['besttime'],
            'locations' => $row['locations'],
            'rating' => $row['rating'],
            'review_total' => $row['review_total']
        ];
    }
} else {
    echo "0 results";
}
echo json_encode($tours);

$conn->close();
?>

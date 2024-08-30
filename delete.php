<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['deletememberid']) || isset($_GET['deletetrainerid']) || isset($_GET['deletenutritionistid']) || isset($_GET['deletenutritionistapplicantsid']) || isset($_GET['deletepersonaltrainerapplicants']) || isset($_GET['deleteyogaapplicants']) || isset($_GET['deleteaerobicsapplicantsid']) || isset($_GET['deletetaekwondoapplicants'])) {
    $id = $_GET['deletememberid'] ?? $_GET['deletetrainerid'] ?? $_GET['deletenutritionistid'] ?? $_GET['deletenutritionistapplicantsid'] ?? $_GET['deletepersonaltrainerapplicants'] ?? $_GET['deleteyogaapplicants'] ?? $_GET['deleteaerobicsapplicantsid'] ?? $_GET['deletetaekwondoapplicants'];
    $type = isset($_GET['deletememberid']) ? 'deletememberid' : (isset($_GET['deletetrainerid']) ? 'deletetrainerid' : (isset($_GET['deletenutritionistid']) ? 'deletenutritionistid' : (isset($_GET['deletenutritionistapplicantsid']) ? 'deletenutritionistapplicantsid' : (isset($_GET['deletepersonaltrainerapplicants']) ? 'deletepersonaltrainerapplicants' : (isset($_GET['deleteyogaapplicants']) ? 'deleteyogaapplicants' : (isset($_GET['deleteaerobicsapplicantsid']) ? 'deleteaerobicsapplicantsid' : 'deletetaekwondoapplicants'))))));

    echo "
        <script>
            if (confirm('Are you sure you want to delete this record?')) {
                window.location.href = 'delete.php?confirm=1&type=$type&id=$id';
            } else {
                window.location.href = 'adminpanel.php';
            }
        </script>";
  }
}

if (isset($_GET['confirm']) && $_GET['confirm'] == 1) {
  $id = $_GET['id'];
  $type = $_GET['type'];

  switch ($type) {
    case 'deletememberid':
      // Delete from members_tbl
      $sql_member = "DELETE FROM members_tbl WHERE id=?";
      $stmt = $conn->prepare($sql_member);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      // Delete from activities
      $sql_activities = "DELETE FROM activities WHERE user_id=?";
      $stmt = $conn->prepare($sql_activities);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      // Delete from yogaapplicants
      $sql_yoga = "DELETE FROM yogaapplicants WHERE MemberId=?";
      $stmt = $conn->prepare($sql_yoga);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      // Delete from taekwondoapplicants
      $sql_taekwondo = "DELETE FROM taekwondoapplicants WHERE MemberId=?";
      $stmt = $conn->prepare($sql_taekwondo);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      // Delete from personaltrainerapplicants
      $sql_personal_trainer = "DELETE FROM personaltrainerapplicants WHERE MemberId=?";
      $stmt = $conn->prepare($sql_personal_trainer);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      // Delete from aerobicsapplicants
      $sql_aerobics = "DELETE FROM aerobicsapplicants WHERE MemberId=?";
      $stmt = $conn->prepare($sql_aerobics);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      // Delete from nutritionistapplicants
      $sql_nutritionist = "DELETE FROM nutritionistapplicants WHERE MemberId=?";
      $stmt = $conn->prepare($sql_nutritionist);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      break;
    case 'deletetrainerid':
      $sql = "DELETE FROM trainers_tbl WHERE id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      // Delete from yogaapplicants
      $sql_yoga1 = "DELETE FROM yogaapplicants WHERE `Instructor Id`=?";
      $stmt = $conn->prepare($sql_yoga1);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      // Delete from taekwondoapplicants
      $sql_taekwondo1 = "DELETE FROM taekwondoapplicants WHERE `Instructor Id`=?";
      $stmt = $conn->prepare($sql_taekwondo1);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      // Delete from personaltrainerapplicants
      $sql_personal_trainer1 = "DELETE FROM personaltrainerapplicants WHERE `Instructor Id`=?";
      $stmt = $conn->prepare($sql_personal_trainer1);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      // Delete from aerobicsapplicants
      $sql_aerobics1 = "DELETE FROM aerobicsapplicants WHERE `Instructor Id`=?";
      $stmt = $conn->prepare($sql_aerobics1);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      break;
    case 'deletenutritionistid':
      $sql = "DELETE FROM nutritionists_tbl WHERE id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      // Delete from nutritionistapplicants
      $sql_nutritionist = "DELETE FROM nutritionistapplicants WHERE `Nutritionist Id`=?";
      $stmt = $conn->prepare($sql_nutritionist);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      break;
    case 'deletenutritionistapplicantsid':
      $sql = "DELETE FROM nutritionistapplicants WHERE Transaction_id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      break;
    case 'deletepersonaltrainerapplicants':
      $sql = "DELETE FROM personaltrainerapplicants WHERE Transaction_id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      break;
    case 'deleteyogaapplicants':
      $sql = "DELETE FROM yogaapplicants WHERE Transaction_id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      break;
    case 'deleteaerobicsapplicantsid':
      $sql = "DELETE FROM aerobicsapplicants WHERE Transaction_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      break;
    case 'deletetaekwondoapplicants':
      $sql = "DELETE FROM taekwondoapplicants WHERE Transaction_id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      break;
  }

  echo "<script>alert('Record Deleted Successfully');</script>";
  echo "<script>window.location='adminpanel.php';</script>";
}

$conn->close();

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>Health</th>
            <th>Behavior</th>
            <th>Nutrition</th>
            <th>Care</th>
            <th>Breeds</th>
        </tr>
        <?php
        include_once 'config.php';
        
        $sql = "SELECT Health, Behavior, Nutrition, Care, Breeds from faqs";
        $result = $mysqli-> query($sql);

        if($result-> num_rows > 0) {
            while($row = $result-> fetch_assoc()) {

                echo "<tr><td>" . $row["Health"] . "</td><td>" . $row["Behavior"] . "</td><td>" . $row["Nutrition"] ."</td><td>" . $row["Care"] . "</td><td>" . $row["Breeds"] . "</td></tr>";

            }
            echo "</table>";
        }
        else{
            echo "No result.";
        }

        $mysqli-> close();

        ?>
    </table>
</body>
</html>
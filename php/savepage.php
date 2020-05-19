<?php
    include('config.php');
    //Retrieve the field values from our registration form.
    $id = $_POST['id'];
    $content = $_POST['content'];


//Now, we need to check if the supplied username already exists.

    //Construct the SQL statement and prepare it.
$paragraphs = preg_split('/\n+/', $content);
$finalstring = "";
foreach($paragraphs as $p)
{
    if(strlen($p) > 0)
    {
        $finalstring .= "<p>$p</p>";
    }
}
    $sql = "UPDATE pages SET pagecontent = ? WHERE id = ?" ;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$finalstring, $id]);
    $result = $stmt->execute();
    
    if($result){
        echo 'Page successfully updated. ';
    }

?>

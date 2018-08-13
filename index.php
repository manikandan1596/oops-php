<?php
	require 'class/Database.php';
	$database = new Database();
	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	if($_POST['delete']){
		$delete_id = $_POST['delete_id'];
		$database -> query('DELETE FROM task WHERE id = :id');
		$database -> bind(':id', $delete_id);
		$database -> execute();
	}
	elseif($post['submit']){
		$topic = $post['topic'];
		$detail = $post['detail'];
		$date = $post['date'];
	
	$database -> query('INSERT INTO task(topic,detail,date) VALUES(:topic,:detail,:date)');
	$database -> bind(':topic', $topic);
	$database -> bind(':detail', $detail);
	$database -> bind(':date', $date);
	$database -> execute();
		if($database -> lastInsertId()){
			echo 'TASK ADDED';
		}
	}
	elseif($post['update']){
		$id = $post['id'];
		$topic = $post['topic'];
		$detail = $post['detail'];
		$date = $post['date'];
	
	$database -> query('UPDATE task SET topic = :topic, detail = :detail, date = :date WHERE id = :id');
	$database -> bind(':topic', $topic);
	$database -> bind(':detail', $detail);
	$database -> bind(':date', $date);
	$database -> bind(':id', $id);
	$database -> execute();
	}
	$database -> query('SELECT * FROM task');
	$rows = $database -> resultset();
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
	
<h2><center>TODO LIST </center></h2>
<div>

<?php foreach($rows as $row) : ?>
	<table>
	
	
	<tr>
	<td><h3><?php echo $row['id']; ?></h3></td>
	<td><h3><?php echo $row['topic']; ?></h3></td>
	<td><h3><?php echo $row['detail']; ?></h3></td>
	<td><h3><?php echo $row['date']; ?></h3><br></td>
	<td><form action = "<?php $_SERVER['PHP_SELF']; ?>" method = "post" >
		<input type = "hidden" name = "delete_id" value = "<?php echo $row['id']; ?>">
		<input type = "submit" name = "delete" value = "delete"></td>
	</form>
	</tr>
	</table>
	 
<?php endforeach ; ?>
</div>
<div>
<h2><center><u>TASK ADDING HERE!</u></center></h2>
	<table>
	<tr>
	<td><form action = "<?php $_SERVER['PHP_SELF']; ?>" method = "post" >
		TOPIC:<input type = "text" name = "topic"><br>
		DETAIL:<input type = "text" name = "detail"><br>
		DATE:<input type = "date" name = "date"><br>
		<input type = "submit" name = "submit" value = "submit"><br>
	</form>
	</td>
	<td>
	<form action = "<?php $_SERVER['PHP_SELF']; ?>" method = "post" >
		ID:<input type= "text" name = "id"><br>
		TITLE:<input type = "text" name = "topic"><br>
		DETAILS:<input type = "text" name = "detail"><br>
		DUE DATE:<input type = "date" name = "date"><br>
		<input type = "submit" name = "update" value = "update"><br>
	</form>
	</td>
	</tr>
	</table>
</div>
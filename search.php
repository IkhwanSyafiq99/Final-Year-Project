<?php
define("ROW_PER_PAGE",2);
include_once('db.php');
?>
<html>
<head>
<style>
body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
.tbl-qa{width: 100%;font-size:0.9em;background-color: #f5f5f5;}
.tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
.tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;vertical-align:top;}
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
#keyword{border: #CCC 1px solid; border-radius: 4px; padding: 7px;background:url("demo-search-icon.png") no-repeat center right 7px;}
.btn-page{margin-right:10px;padding:5px 10px; border: #CCC 1px solid; background:#FFF; border-radius:4px;cursor:pointer;}
.btn-page:hover{background:#F0F0F0;}
.btn-page.current{background:#F0F0F0;}
</style>
</head>
<body>
<?php	
	$search_keyword = (!empty($_POST['search_keyword'])) ? $_POST['search_keyword'] : "";
$query = 'SELECT * FROM search_page WHERE description LIKE :keyword ORDER BY id DESC ';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);$pdo_statement = $conn ->prepare($query);
$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
$pdo_statement->execute();

?>
<form name='frmSearch' action='' method='post'>
<div style='text-align:right;margin:20px 0px;'><input type='text' name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'></div>
<table class='tbl-qa'>
  <thead>
	<tr>
	  <th class='table-header' width='20%'>Title</th>
	  <th class='table-header' width='40%'>Description</th>
	  <th class='table-header' width='20%'>Date</th>
	</tr>
  </thead>
  <tbody id='table-body'>
	<?php
	if(!empty($result)) { 
		foreach($result as $row) {
	?>
	  <tr class='table-row'>
		<td><?php echo $row['post_title']; ?></td>
		<td><?php echo $row['description']; ?></td>
		<td><?php echo $row['post_at']; ?></td>
	  </tr>
    <?php
		}
	}
	?>
  </tbody>
</table>
<?php echo $per_page_html; ?>
</form>
</body>
</html>
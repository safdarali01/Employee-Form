<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<div class="container">
  <h2>All Employees</h2>           
  <table class="wp-list-table widefat fixed striped table-view-list posts">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Image</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        
        <th>Actions<th>
      </tr>
    </thead>
    <tbody>
      
    <?php
    $i=1;
    foreach($result as $row){ 
      $id =$row->id;
    ?>
    <tr>
        <td><?php echo $i++?></td>
        <td id="get-<?php echo $id?>-4"><img src="<?php echo $row->img?>" style="width:40px;height:40px;border-radius:25px;;"></td>
        <td id="get-<?php echo $id?>-1"><?php echo $row->fname?></td>
        <td id="get-<?php echo $id?>-2"><?php echo $row->lname?></td>
        <td id="get-<?php echo $id?>-3"><?php echo $row->email?></td>
      
        <form method="GET">
          <td>
          <a href="<?php echo admin_url() .'options-general.php?page=employee-form&dlt=' . $id?>" style="text-decoration: none;color: #B32D2E;"> Delete </a>
        </form>
        <b>|</b>
        <a id ="<?php echo $id?>" class="abc" style="text-decoration: none;cursor:pointer"> Update</button>
        <b>|</b>
        <a id ="<?php echo $id?>" class="pdf" style="text-decoration: none;cursor:pointer"> PDF</a>  
          </td>
    </tr>
    <?php } ?>
    
    </tbody>
  </table>
</div>

</body>
</html>

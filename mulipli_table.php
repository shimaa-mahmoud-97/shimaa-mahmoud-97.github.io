<?php  
    include_once('./controllers/common.php');
    include_once('./components/head.php');
    include_once('./models/course.php');
    include_once('./models/grade.php');
    
 $connect = mysqli_connect("localhost", "root", "", "school");  
 $keyword="";
 $null=0;
  $keyword=isset($_REQUEST['Search'])?$_REQUEST['Search']:$null;
  if ($keyword){
  $sql = "SELECT grades.degree ,grades.id,courses.Name,students.name FROM `grades` INNER JOIN 
 courses ON grades.course_id = courses.id INNER JOIN students ON grades.student_id = students.id
 WHERE (students.name LIKE ('%$keyword%') OR courses.name LIKE ('%$keyword%') )";
  }
// echo var_dump($result);
   else {       
$sql = "SELECT grades.degree ,grades.id,courses.Name,students.name FROM `grades` INNER JOIN 
courses ON grades.course_id = courses.id INNER JOIN students ON grades.student_id = students.id";
   }
   $result = mysqli_query($connect, $sql);  
   
 ?>  
 <div style="padding: 10px 0px 20px 0px; vertical-align: text-bottom;">
		<span style="font-size: 125%;">GRADESMORE</span>
 <!DOCTYPE html>  
 <html>  
     
      <body>  
           <br />    
           <form action="mulipli_table.php" method="post">
            <input type="text" name="Search" placeholder=" Search"><br><br>
            <input type="submit" name="search" value="search"><br><br>
            
                     <table class="table table-striped">  
                     <thead>
                          <tr> 
                          <th scope="col">id</th>
                               <th scope="col">degree</th>  
                               <th scope="col">course name</th>
                               <th scope="col">student Name</th> 
                               <th scope="col"></th>
                                  
                          </tr> 
                        </thead>
	  	                <tbody>      
                          <?php  
                          if(mysqli_num_rows($result) > 0)  
                          {  
                               while($row = mysqli_fetch_array($result))  
                               {  
                          ?>  
                          <tr>  

                               <td><?php echo $row["id"];?></td>                                 
                               <td><?php echo $row["degree"];?></td>  
                               <td><?php echo $row["Name"]; ?></td>
                               <td><?php echo $row["name"]; ?></td>
				</td>  
                          </tr>  
                          <?php  
                               }  
                          }  
                          ?>  
                    </tbody>
                     </table>  
         
           <br />  
      </body>  
 </html>  
 
Share This:   Facebook Twitter Google
<?php
    require("developper/layout.php");
    echo $head;
    echo "<title>Use modify</title>";
    head();
    if (isset($_SESSION['admin'])){
            $dsn=database::connect();
            $recipno=database::norecipe($dsn);
            $userno=  database::nouser($dsn);
            echo "<section class=menu-padding>";
            echo "<div class='container jumbotron'>";
            echo "There are $recipno recipes is our site!<br>There are $userno users in our site!<br>";
            echo "<a href='recipesmodify.php'>Check out recipess</a><br>";
            $str="SELECT * FROM `users`";
            $row=$dsn->query($str)->fetchALL();
            $n=sizeof($row);
            $limit=3;
            $totalpage=floor(($n-1)/$limit)+1;
            $page=$_GET['page'];
            if($page){
                $start=($page-1)*$limit;
            }
           else{
                $start=0;$page=1;
            }
            if($n==0){
                echo"No users!";
            }
            if($start+$limit<=$n){$fin=$start+$limit;}else{$fin=$n;};
            echo "<form action='' method='POST'>";
            for($i=$start;$i<$fin;$i++ ){
                echo "<div class='recipe'>";
                if ($row[$i]['is_admin']==0){
                    $id=$row[$i]['id'];
                    echo "<div class='modif'>Delete user<input class='btn btn-default' type='submit' name='delete' value='$id'></div>";
                    echo "<div class='user'>User name: ";
                    echo $row[$i]['username'];
                    echo "</div><div class='user'>E-mail: ";
                    $email=$row[$i]['email'];
                    echo $email;
                    echo "</div><input type='text' name='text' placeholder='send a message'>Send to<input class='btn btn-default' type='submit' name='submit' value=$email>";  
                }else{
                    echo "Administer: ";
                    echo $row[$i]['username'];
                }
                echo "</div>";
            };
            if($page>1){$prev=$page-1;};
            if($page<$totalpage){$next=$page+1;};
            $pagination="";
            if($totalpage>1){
                 $pagination.="<div class='text-center'><ul class='pagination'>";
                if($page>1){
                    $pagination.="<li><a href='usermodify.php?page=0'><<</a></li>";
                }
                if($page>2){
                    $pagination.="<li><a href='usermodify.php?page=$prev'><</a></li>";
                }
                $pagination.="<li class='active'><a href='usermodify.php?page=$page'>$page</a></li>";
                if($page+1<$totalpage){
                $pagination.="<li><a href='usermodify.php?page=$next'>></a></li>";}
                if($page<$totalpage){
                    $pagination.="<li><a href='usermodify.php?page=$totalpage'>>></a><li>";
                }
                $pagination.="</ul></div>";
            }
            echo $pagination;
            echo "</form>";
            $dsn=null;
            echo"</div></section>";
    }else{
        echo "<section class='menu-padding'>Only for administers!</section>";}
    echo $footer;
?>
<?php
    if (isset($_POST['delete'])){
        $val=$_POST['delete'];
        $dsn=  database::connect();
        $str="DELETE FROM `users` WHERE `id`=$val";
        if($dsn->query($str)){
            echo"<script>alert('Delete succeed!')</script>";
        }
        else{
            echo"<script>alert('Something Wrong!')</script>";
        }
    }
    if(isset($_POST['submit'])){
        $message=$_POST['text'];
        $email=$_POST['submit'];
        mail($email,'Little Cooker',$message);
    }
?>

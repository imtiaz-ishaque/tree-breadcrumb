<?php
/* 
name: Tree Categories
Author: Imtiaz Ahmed
*/
$con = mysqli_connect("localhost","root","","codetest");

function getCategoryTreeFromParent($parent_id = 0, $sub_mark = '')
{
    global $con;
    $sql = "select * from categories where parent_id = $parent_id order by cat_name";
    $resultset = mysqli_query($con,$sql);
    $category_count = mysqli_num_rows($resultset);
    if($category_count > 0)
    {
        while($categories = mysqli_fetch_array($resultset))
        {
            echo $sub_mark.$categories['cat_name']."<br>";
            getCategoryTreeFromParent($categories['category_id'], $sub_mark. " &#8702; ");
        }
    }
}
getCategoryTreeFromParent();
?>

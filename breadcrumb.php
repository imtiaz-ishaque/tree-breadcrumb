<?php
/* 
name: Breadcrumb
Author: Imtiaz Ahmed
*/
$con = mysqli_connect("localhost", "root", "", "codetest");

function breadcrumb($array, $id)
{
    static $result = [];
    if (isset($array[$id])) {
        $result[] = '<a href="/category.php?id=' . $array[$id]['category_id'] . '">' . $array[$id]['cat_name'] . '</a>';
        $parent = $array[$id]['parent_id'];
        unset($array[$id]);
        breadcrumb($array, $parent);
    }
    return array_reverse($result);
}

$sql = "select * from categories";
$rs = mysqli_query($con, $sql);
$data_array = [];
while ($category = mysqli_fetch_assoc($rs)) {
    $data_array[] = $category;
}
echo implode(" &#8702; ", breadcrumb(array_column($data_array, NULL, 'category_id'), 4)); //inline link

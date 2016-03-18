<?php
include 'connect.php';
$searchname = $_POST['filter'];
$query = "SELECT item_name, item_category_short FROM tbl_item WHERE item_name LIKE '$searchname%'";
$link = mysqli_connect('localhost','zby','root','Database_Project');
$result = mysqli_query($link, $query);
$num = mysqli_num_rows($result);
$string = "<datalist id='searchlist'>";
while($row = mysqli_fetch_array($result)){
    $cate_short = $row['item_category_short'];
    $query_cate = "SELECT category_name FROM tbl_category WHERE category_short = '$cate_short'";
    $result_cate = mysqli_query($link, $query_cate);
    while($row_cate = mysqli_fetch_array($result_cate)){
        $category = $row_cate['category_name'];
    }
    $string.="<option value='".$row['item_name']."' label='".$category."'>";
}
$string.="</datalist>";
if($searchname == '' || $num == 0){
    $string = '';
}
echo $string;
?>

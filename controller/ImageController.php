<?php
if(!isset($_FILES)) exit('error');
$file = $_FILES['uploaded'];
$tmp_name = $file['tmp_name'];
$filename = $file['name'];
echo htmlspecialchars($filename, ENT_QUOTES, 'UTF-8');
$ext = strrchr($filename,'.');
$new_name = date('Ymdhis').$ext;
//rename('uploadTest/CBMS 広報.docx','uploadTest/neko.docx');
$check = move_uploaded_file($tmp_name,'../knee_picture/'.$new_name);
if($check){
    echo 'success';
}
else{
    echo 'fail';
}
?>
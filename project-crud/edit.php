<?php 

include 'model.php';
$model = new Model();
$id = $_REQUEST['id'];
$row = $model->edit($id);
if (isset($_POST['update'])) {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['address'])) {
      if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['mobile']) && !empty($_POST['address']) ) {
        
        $data['id'] = $id;
        $data['name'] = $_POST['name'];
        $data['mobile'] = $_POST['mobile'];
        $data['email'] = $_POST['email'];
        $data['address'] = $_POST['address'];

        $update = $model->update($data);

        if($update){
          echo "<script>alert('record update successfully');</script>";
          echo "<script>window.location.href = 'records.php';</script>";
        }else{
          echo "<script>alert('record update failed');</script>";
          echo "<script>window.location.href = 'records.php';</script>";
        }

      }else{
        echo "<script>alert('empty');</script>";
        header("Location: edit.php?id=$id");
      }
    }
  }


?>
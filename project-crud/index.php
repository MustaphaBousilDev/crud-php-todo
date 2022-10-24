<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8" />
	<title>YouCode | Scrum Board</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN core-css ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/css/vendor.min.css" rel="stylesheet" />
	<link href="assets/css/default/app.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<link href="assets/css/styles.css" rel="stylesheet" />
	<style>
		:root {
    --modal-duration: 1s;
    --modal-color: #428bca;
  }
  
		.button {
    background: #428bca;
    padding: 1em 2em;
    color: #fff;
    border: 0;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .button:hover {
    background: #3876ac;
  }

  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
  }
  .modal.active{
    display: block;
  }

  
  .modal-content {
    margin: 10% auto;
    width: 60%;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
    animation-name: modalopen;
    animation-duration: var(--modal-duration);
  }
  
  .modal-header h2,
  .modal-footer h3 {
    margin: 0;
  }
  
  .modal-header {
    background: var(--modal-color);
    padding: 15px;
    color: #fff;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }
  
  .modal-body {
    padding: 10px 20px;
    background: #fff;
  }
  
  .modal-footer {
    background: var(--modal-color);
    padding: 10px;
    color: #fff;
    text-align: center;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
  }
  
  .close {
    color: #ccc;
    float: right;
    font-size: 30px;
    color: #fff;
  }
  
  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
  
  @keyframes modalopen {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
  

	</style>
	<!-- ================== END core-css ================== -->
</head>
<body>
    <?php 
	include 'database.php';
	$do=isset($_GET['do']) ? $_GET['do'] : 'Manage';
	echo $do;
	
        ?>
            <div id="app" class="app-without-sidebar">
		<!-- BEGIN #content -->
		<div id="content" class="app-content main-style">
			<div class="d-flex justify-content-between">
				<div>
					<ul class="d-flex">
						<li class=""><a href="javascript:;" class="text-muted">Home /</a></li>
						<li class="">Scrum Board </li>
					</ul>
					<!-- BEGIN page-header -->
					<h1 class="page-header">
						Scrum Board 
					</h1>
					<!-- END page-header -->
				</div>
				
				<div class="">
				<a href="index.php?do=Add" id="modal-btn" class="button">Click Here</a>
				</div>
				
			</div>
			<?php 
            $stmt_add=$conn->prepare('SELECT * FROM todo');
			$stmt_add->execute();
			$todo_all=$stmt_add->fetchAll();
			?>
			<div class="row">
				<div class="col-12 col-md-6 col-lg-4 mb-2">
					<div class="card">
						<div class="card-header bg-black text-white d-flex align-items-center">
							<h4 class="h5 my-0">To do (<span id="to-do-tasks-count">5</span>)</h4>
						</div>
						<div class="my-table-todo card-body bg-white p-0" id="to-do-tasks">
							<!-- TO DO TASKS HERE -->
							<?php 
                            $stmt_add=$conn->prepare('SELECT * FROM todo WHERE status=1');
			                $stmt_add->execute();
			                $todo_all=$stmt_add->fetchAll();
			                ?>
							<?php if(!empty($todo_all)):?>
								<?php foreach($todo_all as $todo): ?>
									<button data-index="" class="task border-0 bg-white text-start d-flex border-bottom w-100 p-10px">
								    <div class="col-1">
									<i style="font-size: 20px;" class="bi bi-question-circle text-success"></i>
								    </div>
								    <div class="col-11">
									<h6 class="card-title mt-1"><?=$todo['title']?></h6>
									<div class="">
										<div style="font-size:10px;" class="text-gray"># created in <?=$todo['date']?></div>
										<div style="font-size: 11px;" class="text-dark" title="There is hardly anything more frustrating than having to look for current requirements in tens of comments under the actual description or having to decide which commenter is actually authorized to change the requirements. The goal here is to keep all the up-to-date requirements and details in the main/primary description of a task. Even though the information in comments may affect initial criteria, just update this primary description accordingly.">
										<?=$todo['description']?>
									    </div>
									</div>
									<div class="d-flex justify-content-between">
									<div class="">
										<span style="font-size: 8px;" class="btn-xs btn-primary py-1 px-2 rounded">
										    <?=$todo['type']?>
									    </span>
										<span style="font-size: 8px;" class="btn-xs btn-light text-black py-1 px-2 rounded ">
										    <?=$todo['priority'] ?>
									    </span>
										
									</div>
									<a 
									onclick="modal.classList.toggle(darkTheme);modal.classList.add(d);localStorage.setItem('selected-theme',getCurrentTheme())"
									href="index.php?do=Edit&user_id=<?=$todo['ID']?>"
									class="btn-sm btn-success"
					                >
									Edit
								    </a>
									<a 
									href="index.php?do=Delete&user_id=<?=$todo['ID']?>"
									class="btn-sm btn-danger"
					                >
									Delete
								    </a>
									</div>
								</div>
							    </button>
								<?php endforeach ?>
							<?php endif;  ?>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4 mb-2">
					<div class="card">
						<div class="card-header bg-black text-white d-flex align-items-center">
							<h4 class="h5 my-0">Now (<span id="to-do-tasks-count">5</span>)</h4>
						</div>
						<div class="my-table-now card-body  bg-white p-0" id="to-do-tasks">
							<!-- TO DO TASKS HERE -->
							<?php 
                            $stmt_add_pro=$conn->prepare('SELECT * FROM todo WHERE status=2');
			                $stmt_add_pro->execute();
			                $todo_all_pro=$stmt_add_pro->fetchAll();
			                ?>
							<?php if(!empty($todo_all_pro)):?>
								<?php foreach($todo_all_pro as $todo): ?>
									<button data-index="" class="task border-0 bg-white text-start d-flex border-bottom w-100 p-10px">
								    <div class="col-1">
									<i style="font-size: 20px;" class="bi bi-question-circle text-success"></i>
								    </div>
								    <div class="col-11">
									<h6 class="card-title mt-1"><?=$todo['title']?></h6>
									<div class="">
										<div style="font-size:10px;" class="text-gray"># created in <?=$todo['date']?></div>
										<div style="font-size: 11px;" class="text-dark" title="There is hardly anything more frustrating than having to look for current requirements in tens of comments under the actual description or having to decide which commenter is actually authorized to change the requirements. The goal here is to keep all the up-to-date requirements and details in the main/primary description of a task. Even though the information in comments may affect initial criteria, just update this primary description accordingly.">
										<?=$todo['description']?>
									    </div>
									</div>
									<div class="d-flex justify-content-between">
									<div class="">
										<span style="font-size: 8px;" class="btn-xs btn-primary py-1 px-2 rounded">
										    <?=$todo['type']?>
									    </span>
										<span style="font-size: 8px;" class="btn-xs btn-light text-black py-1 px-2 rounded ">
										    <?=$todo['priority'] ?>
									    </span>
										
									</div>
									<a 
									onclick="modal.classList.toggle(darkTheme);modal.classList.add(d);localStorage.setItem('selected-theme',getCurrentTheme())"
									href="index.php?do=Edit&user_id=<?=$todo['ID']?>"
									class="btn-sm btn-success"
					                >
									Edit
								    </a>
									<a 
									href="index.php?do=Delete&user_id=<?=$todo['ID']?>"
									class="btn-sm btn-danger"
					                >
									Delete
								    </a>
									</div>
								</div>
							    </button>
								<?php endforeach ?>
							<?php endif;  ?>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4 mb-2">
					<div class="card">
						<div class="card-header bg-black text-white d-flex align-items-center">
							<h4 class="h5 my-0">Done (<span id="to-do-tasks-count">5</span>)</h4>
						</div>
						<div class="my-table-done card-body bg-white p-0" id="to-do-tasks">
							<!-- TO DO TASKS HERE -->
							<?php 
                            $stmt_add_done=$conn->prepare('SELECT * FROM todo WHERE status=3');
			                $stmt_add_done->execute();
			                $todo_all_done=$stmt_add_done->fetchAll();
			                ?>
							<?php if(!empty($todo_all_done)):?>
								<?php foreach($todo_all_done as $todo): ?>
									<button data-index="" class="task border-0 bg-white text-start d-flex border-bottom w-100 p-10px">
								    <div class="col-1">
									<i style="font-size: 20px;" class="bi bi-question-circle text-success"></i>
								    </div>
								    <div class="col-11">
									<h6 class="card-title mt-1"><?=$todo['title']?></h6>
									<div class="">
										<div style="font-size:10px;" class="text-gray"># created in <?=$todo['date']?></div>
										<div style="font-size: 11px;" class="text-dark" title="There is hardly anything more frustrating than having to look for current requirements in tens of comments under the actual description or having to decide which commenter is actually authorized to change the requirements. The goal here is to keep all the up-to-date requirements and details in the main/primary description of a task. Even though the information in comments may affect initial criteria, just update this primary description accordingly.">
								<?=$todo['description']?>
									</div>
									</div>
									<div class="d-flex justify-content-between">
									<div class="">
										<span style="font-size: 8px;" class="btn-xs btn-primary py-1 px-2 rounded">
										    <?=$todo['type']?>
									    </span>
										<span style="font-size: 8px;" class="btn-xs btn-light text-black py-1 px-2 rounded ">
										    <?=$todo['priority'] ?>
									    </span>
										
									</div>
									<a 
									onclick="modal.classList.toggle(darkTheme);modal.classList.add(d);localStorage.setItem('selected-theme',getCurrentTheme())"
									href="index.php?do=Edit&user_id=<?=$todo['ID']?>"
									class="btn-sm btn-success"
					                >
									Edit
								    </a>
									<a 
									href="index.php?do=Delete&user_id=<?=$todo['ID']?>"
									class="btn-sm btn-danger"
					                >
									Delete
								    </a>
									</div>
								</div>
							    </button>
								<?php endforeach ?>
							<?php endif;  ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END #content -->
		

		
		<!-- BEGIN scroll-top-btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
		<!-- END scroll-top-btn -->
	</div>
		<?php 
	
	if($do=='Insert'){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $title=$_POST['title'];
			$description=$_POST['description'];
			$date=$_POST['date'];
			$type=$_POST['type'];
			$status=$_POST['status'];
			$priority=$_POST['preority'];
			$Error_msg=array();
			if(empty($title)){
                $Error_msg[]='Title Cant Be Empty';
			}
			if(empty($description)){
                $Error_msg[]='Description Cant Be Empty';
			}
			if(empty($date)){
                $Error_msg[]='date Cant Be Empty';
			}
			if($priority=="please selected"){
                $Error_msg[]='Need Choose Preiority';
			}
			if($status=="please select status"){
                $Error_msg[]='Need Select Status';
			}
            foreach($Error_msg as $err){
                echo "<div class='alert alert-danger'>".$err."</div>";
			}
			if(empty($Error_msg)){
                $stmt=$conn->prepare("INSERT INTO todo (title,description,date,type,status,priority) VALUES (:title,:description,:date,:type,:status,:priority)");
				$stmt->execute(array(
					'title' => $title ,
					'description' => $description,
					'date'=>$date,
					'type'=>$type,
					'status'=>$status,
					'priority'=>$priority 
				));
			}
			echo "<script>location.href='index.php'</script>";
            echo "<script>location.reload()</script>";
			
		}else{
			echo "<div class='alert alert-danger'>Sorry We Can Insert this data in database</div>";
		}
	}else if($do=="Update"){
        
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$id=$_POST['id'];
            $title=$_POST['title'];
			$description=$_POST['description'];
			$date=$_POST['date'];
			$type=$_POST['type'];
			$status=$_POST['status'];
			$priority=$_POST['preority'];
			$Error_msg=array();
			if(empty($title)){
                $Error_msg[]='Title Cant Be Empty';
			}
			if(empty($description)){
                $Error_msg[]='Description Cant Be Empty';
			}
			if(empty($date)){
                $Error_msg[]='date Cant Be Empty';
			}
			if($priority=="please selected"){
                $Error_msg[]='Need Choose Preiority';
			}
			if($status=="please select status"){
                $Error_msg[]='Need Select Status';
			}
            foreach($Error_msg as $err){
                echo "<div class='alert alert-danger'>".$err."</div>";
			}
			
                $stmt_up=$conn->prepare('UPDATE todo SET title=? , description=? , date=?, type=? , status=? ,priority=?  WHERE ID=?');
				$stmt_up->execute(array($title,$description,$date,$type,$status,$priority,$id));
				echo "<script>location.href='index.php'</script>";
                echo "<script>location.reload()</script>";
				

			
		}
		
	}else if($do=='Delete'){
        $id=isset($_GET['user_id'])  ? intval($_GET['user_id']) : '';
		$stmt=$conn->prepare("DELETE FROM todo WHERE ID=:id");
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		echo "<script>location.href='index.php'</script>";
        echo "<script>location.reload()</script>";

	}
























	?>
	<!-- BEGIN #app -->
	
	


	<!-- END #app -->
	
	<!-- TASK MODAL -->
	<div id="my-modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>

        <h2>
			Modal Header
			<?php 
		$action;
		if($do=="Add"){
            $action="index.php?do=Insert";
			echo "hhhh" . $action;
		}else if($do=="Edit"){
			$id=isset($_GET['user_id'])  ? intval($_GET['user_id']) : '';
			echo $id;
			$action="index.php?do=Update";
			echo "hhhhoooo" . $action;
			
			//echo $id;
            $stmt=$conn->prepare("SELECT * FROM todo WHERE ID=? LIMIT 1");
			$stmt->execute(array($id));
			$row=$stmt->fetch();
			$count=$stmt->rowCount();
			
			//echo $stmt_id;
		}
		?>
		</h2>
      </div>
      <div class="modal-body">
        <form id="form-add" action='<?=$action?>' method="POST">
            <div class="mb-3">
			  <input name="id" type="hidden" value="<?=isset($_GET['user_id']) ? $row['ID']: ''?>"> 
              <label for="recipient-name" class="col-form-label">Title:</label>
              <input value="<?=isset($_GET['user_id']) ? $row['title'] :'' ?> " name="title" type="text" id="title" class="form-control">
            </div>
            <div class="mb-3 d-flex flex-column">
              <label for="recipient-name" class="col-form-label">Type:</label>
              <div class="my-1 mx-2">
                  <input value="0" <?=isset($_GET['user_id']) ? ($row['type']==0 ? 'checked' : '') :'' ?> name='type' id="Featured" class="check-input one" class="form-check-input" type="radio" name="flexRadioDefault">
                  <label class="form-check-label" for="flexRadioDefault1">
                      Featured
                  </label>
              </div>
              <div class="my-1 mx-2">
                  <input value="1" <?=isset($_GET['user_id']) ? ($row['type']==1 ? 'checked' : '') :'' ?>  name='type' id="Bug" class="check-input two"  class="form-check-input" type="radio" name="flexRadioDefault">
                  <label class="form-check-label" for="flexRadioDefault1">
                      Bug 
                  </label>
              </div>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Preority:</label>
              <select name='preority' id="preority" class="form-select preority" aria-label="Default select example">
                  <option value="please selected" selected>Please Select</option>
                  <option <?=isset($_GET['user_id']) ? ($row['priority']==1 ? 'selected' : '') :'' ?> value="1">One</option>
                  <option <?=isset($_GET['user_id']) ? ($row['priority']==2 ? 'selected' : '') :'' ?> value="2">Two</option>
                  <option <?=isset($_GET['user_id']) ? ($row['priority']==3 ? 'selected' : '') :'' ?> value="3">Three</option>
                  <option <?=isset($_GET['user_id']) ? ($row['priority']==4 ? 'selected' : '') :'' ?> value="4">Three</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Status:</label>
              <select name='status' id="status" class="form-select status" aria-label="Default select example">
                  <option value="please select status"  selected>Please Select</option>
                  <option <?=isset($_GET['user_id']) ? ($row['status']==1 ? 'selected' : '') :'' ?> value="1">Todo</option>
                  <option <?=isset($_GET['user_id']) ? ($row['status']==2 ? 'selected' : '') :'' ?> value="2">Now</option>
                  <option <?=isset($_GET['user_id']) ? ($row['status']==3 ? 'selected' : '') :'' ?> value="3">Done</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="col-form-label" for="date">
                  Date 
              </label>
              <input  value="<?=isset($_GET['user_id']) ? $row['date'] :'' ?> " name='date' id="date" class="form-control" type="date">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Description</label>
              <textarea name='description' id="description" class="form-control">
			    <?=isset($_GET['user_id']) ? $row['description'] :'' ?> 
			  </textarea>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <input id="save" type="submit" name="submit" class="submit btn btn-primary" data-bs-dismiss="modal" value="save">
          <input onclick="closeModal();" id="update" type="submit" name="update" class="submit btn btn-primary" data-bs-dismiss="modal" value="update">
      </form>
      </div>
      <div class="modal-footer">
        <h3>Modal Footer</h3>
      </div>
    </div>
  </div>

	

	



	
	
	<!-- ================== BEGIN core-js ================== -->
	
	<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>
	<script type="text/javascript">
		console.log('hellomother fucker')
		const modal = document.querySelector('#my-modal');
const modalBtn = document.querySelector('#modal-btn');
const closeBtn = document.querySelector('.close');

// Events
//modalBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);

// Open


const darkTheme='active'
const selectedTheme=localStorage.getItem('selected-theme')
const getCurrentTheme=()=>modal.classList.contains(darkTheme) ? 'active' : 'h'
let d=getCurrentTheme();
console.log(d)
if(selectedTheme){
    //if the validation is fulfilled , we ask what the issue was to know if we activated or deactivated the dark
    modal.classList[selectedTheme==='active' ? 'add' : 'remove'](darkTheme)
}
modalBtn.addEventListener('click',()=>{
    //Add or remove the dark / icon theme
    modal.classList.toggle(darkTheme)
    modal.classList.add(d)
    //we save the theme and the current icon that the user chose
    localStorage.setItem('selected-theme',getCurrentTheme())
})


function openModal() {
  modal.classList.add('active')
}

// Close
function closeModal() {
  modal.classList.remove('active');
  window.localStorage.clear();
}
document.getElementById('save').addEventListener('click',closeModal)
//document.getElementById('update').addEventListener('click',closeModal)

// Close If Outside Click
function outsideClick(e) {
  if (e.target == modal) {
    modal.style.display = 'none';
	
  }
}

	</script>
	<!-- ================== END core-js ================== -->
</body>
</html>
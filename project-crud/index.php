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
	include 'model.php';
	$model = new Model();
	$insert = $model->insert();
	$rows = $model->fetch();
	$i = 1;
	?>
	<!-- BEGIN #app -->
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
				<button id="modal-btn" class="button">Click Here</button>
				</div>
				
			</div>
			
			<div class="row">
				<div class="col-12 col-md-6 col-lg-4 mb-2">
					<div class="card">
						<div class="card-header bg-black text-white d-flex align-items-center">
							<h4 class="h5 my-0">To do (<span id="to-do-tasks-count">5</span>)</h4>
						</div>
						<div class="my-table-todo card-body bg-white p-0" id="to-do-tasks">
							<!-- TO DO TASKS HERE -->
							<?php 
                                if(!empty($rows)){
							foreach($rows as $row):
							?>
							<button data-index="<?=$row['ID']?>" class="task border-0 bg-white text-start d-flex border-bottom w-100 p-10px">
								<div class="col-1">
									<i style="font-size: 20px;" class="bi bi-question-circle text-success"></i>
								</div>
								<div class="col-11">
									<h6 class="card-title mt-1"><?=$row['title']?></h6>
									<div class="">
										<div style="font-size:10px;" class="text-gray">#<?=$i?> created in <?=$row['date']?></div>
										<div style="font-size: 11px;" class="text-dark" title="There is hardly anything more frustrating than having to look for current requirements in tens of comments under the actual description or having to decide which commenter is actually authorized to change the requirements. The goal here is to keep all the up-to-date requirements and details in the main/primary description of a task. Even though the information in comments may affect initial criteria, just update this primary description accordingly.">
										<?=$row['description']?>
									</div>
									</div>
									<div class="d-flex justify-content-between">
									<div class="">
										<span style="font-size: 8px;" class="btn-xs btn-primary py-1 px-2 rounded">
										    <?= $row['priority']== '1' ? 'One' : ($row['priority']=='2' ? 'two' : ($row['priority']=='3' ? "three" : "for" ))  ?>
									    </span>
										<span style="font-size: 8px;" class="btn-xs btn-light text-black py-1 px-2 rounded ">
										    <?=  $row['type']==0 ? 'Featured' : "Bug" ?>
									    </span>
										
									</div>
									<btton 
									class="btn-sm btn-success"
									data-bs-toggle="modal" 
				 	                data-bs-target="#modal-task" 
					                data-bs-whatever="@mdo">
									Edit
								    </btton>
									</div>
								</div>
							</button>
							<?php 
							endforeach;
						    }else{
									echo "no fucking data";
								}
							?>
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
							<button class="border-0 bg-white text-start d-flex border-bottom w-100 p-10px">
								<div class="col-1">
									<i style="font-size: 20px;" class="bi bi-check-circle text-success"></i>
								</div>
								<div class="col-11">
									<h6 class="card-title mt-1">Keep all the updated requirements in one place</h6>
									<div class="">
										<div style="font-size:10px;" class="text-gray">#1 created in 2022-10-08</div>
										<div style="font-size: 11px;" class="text-dark" title="There is hardly anything more frustrating than having to look for current requirements in tens of comments under the actual description or having to decide which commenter is actually authorized to change the requirements. The goal here is to keep all the up-to-date requirements and details in the main/primary description of a task. Even though the information in comments may affect initial criteria, just update this primary description accordingly.">There is hardly anything more frustrating than having t...</div>
									</div>
									<div class="">
										<span style="font-size: 8px;" class="btn-xs btn-primary py-1 px-2 rounded">High</span>
										<span style="font-size: 8px;" class="btn-xs btn-light text-black py-1 px-2 rounded ">Feature</span>
									</div>
								</div>
							</button>
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
							<button class="border-0 bg-white text-start d-flex w-100 p-10px">
								<div class="col-1">
									<i style="font-size: 20px;" class="bx bx-loader-alt text-success"></i>
								</div>
								<div class="col-11">
									<h6 class="card-title mt-1">Keep all the updated requirements in one place</h6>
									<div class="">
										<div style="font-size:10px;" class="text-gray">#1 created in 2022-10-08</div>
										<div style="font-size: 11px;" class="text-dark" title="There is hardly anything more frustrating than having to look for current requirements in tens of comments under the actual description or having to decide which commenter is actually authorized to change the requirements. The goal here is to keep all the up-to-date requirements and details in the main/primary description of a task. Even though the information in comments may affect initial criteria, just update this primary description accordingly.">There is hardly anything more frustrating than having t...</div>
									</div>
									<div class="">
										<span style="font-size: 8px;" class="btn-xs btn-primary py-1 px-2 rounded">High</span>
										<span style="font-size: 8px;" class="btn-xs btn-light text-black py-1 px-2 rounded ">Feature</span>
									</div>
								</div>
							</button>
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
	


	<!-- END #app -->
	
	<!-- TASK MODAL -->
	<div id="my-modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2>Modal Header</h2>
      </div>
      <div class="modal-body">
        <form id="form-add" action='' method="POST">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Title:</label>
              <input name="title" type="text" id="title" class="form-control">
            </div>
            <div class="mb-3 d-flex flex-column">
              <label for="recipient-name" class="col-form-label">Type:</label>
              <div class="my-1 mx-2">
                  <input value='0' name='type' id="Featured" class="check-input one" class="form-check-input" type="radio" name="flexRadioDefault">
                  <label class="form-check-label" for="flexRadioDefault1">
                      Featured
                  </label>
              </div>
              <div class="my-1 mx-2">
                  <input value='1' name='type' id="Bug" class="check-input two"  class="form-check-input" type="radio" name="flexRadioDefault">
                  <label class="form-check-label" for="flexRadioDefault1">
                      Bug 
                  </label>
              </div>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Preority:</label>
              <select name='preority' id="preority" class="form-select preority" aria-label="Default select example">
                  <option value="please selected" selected>Please Select</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                  <option value="4">Three</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Status:</label>
              <select name='status' id="status" class="form-select status" aria-label="Default select example">
                  <option value="lease select sttus"  selected>Please Select</option>
                  <option value="1">Todo</option>
                  <option value="2">Now</option>
                  <option value="3">Done</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="col-form-label" for="date">
                  Date 
              </label>
              <input name='date' id="date" class="form-control" type="date">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Description</label>
              <textarea name='description' id="description" class="form-control"></textarea>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <input id="save" type="submit" name="submit" class="submit btn btn-primary" data-bs-dismiss="modal" value="save">
          <input type="submit" name="update" class="submit btn btn-primary" data-bs-dismiss="modal" value="update">
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
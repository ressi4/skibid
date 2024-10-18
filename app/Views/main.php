<?=$this->extend("layout/layout1");?>

<?=$this->section("content");?>
<div class="container">
   <h1 class="text-center">Riders</h1>
   <div class="row d-flex justify-content-center">
      <?php foreach($riders as $rider) {?>
      <div class="card bg-white border-secondary m-1" style="width: 18rem;">
         <div class="card-body">
            <h5 class="card-title text-center text-secondary fw-bold"><?=$rider->first_name.' '.$rider->last_name?></h5>
            <ul class="text-dark">
               <li>Country: <span class="fi fi-<?=$rider->country?>"></span></li>
               <li>Weight: <?php if($rider->weight != 0 && $rider->weight != null) echo $rider->weight.' kg'; else echo 'Unknown';?></li>
               <li>Height: <?php if($rider->height != 0 && $rider->height != null) echo $rider->height.' cm'; else echo 'Unknown';?></li>
            </ul>
            <div class="w-100 d-flex justify-content-center">
               <a href="<?php echo base_url($rider->link);?>" class="btn btn-success text-capitalize">Show details</a>
            </div>
         </div>
      </div>
      <?php }?>
   </div>

   <div class="d-flex justify-content-center pt-3">
      <?php echo $pager->links();?>
   </div>
</div>

<?=$this->endSection();?>
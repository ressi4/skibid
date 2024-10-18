<?=$this->extend("layout/layout1");?>

<?=$this->section("content");?>
<div class="container">
   <h1><?=$rider->first_name.' '.$rider->last_name?></h1>
   <?php if (isset($rider->photo)) {?>
      <img class="img img-fluid my-1" src="<?=base_url('assets/img/riders/'.$rider->photo)?>" alt="<?=$rider->first_name.' '.$rider->last_name?>">
   <?php } ?>
   <div>
      <span class="fw-bold">Details:</span>
      <ul>
         <li>Country: <span class="fi fi-<?=$rider->country?>"></span></li>
         <li>Weight: <?php if($rider->weight != 0 && $rider->weight != null) echo $rider->weight.' kg'; else echo 'Unknown';?></li>
         <li>Height: <?php if($rider->height != 0 && $rider->height != null) echo $rider->height.' cm'; else echo 'Unknown';?></li>
         <li>Date of birth: <?php $date = new DateTime($rider->date_of_birth);echo $date->format('F j, Y');;?></li>
         <li>Place of birth: <?php if($rider->place_of_birth != 0 && $rider->place_of_birth != null) echo $rider->place_of_birth; else echo 'Unknown';?></li>
      </ul>
   </div>
   <div>
      <a href="<?=base_url('pdf/'.$rider->id)?>"><button class="btn btn-primary">Show PDF</button></a>
      <a href="<?=base_url('edit/rider/'.$rider->id)?>"><button class="btn btn-warning">Edit Rider</button></a>
      <a href="<?=base_url('remove/rider/'.$rider->id)?>"><button class="btn btn-danger">Remove Rider</button></a>
   </div>
</div>

<?=$this->endSection();?>
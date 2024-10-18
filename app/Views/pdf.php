<?=$this->extend("layout/layout1");?>

<?=$this->section("content");?>
<div class="container">
   <h1>Create your own PDF</h1>
   <form method="post" action="<?php echo base_url('pdf/send');?>">
      <textarea id="tiny" name="content"><?php if(isset($content)) echo $content;?></textarea>
      <div class="w-100 d-flex justify-content-end">
         <input type="submit" class="btn btn-success my-2" value="Create PDF">
      </div>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</div>

<?=$this->endSection();?>
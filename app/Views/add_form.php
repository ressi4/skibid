<?=$this->extend("layout/layout1");?>

<?=$this->section("content");?>
<div class="container">
    <h1>Add Rider</h1>
<form method="post" action="<?php echo base_url('add/rider');?>">
  <div class="mb-3">
    <label for="firstName" class="form-label">First name</label>
    <input type="text" class="form-control" id="firstName" name="first_name">
  </div>
  <div class="mb-3">
    <label for="lastName" class="form-label">Last name</label>
    <input type="text" class="form-control" id="lastName" name="last_name">
  </div>
  <div class="mb-3">
    <label for="country" class="form-label">Country code</label>
    <input type="text" class="form-control" id="country" name="country">
  </div>
  <div class="mb-3">
    <label for="dateOfBirth" class="form-label">Date of birth</label>
    <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth">
  </div>
  <div class="mb-3">
    <label for="weight" class="form-label">Weight</label>
    <input type="number" class="form-control" id="weight" name="weight">
  </div>
  <div class="mb-3">
    <label for="height" class="form-label">Height</label>
    <input type="number" class="form-control" id="height" name="height">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<?=$this->endSection();?>
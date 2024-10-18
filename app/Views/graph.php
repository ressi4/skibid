<?=$this->extend("layout/layout1");?>

<?=$this->section("content");?>
<div class="container">
  <h1>Graph</h1>
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
const xValues = ["Adin Ross", "Livvy Dunne", "Duke Dennis", "Saul Goodman", "John Pork"];
const yValues = [69, 173, 128, 420, 666];
const barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Rizz Chart"
    }
  }
});
</script>
<?=$this->endSection();?>
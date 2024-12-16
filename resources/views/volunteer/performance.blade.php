@extends('layouts.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
var xValues = ["Trainings ({{$volunteer->trainings()->count()}})", "Rescues (2)", "Camps (3)", "Special Programms (4)"];
var yValues = ['{{$volunteer->trainings()->count()}}', 2, 3, 1, 4]; // Example data
var barColors = ["green", "red", "blue", "orange", "brown"];

// Calculate the maximum value in yValues
var maxValue = Math.max(...yValues);
console.log(maxValue);

// Determine a suitable step size
function calculateStepSize(maxValue) {
    if (maxValue <= 10) {
        return 1;
    } else if (maxValue <= 50) {
        return 5;
    } else if (maxValue <= 100) {
        return 10;
    } else if (maxValue <= 500) {
        return 50;
    } else {
        return 100;
    }
}

var stepSize = calculateStepSize(maxValue);
console.log(stepSize)

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    legend: { display: false },
    title: {
      display: true,
      text: "{{$volunteer->user->name}}'s Performance Chart"
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
          stepSize: stepSize, // Use dynamic step size
          callback: function(value) {
            if (Number.isInteger(value)) {
              return value; // Show only integers
            }
          }
        }
      }]
    }
  }
});
</script>
@endsection

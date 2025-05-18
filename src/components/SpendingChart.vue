<!-- Contributed by Zuhayer: Spending Breakdown (Doughnut) -->
<template>
  <div class="chart-container">
    <h4>🍩 Spending Breakdown</h4>
    <canvas ref="chart"></canvas>
  </div>
</template>

<script>
import {
  Chart,
  DoughnutController,
  ArcElement,
  Tooltip,
  Legend,
} from "chart.js";

Chart.register(DoughnutController, ArcElement, Tooltip, Legend);

export default {
  name: "SpendingChart",
  props: ["data"],
  mounted() {
    new Chart(this.$refs.chart, {
      type: "doughnut",
      data: {
        labels: Object.keys(this.data),
        datasets: [
          {
            data: Object.values(this.data),
            backgroundColor: [
              "#f87979",
              "#7db9e8",
              "#88d498",
              "#f7c59f",
              "#ffa07a",
            ],
            borderWidth: 2,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              color: "#fff",
            },
          },
        },
      },
    });
  },
};
</script>

<style scoped>
.chart-container {
  background: #1f2a40;
  padding: 20px;
  border-radius: 12px;
  margin: 1rem 0;
  color: #fff;
}
canvas {
  max-width: 100%;
}
</style>

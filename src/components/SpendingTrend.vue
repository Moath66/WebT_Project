<!-- Contributed by Zuhayer: Monthly Spending Bar Chart -->
<template>
  <div class="chart-container">
    <h4>📈 Monthly Spending Trend</h4>
    <canvas ref="barChart"></canvas>
  </div>
</template>

<script>
import {
  Chart,
  BarElement,
  CategoryScale,
  LinearScale,
  Tooltip,
  Legend,
} from "chart.js";

Chart.register(BarElement, CategoryScale, LinearScale, Tooltip, Legend);

export default {
  name: "SpendingTrend",
  props: ["monthlyData"],
  mounted() {
    new Chart(this.$refs.barChart, {
      type: "bar",
      data: {
        labels: Object.keys(this.monthlyData),
        datasets: [
          {
            label: "Expenses (RM)",
            data: Object.values(this.monthlyData),
            backgroundColor: "#42b983",
            borderRadius: 6,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: true, position: "bottom" },
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: (value) => `RM ${value}`,
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

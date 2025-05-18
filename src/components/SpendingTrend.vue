<!-- Contributed by Zuhayer: Monthly Spending Trend Bar Chart -->
<template>
  <div class="chart-container">
    <h4>📈 Monthly Spending Trend</h4>
    <canvas ref="barChart"></canvas>
  </div>
</template>

<script>
import {
  Chart,
  BarController,
  BarElement,
  CategoryScale,
  LinearScale,
  Tooltip,
  Legend,
} from "chart.js";

Chart.register(
  BarController,
  BarElement,
  CategoryScale,
  LinearScale,
  Tooltip,
  Legend
);

export default {
  name: "SpendingTrend",
  props: ["monthlyData"],
  data() {
    return {
      chartInstance: null,
    };
  },
  watch: {
    monthlyData: {
      immediate: true,
      handler(newData) {
        if (!newData || Object.keys(newData).length === 0) return;

        if (this.chartInstance) {
          this.chartInstance.destroy();
        }

        this.chartInstance = new Chart(this.$refs.barChart, {
          type: "bar",
          data: {
            labels: Object.keys(newData),
            datasets: [
              {
                label: "Expenses (RM)",
                data: Object.values(newData),
                backgroundColor: "#42b983",
                borderRadius: 8,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: "bottom",
                labels: { color: "#ffffff" },
              },
            },
            scales: {
              y: {
                beginAtZero: true,
                ticks: { color: "#ccc", callback: (val) => `RM ${val}` },
              },
              x: {
                ticks: { color: "#ccc" },
              },
            },
          },
        });
      },
    },
  },
};
</script>

<style scoped>
.chart-container {
  background: #1f2a40;
  padding: 20px;
  border-radius: 12px;
  min-height: 260px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.chart-container h4 {
  margin-bottom: 15px;
  text-align: center;
}
canvas {
  width: 100% !important;
  height: 200px !important;
}
</style>

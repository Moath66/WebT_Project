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
  data() {
    return {
      chartInstance: null,
    };
  },
  watch: {
    data: {
      immediate: true,
      handler(newData) {
        if (!newData || Object.keys(newData).length === 0) return;

        // Destroy previous instance
        if (this.chartInstance) {
          this.chartInstance.destroy();
        }

        // Create new chart
        this.chartInstance = new Chart(this.$refs.chart, {
          type: "doughnut",
          data: {
            labels: Object.keys(newData),
            datasets: [
              {
                data: Object.values(newData),
                backgroundColor: [
                  "#f94144",
                  "#f3722c",
                  "#f9c74f",
                  "#90be6d",
                  "#577590",
                ],
                borderWidth: 2,
                borderColor: "#1f2a40",
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: "bottom",
                labels: {
                  color: "#ffffff",
                  padding: 15,
                  boxWidth: 20,
                },
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
  color: #ffffff;
}

canvas {
  width: 100% !important;
  height: 200px !important;
}
</style>

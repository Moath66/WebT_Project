<!-- Contributed by Zuhayer: Monthly Spending Trend Bar Chart -->
<template>
  <!-- Chart container with a heading and canvas for rendering the bar chart -->
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

// Register necessary Chart.js components
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
  props: ["monthlyData"], // Accepts the monthlyData prop for rendering the chart
  data() {
    return {
      chartInstance: null, // Holds reference to the Chart.js instance
    };
  },
  watch: {
    // Watcher to detect changes in monthlyData and update the chart accordingly
    monthlyData: {
      immediate: true, // Run handler immediately on component mount
      handler(newData) {
        // Exit early if newData is empty or undefined
        if (!newData || Object.keys(newData).length === 0) return;

        // Destroy existing chart instance to prevent duplicates
        if (this.chartInstance) {
          this.chartInstance.destroy();
        }

        // Create a new Chart.js bar chart instance with updated data
        this.chartInstance = new Chart(this.$refs.barChart, {
          type: "bar",
          data: {
            labels: Object.keys(newData), // Set X-axis labels from data keys (e.g., months)
            datasets: [
              {
                label: "Expenses (RM)", // Dataset label
                data: Object.values(newData), // Set Y-axis values from data values
                backgroundColor: "#42b983", // Set bar color
                borderRadius: 8, // Rounded corners for bars
              },
            ],
          },
          options: {
            responsive: true, // Make chart responsive
            maintainAspectRatio: false, // Allow flexible height/width
            plugins: {
              legend: {
                position: "bottom", // Place legend at the bottom
                labels: { color: "#ffffff" }, // Set legend text color
              },
            },
            scales: {
              y: {
                beginAtZero: true, // Start Y-axis from zero
                ticks: {
                  color: "#ccc", // Set Y-axis tick color
                  callback: (val) => `RM ${val}`, // Format Y-axis tick labels with currency
                },
              },
              x: {
                ticks: { color: "#ccc" }, // Set X-axis tick color
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

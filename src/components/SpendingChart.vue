<!-- Contributed by Zuhayer: Spending Breakdown (Doughnut) -->
<template>
  <!-- Chart container with a title and canvas for rendering the doughnut chart -->
  <div class="chart-container">
    <h4>🍩 Spending Breakdown</h4>
    <canvas ref="chart"></canvas>
  </div>
</template>

<script>
// Import required components from Chart.js
import {
  Chart,
  DoughnutController,
  ArcElement,
  Tooltip,
  Legend,
} from "chart.js";

// Register Chart.js components
Chart.register(DoughnutController, ArcElement, Tooltip, Legend);

export default {
  name: "SpendingChart",
  props: ["data"], // Receives spending data as a prop
  data() {
    return {
      chartInstance: null, // Holds the Chart.js instance
    };
  },
  watch: {
    // Watcher for changes in the data prop
    data: {
      immediate: true, // Trigger handler immediately upon component load
      handler(newData) {
        // Exit early if data is empty or not provided
        if (!newData || Object.keys(newData).length === 0) return;

        // Destroy previous chart instance to prevent duplication
        if (this.chartInstance) {
          this.chartInstance.destroy();
        }

        // Create a new doughnut chart instance with the updated data
        this.chartInstance = new Chart(this.$refs.chart, {
          type: "doughnut",
          data: {
            labels: Object.keys(newData), // Set segment labels from data keys
            datasets: [
              {
                data: Object.values(newData), // Set segment values from data values
                backgroundColor: [
                  "#f94144",
                  "#f3722c",
                  "#f9c74f",
                  "#90be6d",
                  "#577590",
                ], // Set different colors for each segment
                borderWidth: 2, // Set border width
                borderColor: "#1f2a40", // Match chart background
              },
            ],
          },
          options: {
            responsive: true, // Make chart responsive
            maintainAspectRatio: false, // Allow flexible aspect ratio
            plugins: {
              legend: {
                position: "bottom", // Place legend below the chart
                labels: {
                  color: "#ffffff", // Set legend label text color
                  padding: 15, // Padding between labels
                  boxWidth: 20, // Width of color box next to label
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

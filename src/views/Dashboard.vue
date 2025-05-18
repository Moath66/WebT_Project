// Developed and connected all components, handled data flow between dashboard and form - Abdulrahman Daney

<template>
  <div>
    <h2>Personal Finance Dashboard</h2>
    <SummaryCard />
    <SpendingChart />
    <SpendingTrend />
    <TransactionList />
  </div>
</template>

<script>
import SummaryCard from "@/components/SummaryCard.vue";
import SpendingChart from "@/components/SpendingChart.vue";
import SpendingTrend from "@/components/SpendingTrend.vue";
import TransactionList from "@/components/TransactionList.vue";

export default {
  components: { SummaryCard, SpendingChart, SpendingTrend, TransactionList },
};
</script>

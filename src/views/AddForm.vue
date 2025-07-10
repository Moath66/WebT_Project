<template>
  <div class="form-container">
    <h2>➕ Add New Transaction</h2>
    <form @submit.prevent="handleSubmit">
      <label for="type">Type:</label>
      <select id="type" v-model="form.type" required>
        <option disabled value="">Select type</option>
        <option value="income">Income</option>
        <option value="expense">Expense</option>
      </select>

      <label for="amount">Amount (RM):</label>
      <input
        id="amount"
        type="number"
        v-model.number="form.amount"
        min="0.01"
        step="0.01"
        required
      />

      <label for="category">Category:</label>
      <input id="category" type="text" v-model="form.category" required />

      <label for="date">Date:</label>
      <input id="date" type="date" v-model="form.date" required />

      <label for="note">Note (optional):</label>
      <textarea
        id="note"
        v-model="form.note"
        placeholder="Description..."
      ></textarea>

      <div class="buttons">
        <button type="submit">✅ Add Transaction</button>
        <router-link to="/" class="cancel-btn">❌ Cancel</router-link>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AddForm",
  data() {
    return {
      form: {
        type: "",
        amount: 0,
        category: "",
        date: "",
        note: "",
      },
    };
  },
  methods: {
    async handleSubmit() {
      try {
        await axios.post(
          "http://localhost:8081/personal-finance-tracker_CODE\finance-backend\api\transactions/post.php",
          this.form
        );
        alert("✅ Transaction added successfully!");
        this.$router.push("/");
      } catch (error) {
        console.error("Failed to add transaction:", error);
        alert("❌ Error: Could not add transaction.");
      }
    },
  },
};
</script>

<style scoped>
.form-container {
  max-width: 600px;
  margin: 40px auto;
  padding: 30px;
  background-color: #1f2a40;
  border-radius: 12px;
  color: #fff;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

form {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

label {
  font-weight: bold;
  margin-top: 10px;
}

input,
select,
textarea {
  padding: 10px;
  border-radius: 6px;
  border: 1px solid #ccc;
  font-size: 1rem;
  background-color: #fff;
  color: #000;
}

textarea {
  resize: vertical;
  min-height: 80px;
}

.buttons {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
}

button {
  background-color: #42b983;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
}

button:hover {
  background-color: #36966e;
}

.cancel-btn {
  color: #f44336;
  font-weight: bold;
  text-decoration: none;
}
</style>

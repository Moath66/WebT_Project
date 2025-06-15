const API_BASE_URL = "http://localhost/backend/api/transactions";

// Get all transactions
export async function getTransactions() {
    const response = await fetch(API_BASE_URL);
    return response.json();
}

// Add a new transaction
export async function addTransaction(transaction) {
    const response = await fetch(API_BASE_URL, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(transaction),
    });
    return response.json();
}

// Update a transaction
export async function updateTransaction(id, transaction) {
    const response = await fetch(`${API_BASE_URL}/${id}`, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(transaction),
    });
    return response.json();
}

// Delete a transaction
export async function deleteTransaction(id) {
    const response = await fetch(`${API_BASE_URL}/${id}`, {
    method: "DELETE",
    });
    return response.json();
}
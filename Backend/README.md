# Personal Finance Backend API

This is the backend API for the Personal Finance application, built with PHP and MySQL.

## Setup Instructions

1. **Database Setup**

   - Install MySQL if you haven't already
   - Create a new database using the provided SQL script:
     ```bash
     mysql -u root -p < database.sql
     ```

2. **PHP Configuration**

   - Make sure PHP is installed on your system
   - Configure your web server (Apache/Nginx) to point to the `api` directory
   - Update database credentials in `api/db.php` if needed

3. **Testing the API**
   You can test the API endpoints using tools like Postman or curl:

   - GET all transactions:

     ```
     GET http://localhost/backend/api/transactions
     ```

   - POST new transaction:

     ```
     POST http://localhost/backend/api/transactions
     Content-Type: application/json

     {
       "date": "2024-03-06",
       "category": "Food",
       "type": "expense",
       "amount": 50.00
     }
     ```

   - PUT update transaction:

     ```
     PUT http://localhost/backend/api/transactions/1
     Content-Type: application/json

     {
       "date": "2024-03-06",
       "category": "Food",
       "type": "expense",
       "amount": 55.00
     }
     ```

   - DELETE transaction:
     ```
     DELETE http://localhost/backend/api/transactions/1
     ```

## API Documentation

### Endpoints

| Route                 | Method | Purpose      |
| --------------------- | ------ | ------------ |
| /api/transactions     | GET    | Get all      |
| /api/transactions     | POST   | Add new      |
| /api/transactions/:id | PUT    | Update by ID |
| /api/transactions/:id | DELETE | Delete by ID |

### Response Format

All responses are in JSON format with appropriate HTTP status codes:

- 200: Success
- 201: Created
- 400: Bad Request
- 404: Not Found
- 500: Server Error

### Error Handling

The API returns error messages in the following format:

```json
{
  "message": "Error message",
  "error": "Detailed error information (if available)"
}
```

## Security

- The API uses prepared statements to prevent SQL injection
- CORS headers are properly configured
- Input validation is implemented for all endpoints

## Frontend Integration

To connect your Vue.js frontend to this API:

1. Update your API calls to use the new endpoints
2. Replace localStorage operations with fetch/axios calls
3. Handle API responses and errors appropriately

Example frontend API call:

```javascript
async function getTransactions() {
  try {
    const response = await fetch("http://localhost/backend/api/transactions");
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Error fetching transactions:", error);
    throw error;
  }
}
```

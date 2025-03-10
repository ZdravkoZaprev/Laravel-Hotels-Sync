# Little Emperors Tech Test

This test should be completed using **Laravel**.

Feel free to install any libraries or plugins to facilitate the tasks.  
Ensure that all code is committed to the repository when you're done.  

---

## **Test 1: Import Hotels Data**
Implement a **console command** to import a file containing a list of hotels and store the data in a local database. 

- **Cities** should be stored in a separate table, ensuring that city names are unique.
- You may use **any database engine** of your choice.
- The data format can be either **CSV** or **JSON** but be easily extendable for other possible formats in the future.
- Sample data files are provided in this repository.
- To facilitate parsing, you may install any relevant import libraries via **Composer**.
- The import script should be executed via a **console command**, accepting the file as a parameter and automatically detecting its format.
- **Important:** The CSV file uses **semicolon (;)** as the delimiter to handle potential commas within fields like hotel names and descriptions.

---

## **Test 2: RESTful API for Hotel Management**
Develop a **RESTful API** to handle **CRUD** operations for hotels imported in **Test 1**.

The API should include the following endpoints:

1. **List all hotels**  
   - Returns only: `id`, `name`, `image`, `stars`, and `city`.  

2. **Retrieve hotel details**  
   - Fetches all details of a hotel by its `ID`.  

3. **Create a new hotel**  
   - Adds a new hotel to the database.  

4. **Update an existing hotel**  
   - Modifies the details of a given hotel.  

5. **Delete a hotel** *(Soft Delete)*  
   - The hotel should not be permanently deleted but instead flagged as deleted.

---

##### **Submission**
- Submit the code to this **GitHub repository**.
- Ensure the repository includes a **README.md** with:
  - Project overview.
  - Setup instructions.
  - Any additional notes or dependencies.

---

## **Evaluation Criteria**
As we are looking for a **senior developer**, the primary evaluation criteria will be:

✅ **Code Quality:** Clean, consistent, scalable, and performant code.  
✅ **Separation of Concerns:** Well-structured components, services, and utilities.  
✅ **SOLID Principles & Design Patterns:** Demonstrating maintainable and extensible architecture.  
✅ **Proper use of HTTP verbs and status codes:** Ensure that API calls correctly implement methods like `GET`, `POST`, `PUT`, and `DELETE`, and return appropriate error codes.  
✅ **Best Practices:** Proper use of version control and documentation.

---

### **Final Notes**
- The test is designed to assess your ability to write **efficient, maintainable, and high-quality code**.
- Feel free to ask any clarifying questions before starting.

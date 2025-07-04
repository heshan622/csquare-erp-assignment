# ERP System - Csquare Technologies Assignment

This is a simple ERP system built to fulfill the requirements of the software intern assignment from Csquare Technologies. The application is built using PHP and MySQL.

---

## Features

* **Customer Management:** Register and view customer details.
* **Item Management:** Register and view items, categories, and sub-categories.
* **Reporting:** Generate three different reports based on sales data:
    * Invoice Summary Report (with date range)
    * Invoice Item Details Report (with date range)
    * Item Sales Report (grouped by item)

---

## How to Set Up the Project

### Prerequisites
* A local server environment like **XAMPP** or WAMP.
* A web browser (e.g., Google Chrome, Firefox).
* A code editor (e.g., VS Code).

### Installation Steps

1.  **Clone the repository or download the source code.**
    Place the project folder (`erp-system`) inside your local server's web directory (e.g., `C:\xampp\htdocs`).

2.  **Start Your Server.**
    Open the XAMPP Control Panel and start the **Apache** and **MySQL** services.

3.  **Import the Database.**
    * Open your web browser and navigate to `http://localhost/phpmyadmin/`.
    * Create a new database and name it **`assignment`**.
    * Click on the newly created `assignment` database.
    * Go to the **Import** tab.
    * Click "Choose File" and select the `assignment.sql` file included in this project.
    * Click "Go" to import the data.

4.  **Run the Application.**
    Open your web browser and navigate to the following URL:
    ```
    http://localhost/erp-system/
    ```

---

## Assumptions Made

* The provided `assignment.sql` file is the primary source of truth for the database structure and initial data.
* The "Item Report" (Task 3c) was interpreted as a report summarizing the total quantity of items sold, grouped by item, as this provides more business value than a simple stock list.
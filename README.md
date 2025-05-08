## About BBQ Lagao

BBQ~Lagao at Beef Pares was the first business Arc-Based Solution conducted interview with and used their business as our model on different subjects this includes our IT6(Database),IT7(Figma),and IT9aL(Web Dev). so far Arc-Based Solution has created multiple systems using BBQ~Lagao's name and it will continue to develop numerous systems for the business.

- [IT6 Database](https://github.com/Genshirog/bbq_pares/).
- [IT7 Figma](https://www.figma.com/design/LY6kMVeuK8BgNXF9slbuYk/IT7L_PROTOTYPE?m=auto&t=LMC1Xz8dpmR4HsND-6).
- [IT9 Web Development](https://github.com/Genshirog/IT9_Project).

Arc-Based Solution is a group of developers willing to increase their knowledge and skills by creating real-world systems.

## About The System

This project, developed for IT9, is a **Food Ordering System** featuring three distinct user roles: **Admin**, **Staff**, and **Customer**. Each role offers a unique user interface and user experience tailored to its responsibilities. The system includes all core functionalities expected in a modern food ordering platform, such as product browsing, order placement, order tracking, and role-based access control.

## Features

- User Authentication (Login, Register)
- Role-based access (Admin, Staff, Customer)
- Order Management
- Sales Reporting
- Responsive UI with Tailwind CSS

## Setup Instructions

### Requirements

- PHP >= 8.1
- Composer
- Node.js and NPM
- MySQL or other supported DB
- Laravel 10.x

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Genshirog/IT9_Project.git
   cd bbq_lagao

2. composer install

3. npm install && npm run dev

4. cp .env.example .env
    php artisan key:generate

5. DB_DATABASE=your_db
    DB_USERNAME=your_user
    DB_PASSWORD=your_password

6. php artisan migrate

7. php artisan serve

### Usage
Once the server is running, visit [http://127.0.0.1:8000] in your browser.

Default Roles:
Admin: Full access (Add staff, view sales, manage users)

Staff: Can manage orders and view sales

Customer: Can browse and place orders

### Database Schema
Users
-UserID
-firstname
-lastname
-username
-password
-address
-RoleID
-email
-contactNumber
-birthday
-image

Products
-ProductID
-productName
-category
-price
-productDescription
-image

Roles
-RoleID
-roleName 
-roleDescription

Orders
-OrderID
-orderDate
-UserID
-totalPrice
-deliveryType
-status

OrderItems
-OrderItemsID
-OrderID
-ProductID
-quantity
-subTotal

Payments
-PaymentID
-OrderID
-amountPayed
-amountChanged
-paymentMethod
-status

Carts(Temporary Table)
-CartID
-orderDate
-UserID
-totalPrice

CartItems(Temporary Table)
-CartItemsID
-CartID
-ProductID
-quantity
-subTotal


## Who are the Developers?

Arc-Based Solution Member [Genshirog](https://github.com/Genshirog) programmed and built the ERD of the system.
"I would never say I did this solo, without the Prototype design by my fellow partners I would have a hard time building my application"

### Partners

- **[RyuoTonji](https://github.com/RyuoTonji)**
- **[LlanderSei](https://github.com/LlanderSei)**

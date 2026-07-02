# OGS Marketplace / Food Store

OGS Marketplace is a PHP and MySQL based online grocery store for browsing products, managing a shopping cart, checking out, and handling customer accounts. The site includes a storefront home page, product catalog, search suggestions, a shopping cart, checkout flow, customer profile management, an employee admin page, contact forms, policy pages, and an AI assistant on the landing page.

## Features

- Product browsing from the store inventory database
- Category-based shopping for Meat & Seafood, Vegetables, Fruits, and Dairy
- Product search with live suggestions
- Shopping cart with quantity updates, item removal, and clear-all actions
- Checkout flow that records orders and applies a delivery fee when the order exceeds 20 lbs
- Customer registration, login, profile editing, password updates, and past order viewing
- Employee admin page for adding, updating, and deleting products
- Contact form for customer inquiries
- Static About, Privacy Policy, and Licensing pages
- Dark mode toggle across the main site pages
- AI assistant on the home page for food and marketplace questions

## Tech Stack

- PHP for server-side pages and form handling
- MySQL for product, account, cart, order, and message data
- JavaScript for navigation, search, dark mode, and chatbot behavior
- Webpack for bundling the source files in `SRC/` into the browser-ready scripts in `JS/`
- jQuery and Boxicons for UI interactions and icons
- OpenAI API for the chatbot experience

## Project Structure

- `PHP/` - dynamic application pages and server routes
- `HTML/` - static pages such as login, registration, privacy policy, and contact
- `CSS/` - styling for the storefront, cart, account, and policy pages
- `IMAGES/` - product images and branding assets
- `SRC/` - source JavaScript that is bundled by Webpack
- `JS/` - generated browser scripts used by the site
- `storeDatabse.sql` - database schema and seed data

## Setup

1. Install a local PHP environment with MySQL, such as XAMPP, WAMP, MAMP, or a similar stack.
2. Create a MySQL database named `store_database`.
3. Import `storeDatabse.sql` into that database.
4. Update `PHP/config.php` if your database host, username, password, or database name differ from the defaults.
5. Install the JavaScript dependencies:

   ```bash
   npm install
   ```

6. Build the browser scripts from `SRC/` into `JS/`:

   ```bash
   npm run build
   ```

7. Serve the project through Apache or another PHP-capable web server and open `PHP/index.php` in your browser.

## Main Pages

- `PHP/index.php` - storefront home page with hero content, carousel, and AI assistant
- `PHP/productpage.php` - product listing page with add-to-cart actions and category navigation
- `PHP/shoppingcart.php` - cart management page with quantity updates and totals
- `PHP/checkout.php` - checkout page that stores completed orders
- `PHP/customer_profile.php` - customer account page with contact, delivery, password, and order history sections
- `PHP/admin.php` - employee inventory management page
- `HTML/customer_login.html` - customer login page
- `HTML/customer_registration.html` - customer registration page
- `HTML/contact_us.html` - contact form page
- `HTML/privacyPolicy.html` - privacy policy page
- `HTML/licensing.html` - licensing information page

## Notes

- Cart and checkout pages require a signed-in customer session.
- Product data is read from the `store_inventory` table.
- The bundled JavaScript is produced from `SRC/index.js` and `SRC/ai.js`.

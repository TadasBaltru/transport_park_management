# Transport Park Management System

This project is a Transport Park Management System API built with PHP and Symfony. It helps manage vehicles (trucks and trailers), fleets, and service orders within a transport fleet.

## Table of Contents

- [Getting Started](#getting-started)
- [Database Structure](#database-structure)
- [API Endpoints](#api-endpoints)
    - [Trailers & Trucks](#trailers--trucks)
    - [Orders & Fleets](#orders--fleets)
- [Order History](#order-history)

## Getting Started

To get the project up and running, follow these steps:

### Prerequisites

Make sure you have the following installed on your machine:
- Docker
- Composer
- Symfony CLI

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/TadasBaltru/transport_park_management
   ```

2. Navigate into the project directory:

   ```bash
   cd transport_park_management
   ```

3. Install project dependencies:

   ```bash
   composer install
   ```

4. Start Docker containers:

   ```bash
   docker-compose up
   ```

5. Create the database:

   ```bash
   symfony console doctrine:database:create
   ```

6. Migrate database tables:

   ```bash
   symfony console doctrine:migrations:migrate
   ```

   Press **Enter** when prompted.

7. Access MySQL to view the database (optional):

   Open [http://localhost:8080/](http://localhost:8080/)

    - **Server**: `mySQL`
    - **Username**: `root`
    - **Password**: `root`

If you see filled database, everything has been set up correctly!

8. Start Symfony server:
   ```bash
   symfony server:start
   ```


## Database Structure

The system uses five tables for managing the transport park:

1. **Fleet**
    - Columns:
        - `id`: (int, primary key, auto-increment)
        - `truck_id`: (int, foreign key to `Truck`, one-to-one relationship)
        - `trailer_id`: (int, foreign key to `Trailer`, one-to-one relationship)
        - `status`: (string, e.g., `COMPLETED`, `IN_PROGRESS`, `PENDING`)

2. **History**
    - Columns:
        - `id`: (int, primary key, auto-increment)
        - `order_id`: (int, foreign key to `Order`, many-to-one relationship)
        - `status`: (string)
        - `created_at`: (datetime)

3. **Order**
    - Columns:
        - `id`: (int, primary key, auto-increment)
        - `truck_id`: (int, foreign key to `Truck`, many-to-one relationship)
        - `trailer_id`: (int, foreign key to `Trailer`, many-to-one relationship)
        - `fleet_id`: (int, foreign key to `Fleet`, many-to-one relationship)
        - `status`: (string)
        - `created_at`: (datetime)

4. **Trailer**
    - Columns:
        - `id`: (int, primary key, auto-increment)
        - `license_number`: (varchar)
        - `status`: (string)

5. **Truck**
    - Columns:
        - `id`: (int, primary key, auto-increment)
        - `license_number`: (varchar)
        - `status`: (string)

## API Endpoints

### Trailers & Trucks

1. **List All Trailers or Trucks**:
    - **GET** `/trailer` or `/truck`

2. **Search with Filters**:
    - You can search for specific trailers or trucks by using GET parameters:
      ```bash
      /truck?licenseNumber=TRUCK013
      ```
    - Available search parameters:
        - `licenseNumber`
        - `status`
        - `fleet_id`

3. **Get Trailer or Truck by ID**:
    - **GET** `/truck/{id}` or `/trailer/{id}`
    - Example:
      ```bash
      /truck/1
      ```

### Orders & Fleets

1. **Get Order or Fleet by ID**:
    - **GET** `/order/{id}` or `/fleet/{id}`
    - Example:
      ```bash
      /order/1
      ```

2. **Search Orders or Fleets**:
    - **Fleet Search Parameters**:
        - `id`, `status`, `trailerId`, `trailerLicenseNumber`, `truckId`, `truckLicenseNumber`
    - **Order Search Parameters**:
        - `id`, `status`, `createdAt`, `truckId`, `truckLicenseNumber`, `trailerId`, `trailerLicenseNumber`, `fleetId`

## Order History

To view the history of an order's status changes, use the following endpoint:

- **GET** `/order/history/{id}`

Example:
```bash
/order/history/1
```

This will return a record of when the status was changed for the specified order.

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

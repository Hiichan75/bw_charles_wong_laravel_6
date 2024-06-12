# BW Charles Wong Laravel 6

This is a backend web project built with Laravel 6.

## Installation

Follow these steps to install and run the project:

1. **Install Composer Dependencies**
    ```bash
    composer install
    ```

2. **Install NPM Packages**
    ```bash
    npm install
    ```

3. **Compile Assets**
    ```bash
    npm run dev
    ```

4. **Generate Application Key**
    ```bash
    php artisan key:generate
    ```
    If you encounter any issues, remove 'example' from `.env.example`.

5. **Run Migrations and Seed Database**
    ```bash
    php artisan migrate:fresh --seed
    ```

6. **Start the Server**
    ```bash
    php artisan serve
    ```

Now, you should be able to access the application at `http://localhost:8000`.

## Documentation

The documentation for this project is currently being written and will be available soon.

## Contributing

Contributions are welcome! Please feel free to submit a pull request.

## License

This project is open-sourced software licensed under the MIT license.

# Slim Blog

A robust blog application built using the Slim Framework, Blade templating, and dependency injection principles. It offers user authentication, post management, and commenting features to create a seamless blogging experience.

## Features

- User authentication (registration, login, logout)
- Create, read, update, and delete (CRUD) operations for blog posts
- Commenting system
- Blade templating for views
- Dependency injection using PHP-DI
- PSR-7 compliant HTTP message interfaces

## Installation

1. **Install dependencies:**
    ```sh
    composer install
    ```

2. **Set up environment variables:**
    Copy the `.env.example` file to `.env` and update the database configuration:
    ```sh
    cp .env.example .env
    ```

3. **Run migrations:**
    Set up your database and run migrations to create the necessary tables:
    ```sh
    php migrate.php
    ```

4. **Start the development server:**
    ```sh
    composer start
    ```

    Access the application at `http://localhost:8000`.

## Usage

### Authentication
- Visit `/register` to create a new account.
- Visit `/login` to log in with your credentials.
- Visit `/logout` to log out of your account.

### Managing Posts
- Visit `/posts/create` to create a new post.
- Visit `/posts/{id}/edit` to edit an existing post.
- Visit `/posts/{id}` to view a specific post.
- Use the delete button on the post page to delete a post.

### Managing Comments
- Add comments on individual post pages.
- Edit or delete comments if you are the author.

## Project Structure

```sh
.
├── app
│   ├── Controllers
│   ├── Models
│   ├── Services
│   └── helpers.php
├── public
│   ├── index.php
│   └── css
│       └── style.css
├── resources
│   └── views
├── vendor
├── .env.example
├── composer.json
├── migrate.php
└── README.md
```

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any enhancements, bug fixes, or new features.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

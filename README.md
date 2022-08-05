<div id="top"></div>

<br />
<div align="center">

  <h3 align="center">Football Team Management</h3>

  <p align="center">
    <a href="https://football-team-management.spaceart.tech">View Demo</a>
    ·
    <a href="https://github.com/yoviealfaguistuta/backend-football-team-management/issues">Report Bug</a>
    ·
    <a href="https://github.com/yoviealfaguistuta/backend-football-team-management/issues">Request Feature</a>
  </p>
</div>



### Built With

This section should list any major frameworks/libraries used to bootstrap your project. Leave any add-ons/plugins for the acknowledgements section. Here are a few examples.

* ![Laravel](https://img.shields.io/badge/Laravel-0D1117?style=flat&logo=laravel)&nbsp;
* ![PostgreSQL](https://img.shields.io/badge/-PostgreSQL-0D1117?style=flat&logo=postgresql)&nbsp;

<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these simple example steps

### Prerequisites

To run this, you need to install all of them in your machine:
- PHP
- Postgres
- Composer

### Installation 

If you already have all the prerequisites you can follow this step:

1. Clone the repository
 ```sh
 git clone https://github.com/yoviealfaguistuta/backend-football-team-management.git
 ```
2. Environment
  ```sh
  Rename .env.example into .env
  ```
  
3. Connect to Database
  ```sh
  Scroll down until you find "# MODIFY HERE" in .env, modify BASE_URL and connection with your local database setup 
  ```

4. Install Package
  ```sh
  composer install
  ```

5. Generate Key
  ```sh
  php artisan:key generate
  ```

6. Generate Key
  ```sh
  php artisan migrate:fresh --seed
  ```
<!-- USAGE EXAMPLES -->
## Running

You can run this app by doing this:
  ```sh
  php artisan serve
  ```

Open browser and go to:
  ```sh
  http://127.0.0.1:8000
  ```
<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<!-- CONTACT -->
## Contact

Yovie Alfa Guistuta - [@yoviealfa](https://www.instagram.com/yoviealfa/) - yoviealfaguistuta@gmail.com

Project Link: [https://github.com/yoviealfaguistuta/backend-football-team-management](https://github.com/yoviealfaguistuta/backend-football-team-management)

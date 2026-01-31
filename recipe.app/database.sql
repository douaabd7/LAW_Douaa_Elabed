DROP DATABASE IF EXISTS recipe_app;
CREATE DATABASE recipe_app;
USE recipe_app;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('chef','visitor') NOT NULL
);

CREATE TABLE recipes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE ingredients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  recipe_id INT,
  FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE
);

CREATE TABLE comments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  content TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  user_id INT,
  recipe_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE
);


INSERT INTO users (name,email,password,role) VALUES
('Chef Test','chef@test.com','$2y$10$e0NRxEaLxLz8jY5vZzvWuO2zPIYp6T/NXUMUOmz4Zf1Y3FOQkXj2S','chef'),
('Visitor Test','visitor@test.com','$2y$10$1kHW1hbFAhF8gK0X6b1m1uU0cM6qvQIQmJvABXn5J0ErtP5kH/TW','visitor');

INSERT INTO recipes (title,description,user_id) VALUES
('Pasta','Delicious pasta recipe',1),
('Salad','Healthy green salad',1);

INSERT INTO ingredients (name,recipe_id) VALUES
('Tomato',1),
('Pasta',1),
('Lettuce',2),
('Cucumber',2);

INSERT INTO comments (content,user_id,recipe_id) VALUES
('Great recipe!',2,1),
('I loved it!',2,2);

CREATE TABLE admin (
  id INT(11) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  UNIQUE KEY (id)
);

CREATE TABLE user (
  id INT(11) NOT NULL,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL,
  city VARCHAR(255) NOT NULL,
  state VARCHAR(255) NOT NULL,
  zip INT(11) NOT NULL,
  card BIGINT(16) NOT NULL,
  exp VARCHAR(5) NOT NULL,
  cvv INT(3) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (email)
);


CREATE TABLE IF NOT EXISTS products (
  id INT(11) NOT NULL,
  product_name VARCHAR(255) NOT NULL,
  product_price DECIMAL(10, 2) NOT NULL,
  product_description TEXT NOT NULL,
  product_category VARCHAR(50) NOT NULL,
  product_image VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE orders (
  order_id INT(11) NOT NULL,
  user_id INT(11) NOT NULL,
  product_id INT(11) NOT NULL,
  quantity INT(11) NOT NULL,
  email VARCHAR(255) NOT NULL,
  order_date DATETIME NOT NULL
);

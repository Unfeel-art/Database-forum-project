CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Moderators (
    user_id INT PRIMARY KEY,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

CREATE TABLE RegularUsers (
    user_id INT PRIMARY KEY,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

CREATE TABLE Posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    content_body TEXT NOT NULL,
    user_id INT NOT NULL,
    creation_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

CREATE TABLE Threads (
    post_id INT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    FOREIGN KEY (post_id) REFERENCES Posts(post_id) ON DELETE CASCADE
);

CREATE TABLE Replies (
    post_id INT PRIMARY KEY,
    reply_post_id INT NOT NULL, 
    FOREIGN KEY (post_id) REFERENCES Posts(post_id) ON DELETE CASCADE,
    FOREIGN KEY (reply_post_id) REFERENCES Posts(post_id) ON DELETE CASCADE
);

CREATE TABLE Categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);

CREATE TABLE Actions (
    action_id INT AUTO_INCREMENT PRIMARY KEY,
    action_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

CREATE TABLE Reactions (
    action_id INT PRIMARY KEY,
    reaction_type ENUM('up','down') NOT NULL,
    FOREIGN KEY (action_id) REFERENCES Actions(action_id) ON DELETE CASCADE
);

CREATE TABLE Reports (
    action_id INT PRIMARY KEY,
    report_reason TEXT NOT NULL,
    FOREIGN KEY (action_id) REFERENCES Actions(action_id) ON DELETE CASCADE
);

CREATE TABLE Contains (
    category_id INT NOT NULL,
    thread_post_id INT NOT NULL,
    PRIMARY KEY (category_id, thread_post_id),
    FOREIGN KEY (category_id) REFERENCES Categories(category_id) ON DELETE CASCADE,
    FOREIGN KEY (thread_post_id) REFERENCES Threads(post_id) ON DELETE CASCADE
);

CREATE TABLE Targets (
    action_id INT PRIMARY KEY,
    post_id INT NOT NULL,
    FOREIGN KEY (action_id) REFERENCES Actions(action_id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES Posts(post_id) ON DELETE CASCADE
);
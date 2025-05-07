-- Drop the redundant photo column
ALTER TABLE user DROP COLUMN photo;

-- Keep profile_photo as the main photo column
-- Keep role and status columns as they are important for user management

-- Update the user table structure
ALTER TABLE user
    MODIFY COLUMN user_id int(11) NOT NULL AUTO_INCREMENT,
    MODIFY COLUMN username varchar(50) NOT NULL,
    MODIFY COLUMN first_name varchar(50) NOT NULL,
    MODIFY COLUMN last_name varchar(50) NOT NULL,
    MODIFY COLUMN email varchar(100) NOT NULL,
    MODIFY COLUMN password varchar(255) NOT NULL,
    MODIFY COLUMN phone varchar(20) DEFAULT NULL,
    MODIFY COLUMN dob date DEFAULT NULL,
    MODIFY COLUMN role enum('user','admin') NOT NULL DEFAULT 'user',
    MODIFY COLUMN status enum('active','inactive') NOT NULL DEFAULT 'active',
    MODIFY COLUMN profile_photo varchar(255) DEFAULT NULL,
    MODIFY COLUMN created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    MODIFY COLUMN updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Add indexes for better performance
ALTER TABLE user
    ADD INDEX idx_username (username),
    ADD INDEX idx_email (email),
    ADD INDEX idx_role (role),
    ADD INDEX idx_status (status);

-- Create user_activity table if it doesn't exist
CREATE TABLE IF NOT EXISTS user_activity (
    activity_id int(11) NOT NULL AUTO_INCREMENT,
    user_id int(11) NOT NULL,
    activity_type varchar(50) NOT NULL,
    activity_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    description text,
    PRIMARY KEY (activity_id),
    FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add index for user_activity
ALTER TABLE user_activity
    ADD INDEX idx_user_activity (user_id, activity_date); 
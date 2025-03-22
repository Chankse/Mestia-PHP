-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS Mestia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the newly created or existing database
USE Mestia;

-- Create "ReferralSource" table to store how users found the service
CREATE TABLE IF NOT EXISTS ReferralSource (
    id INT AUTO_INCREMENT PRIMARY KEY,
    source VARCHAR(255) NOT NULL UNIQUE
);

-- ReferralSource Populate
INSERT IGNORE INTO ReferralSource (source) VALUES 
('Friends'),
('Search Engine'),
('Advertisement'),
('Other');

-- Create "Contacts"
CREATE TABLE IF NOT EXISTS Contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    referral_source_id INT,
    message TEXT(1000),
    FOREIGN KEY (referral_source_id) REFERENCES ReferralSource(id) ON DELETE SET NULL
);
-- gallery
CREATE TABLE gallery (
    id SERIAL PRIMARY KEY,
    path TEXT NOT NULL,
    alt_text TEXT NOT NULL,
    name TEXT NOT NULL
);
-- gallery Populate
INSERT INTO gallery (path, alt_text, name) VALUES
('/Assets/Gallery/Timeless Ushguli.webp', 'Wide shot of Ushguli village with sunny mountain in the background', 'Timeless Ushguli'),
('/Assets/Gallery/Ushba’s Watchful Presence.webp', 'Triangular cabin house framed by pine trees, watched over by Ushba mountain in the background', 'Ushba’s Watchful Presence'),
('/Assets/Gallery/Riding High in Mestia.webp', 'Wide shot of cable cars in the summer day with mountains in the background', 'Riding High in Mestia'),
('/Assets/Gallery/Guardian of Traditions.webp', 'BW photo of local villager man sitting in front of stone house, wearing traditional Svani hat', 'Guardian of Traditions'),
('/Assets/Gallery/Snowy Journey Unfolds.webp', 'Winding footprints on the snow with mountains in the background', 'Snowy Journey Unfolds'),
('/Assets/Gallery/Gliding Over White Peaks.webp', 'Image of the shadows of Cable Cars on the snowy skiing trail', 'Gliding Over White Peaks'),
('/Assets/Gallery/Path to the Past.webp', 'Villager walking on a mountain trail towards village of Ushguli', 'Path to Past'),
('/Assets/Gallery/Pride of the Caucasus.webp', 'Closeup shot of top of Ushba mountain with clear blue sky in the background', 'Pride of the Caucasus'),
('/Assets/Gallery/Views from Above.webp', 'Shot of Mestia taken from on top of mountain', 'Views from Above');

-- to rever run 
-- drop database if exists Mestia;

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS Mestia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the newly created or existing database
USE Mestia;

-- Create "Contacts" table without referral_source_id
CREATE TABLE IF NOT EXISTS Contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    message TEXT(1000)
);

-- Create "gallery" table
CREATE TABLE gallery (
    id SERIAL PRIMARY KEY,
    path TEXT NOT NULL,
    alt_text TEXT NOT NULL,
    name TEXT NOT NULL
);

-- Populate the gallery table
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

-- Create "tours" table
CREATE TABLE IF NOT EXISTS tours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    title VARCHAR(255) NOT NULL,
    location VARCHAR(100),
    description TEXT,
    season VARCHAR(100),
    duration VARCHAR(50),
    difficulty VARCHAR(50),
    distance VARCHAR(20),
    image_path TEXT,
    alt_text TEXT,
    is_popular BOOLEAN DEFAULT FALSE
);

-- Populate the tours table
INSERT INTO tours (name, title, location, description, season, duration, difficulty, distance, image_path, alt_text, is_popular) VALUES
-- 🌟 Popular tours (from popular-tours-section)
('Lakumura Lake', 'Lakumurash Toba - Lakumura Lake', 'Khaishi, Svaneti', 'Lakumura Lake (Or Lakumurash Toba in Svanian language) is one of the most remarkable landmarks of Samegrelo-Zemo Svaneti. This vast lake, surrounded by enormous cliffs, is located at an altitude of 2,584 meters above sea level. The adventurous journey to reach it starts from the Svanetian village of Khaiši.', 'July and August', '7 Days', 'Extremely Hard', '20 Km', '/Assets/Tours/Lakumurash Toba Lake.webp', 'Wide shot of Toba Lake surrounded by Mountains with text saying Lakumurash Toba', TRUE),
('Hatsvali Ski Resort', 'Ski Resort Hatsvali', 'Mestia, Svaneti', 'Hatsvali Ski Resort is located in Svaneti, 8 km from Mestia, with a maximum altitude of 2,348 meters and a minimum of 1,868 meters. The resort is easily accessible from Mestia via an asphalt road or a 6-seat cable car. In summer, the cable car doesn\'t operate, so you\'ll need to drive. In winter, the road is cleared, and any vehicle prepared for snow can reach the resort. Taxis are also available from the center of Mestia.', 'Winter', '3 Days', '', '', '/Assets/Tours/Hatsvali Ski Resort.webp', 'Shot of Cable cars on top of Hatsvali Ski Trail', TRUE),
('Big and Smal Okrostskhali Lakes', 'Big and Small Okrostskhali Lake Hike', 'Mestia, Svaneti', 'The Okrostskhali Lakes, located in Upper Svaneti on the border of Svaneti and Abkhazia, are known for their stunning beauty and challenging hiking routes. The larger lake has a turquoise color, while the smaller one is darker. To reach the lakes, drive to the village of Lukh and then hike 25 km, or take a 4x4 vehicle for part of the journey. The trail passes through forests, grasslands, and rivers, with a tough final climb. The hike includes crossing two passes, including one at 2900m, offering breathtaking views of the landscape and Abkhazia.', 'Spring or Summer', '1 Day', 'Easy', '3 Km', '/Assets/Tours/Okrostskhali Lake.webp', 'Shot of Okrostskhali Lake in the middle of mountain peaks', TRUE),

-- 🎒 Regular tours
('Tobavarchkhili', 'Tobavarchkhili - Silver Lake', 'Tsalenjikha', 'Tobavarchkhili (Silver Lake), also known as Big Lake, is located in Samegrelo-Zemo Svaneti, in the Chalenjikhi Municipality, on the Egrisi Ridge at an altitude of 2,650 meters above sea level. It is the largest lake on the Egrisi Ridge. The Magana River, which originates from Tobavarchkhili Lake, forms a beautiful canyon and waterfall nearby. Close to Tobavarchkhili Lake are the Greatgali Lake, Kalalishi Lake, and Tsakhatsqarishi Lake.', 'August and September', '3 Days', 'Hard', '50 Km', '/Assets/Tours/Tobavarchkhili Lake.webp', 'Shot of Tobavarchkhili Lake with text saying Riding high in Mestia', FALSE),
('Ushba Waterfall', 'Ushba Waterfall Hike', 'Mestia, Svaneti', 'Ushba Waterfall (Shdugra), the tallest waterfall in Georgia, is located in Svaneti near the village of Mazeri. You can visit it from both the bottom and the top, with the summit offering a view of the Ushba Glacier and a stunning panorama of Svaneti. The hike to the base is 3 km one way, with an additional 3 km to reach the top. The final part of the trail is moderate in difficulty, involving a river crossing, but the breathtaking scenery makes it well worth the effort.', 'Spring or Summer', '1 Day', 'Easy', '3 Km', '/Assets/Tours/Ushba Waterfall Hike.webp', 'Shot of Ushba Mountains with Ushba Waterfall in the middle', FALSE),
('Tower of Lovers', 'Visit to Legendary Tower of Lovers', 'Mestia, Svaneti', 'Tower of Love is a separate tower belonging to the Kurnidze family, located in the Kalish village of Mestia Municipality in Svaneti. The tower is built on a cliff on the right bank of the Enguri River. Due to the popular love stories associated with it, the tower is commonly referred to as the "Tower of Love."', 'Any time', '1 Hour', '', '', '/Assets/Tours/Tower of Lovers.webp', 'Shot of Tower of Lovers covered in snow with text saying Riding high in Mestia', FALSE);

-- to revert run 
-- drop database if exists Mestia;

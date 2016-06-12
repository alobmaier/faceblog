CREATE SCHEMA IF NOT EXISTS faceblogdb;
USE faceblogdb;
DROP TABLE IF EXISTS blog_like;
DROP TABLE IF EXISTS blog_post;
DROP TABLE IF EXISTS blog_member;
CREATE TABLE blog_member (
		id INT PRIMARY KEY AUTO_INCREMENT
		,userName VARCHAR(255) UNIQUE NOT NULL
		,displayName VARCHAR(255) NOT NULL
		,passwordHash VARCHAR(255) NOT NULL
		,startTime DATETIME NOT NULL
		);

CREATE TABLE blog_post (
	id INT AUTO_INCREMENT PRIMARY KEY
	,userid INT NOT NULL
	,title VARCHAR(255) NOT NULL
	,content VARCHAR(255) NOT NULL
	,createdAt DATETIME NOT NULL
	,updatedAt DATETIME NOT NULL
	,FOREIGN KEY (userid) REFERENCES blog_member(id)
	);

CREATE TABLE blog_like (
	postId INT
	,userId INT
	,FOREIGN KEY (postId) REFERENCES blog_post(id) ON DELETE CASCADE
	,FOREIGN KEY (userId) REFERENCES blog_member(id) ON DELETE CASCADE
	,PRIMARY KEY (
		postId
		,userId
		)
	);

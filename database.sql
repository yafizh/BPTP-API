SET @today_date = CURRENT_DATE(), @today_date_time = CURRENT_TIMESTAMP();

CREATE TABLE book_category_table (
    book_category_id INT NOT NULL AUTO_INCREMENT,
    book_category VARCHAR(255),
    PRIMARY KEY (book_category_id)
);

CREATE TABLE book_language_table (
    book_language_id INT NOT NULL AUTO_INCREMENT,
    book_language VARCHAR(255),
    PRIMARY KEY (book_language_id)
);

CREATE TABLE book_table (
	book_id INT NOT NULL AUTO_INCREMENT,
	book_category_id INT NOT NULL,
	book_language_id INT NOT NULL,
	book_title VARCHAR(255) NOT NULL,
	book_sub_title VARCHAR(255) NULL,
	book_classification_number VARCHAR(255) NULL, -- Tipe Data Masih Belum Tepat
    book_isbn_number VARCHAR(255) NULL, -- Tipe Data Masih Belum Tepat
    book_publisher VARCHAR(255) NULL,
    book_publish_place VARCHAR(255) NULL,
    book_publish_date DATE NULL,
    book_author VARCHAR(255) NULL,
    book_illustration TINYINT(1) NOT NULL,
    book_width SMALLINT NULL,
    book_height SMALLINT NULL,
    book_page SMALLINT,
    book_stock INT NULL,
    book_cover_uri VARCHAR(30) NULL,
    book_file_uri VARCHAR(30) NULL,
    book_description TEXT,
	PRIMARY KEY (book_id),
    FOREIGN KEY (book_category_id) REFERENCES book_category_table (book_category_id),
    FOREIGN KEY (book_language_id) REFERENCES book_language_table (book_language_id)
);

CREATE TABLE guest_table (
    guest_id INT NOT NULL AUTO_INCREMENT,
    book_category_id INT NOT NULL,
    guest_full_name VARCHAR(255) NOT NULL,
    guest_come_date_time DATETIME NOT NULL,
    guest_come_reason TEXT NULL,
    guest_profession TEXT NOT NULL,
    PRIMARY KEY (guest_id),
    FOREIGN KEY (book_category_id) REFERENCES book_category_table (book_category_id)
);

-- Dummies Data
INSERT INTO 
    book_category_table (book_category) 
VALUES 
    ('UMUM'),
    ('FILSAFAT'),
    ('ILMU PENGETAHUAN MASYARAKAT'),
    ('BAHASA'),
    ('MATEMATIKA'),
    ('ILMU PENGETAHUAN TERAPAN'),
    ('KESENIAN'),
    ('LITERATUR'),
    ('SEJARAH');

INSERT INTO 
    book_language_table (book_language) 
VALUES 
    ('BAHASA INDONESIA'),
    ('INGGRIS');

INSERT INTO 
    book_table (
        book_category_id, 
        book_language_id, 
        book_title, 
        book_sub_title, 
        book_classification_number, 
        book_isbn_number, 
        book_publisher,
        book_publish_place,
        book_publish_date,
        book_author,
        book_illustration,
        book_width,
        book_height,
        book_page,
        book_stock,
        book_cover_uri,
        book_file_uri,
        book_description
    ) 
VALUES 
    (1,1,'Sapiens','Riwayat Singkat Umat Manusia', '555', '555', 'PT Gramedia', 'Martapura', '2000-05-10', 'Yuval Noah Harari', 1, 10, 5, 100, 2, 'sapiens.jpg', null, 'Menceritakan tentang peradaban singkat manusia');
    
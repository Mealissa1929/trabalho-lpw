CREATE TABLE copas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ano INT,
    sede VARCHAR(50),
    campeao VARCHAR(50),
    confederacao VARCHAR(50),
    imagem VARCHAR(100),
    quantidade INT
);

CREATE TABLE copas (
    id SERIAL PRIMARY KEY,
    ano INTEGER,
    sede VARCHAR(50),
    campeao VARCHAR(50),
    confederacao VARCHAR(50),
    imagem VARCHAR(100),
    quantidade INTEGER
);
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(15) NOT NULL,
    data_nasc DATETIME NOT NULL,
    telefone VARCHAR(15),
    ativo TINYINT NOT NULL
);

CREATE TABLE pedido_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    data DATETIME NOT NULL,
    cliente_id INT NOT NULL,
    pedido_status_id INT NOT NULL,
    ativo TINYINT NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (pedido_status_id) REFERENCES pedido_status(id)
);

CREATE TABLE pedidos_imagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    capa VARCHAR(255) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id)
);
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    endereco VARCHAR(150),
    cnh VARCHAR(20),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE veiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    ano INT NOT NULL,
    placa VARCHAR(10) UNIQUE NOT NULL,
    cor VARCHAR(30),
    valor_diaria DECIMAL(10,2) NOT NULL,
    status ENUM('Disponível','Reservado','Alugado') DEFAULT 'Disponível'
);

CREATE TABLE pagamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    valor DECIMAL(10,2) NOT NULL,
    forma_pagamento VARCHAR(30),
    status ENUM('Pendente','Pago') DEFAULT 'Pendente',
    data_pagamento DATETIME
);

CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    veiculo_id INT NOT NULL,
    pagamento_id INT,
    data_retirada DATE NOT NULL,
    data_devolucao DATE NOT NULL,
    dias INT NOT NULL,
    status ENUM('Pendente','Confirmada','Cancelada') DEFAULT 'Pendente',

    CONSTRAINT fk_cliente
        FOREIGN KEY(cliente_id)
        REFERENCES clientes(id),

    CONSTRAINT fk_veiculo
        FOREIGN KEY(veiculo_id)
        REFERENCES veiculos(id),

    CONSTRAINT fk_pagamento
        FOREIGN KEY(pagamento_id)
        REFERENCES pagamentos(id)
);
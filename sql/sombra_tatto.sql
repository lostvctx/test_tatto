CREATE TABLE usuario (
    idUsuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    login VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nivel ENUM('ADMIN', 'TATUADOR') DEFAULT 'TATUADOR'
);
 
CREATE TABLE cliente (
    idCliente INT PRIMARY KEY AUTO_INCREMENT,
    nomeCliente VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20),
    dataNascimento DATE
);
 
CREATE TABLE tatuador (
    idTatuador INT PRIMARY KEY AUTO_INCREMENT,
    idUsuario INT,
    nome VARCHAR(100) NOT NULL,
    bio TEXT,
    anosExperiencia INT,
    CONSTRAINT fk_tatuador_usuario
        FOREIGN KEY (idUsuario)
        REFERENCES usuario(idUsuario)
);
 
CREATE TABLE portfolio (
    idPortfolio INT PRIMARY KEY AUTO_INCREMENT,
    idTatuador INT NOT NULL,
    titulo VARCHAR(150),
    descricao TEXT,
    imagemVideo VARCHAR(255),
    dataPublicacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_portfolio_tatuador
        FOREIGN KEY (idTatuador)
        REFERENCES tatuador(idTatuador)
);
 
CREATE TABLE agendamento (
    idAgendamento INT PRIMARY KEY AUTO_INCREMENT,
    idCliente INT NOT NULL,
    idTatuador INT NOT NULL,
    dataAgendada DATE NOT NULL,
    horaAgendada TIME NOT NULL,
    descricao TEXT,
    tipoTatuagem VARCHAR(100),
    status ENUM('PENDENTE', 'CONFIRMADO', 'CONCLUIDO', 'CANCELADO') DEFAULT 'PENDENTE',
    valorEstimado DECIMAL(10,2),
    valorFinal DECIMAL(10,2),
    dataOrcamento DATE,
    observacoes TEXT,
    CONSTRAINT fk_agendamento_cliente
        FOREIGN KEY (idCliente)
        REFERENCES cliente(idCliente),
    CONSTRAINT fk_agendamento_tatuador
        FOREIGN KEY (idTatuador)
        REFERENCES tatuador(idTatuador)
);
 
CREATE TABLE sessao (
    idSessao INT PRIMARY KEY AUTO_INCREMENT,
    idAgendamento INT NOT NULL,
    dataSessao DATE NOT NULL,
    qtdSessao INT COMMENT 'Número da sessão, ex: 1, 2, 3...',
    CONSTRAINT fk_sessao_agendamento
        FOREIGN KEY (idAgendamento)
        REFERENCES agendamento(idAgendamento)
        ON DELETE CASCADE
);
 
CREATE TABLE avaliacao (
    idAvaliacao INT PRIMARY KEY AUTO_INCREMENT,
    idAgendamento INT NOT NULL,
    idCliente INT NOT NULL,
    nota INT CHECK (nota BETWEEN 1 AND 5),
    comentario TEXT,
    dataAvaliacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_avaliacao_agendamento
        FOREIGN KEY (idAgendamento)
        REFERENCES agendamento(idAgendamento),
    CONSTRAINT fk_avaliacao_cliente
        FOREIGN KEY (idCliente)
        REFERENCES cliente(idCliente)
);
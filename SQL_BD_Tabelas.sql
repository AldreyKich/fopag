/* ESTE BANCO DE DADOS ESTA SENDO UTILIZADO NO PROTOTIPO DE FOLHA DE PAGAMENTO no MYSQL: */
/* CRIAR e UTILIZAR o BANCO DE DADOS 'SISTEMA_FP' no MYSQL: */

CREATE DATABASE IF NOT EXISTS sistema_fp;
USE sistema_fp;

/* SCRIPT BIBLIOTECA criado através  do Modelo Lógico: */

CREATE TABLE uf (
	Id_UF INTEGER AUTO_INCREMENT PRIMARY KEY,
    Nm_UF CHAR(2),
    Nm_Estado VARCHAR(50)
);

CREATE TABLE pessoa (
    Id_Pessoa INTEGER AUTO_INCREMENT PRIMARY KEY,
    Nm_Pessoa VARCHAR(100) NOT NULL CHECK (TRIM(Nm_Pessoa) <> ''),
    Nr_Identidade VARCHAR(20),
    Nr_CPF CHAR(11) NOT NULL CHECK (TRIM(Nr_CPF) <> ''),
    Sexo CHAR(1),
    Dt_Nascimento DATE,
    Ds_Endereco VARCHAR(150),
    Ds_Bairro VARCHAR(50),
    Nr_CEP CHAR(8),
    Nm_Cidade VARCHAR(100),
    Id_UF INTEGER,
    Nr_Telefone VARCHAR(50),
    Nm_Email VARCHAR(100),
    Foto  LONGBLOB,
    UNIQUE (Id_Pessoa, Nr_CPF),
    CONSTRAINT fk_uf FOREIGN KEY (Id_UF) REFERENCES UF(Id_UF)
);

CREATE TABLE usuario (
    Id_Usuario INT AUTO_INCREMENT PRIMARY KEY,
    Login VARCHAR(50) NOT NULL UNIQUE,
    Senha VARCHAR(255) NOT NULL,
    Id_Pessoa INT NOT NULL,
    FOREIGN KEY (Id_Pessoa) REFERENCES Pessoa(Id_Pessoa)
);


CREATE TABLE funcionario (
    Id_Funcionario INTEGER AUTO_INCREMENT PRIMARY KEY,
    Dt_Admissao DATE,
    Id_Cargo INTEGER,
    Nr_CargaHoraria CHAR(3),
	id_Pessoa INTEGER
);

ALTER TABLE funcionario ADD CONSTRAINT FK_Funcionario_id_Pessoa
    FOREIGN KEY (id_Pessoa)
    REFERENCES Pessoa (Id_Pessoa);

CREATE TABLE dependente (
    Id_Dependentes INT AUTO_INCREMENT PRIMARY KEY,
    Id_Funcionario INT NOT NULL,
    Id_Pessoa INT NOT NULL,
    Tp_Dependencia VARCHAR(2) NOT NULL,
    FOREIGN KEY (Id_Funcionario) REFERENCES funcionario(Id_Funcionario),
    FOREIGN KEY (Id_Pessoa) REFERENCES pessoa(Id_Pessoa)
);

CREATE TABLE cbo (
    Id_CBO INT AUTO_INCREMENT PRIMARY KEY,
    Nr_CBO VARCHAR(6),
    Ds_CBO VARCHAR(200)
);

CREATE TABLE cargo (
    Id_Cargo INT AUTO_INCREMENT PRIMARY KEY,
    Nm_Cargo VARCHAR(100) NOT NULL CHECK (TRIM(Nm_Cargo) <> ''),
    Nr_CBO INT,
    CONSTRAINT fk_cbo FOREIGN KEY (NR_CBO) REFERENCES cbo(Id_cbo)
);

CREATE TABLE Evento (
    Id_Eventos INT AUTO_INCREMENT PRIMARY KEY,
    Nm_Evento VARCHAR(100) NOT NULL,
    Tp_Evento CHAR(1) NOT NULL CHECK (Tp_Evento IN ('P', 'D')),
    Tp_Valor CHAR(1) NOT NULL CHECK (Tp_Valor IN ('V', 'F', 'I', 'R', 'H', 'T'))
);

ALTER TABLE evento DROP CHECK evento_chk_2;
ALTER TABLE evento
ADD CONSTRAINT evento_chk_2 CHECK (Tp_Valor IN ('V', 'F', 'I', 'R', 'H', 'T'));

CREATE TABLE FaixaPercentual (
    Id_Faixa INT AUTO_INCREMENT PRIMARY KEY,
    Id_Evento INT NOT NULL,
    Vl_De DECIMAL(10,2) NOT NULL,
    Vl_Ate DECIMAL(10,2) NOT NULL,
    Percentual DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (Id_Evento) REFERENCES Evento(Id_Eventos)
);

CREATE TABLE EventoReferencia (
  Id_Evento_Alvo INT,
  Id_Evento_Referencia INT,
  PRIMARY KEY (Id_Evento_Alvo, Id_Evento_Referencia),
  FOREIGN KEY (Id_Evento_Alvo) REFERENCES Evento(Id_Eventos),
  FOREIGN KEY (Id_Evento_Referencia) REFERENCES Evento(Id_Eventos)
);


CREATE TABLE inss (
    Id_INSS INT AUTO_INCREMENT PRIMARY KEY,
    Vl_Salario_De DECIMAL(10,2) NOT NULL,
    Vl_Salario_Ate DECIMAL(10,2) NOT NULL,
    Aliquota DECIMAL(5,2) NOT NULL, 
    Parcela_Deduzir DECIMAL(10,2) DEFAULT 0.00
);

ALTER TABLE inss
ADD COLUMN Teto_Contribuicao DECIMAL(10, 2);

CREATE TABLE EventoIncidenciaINSS (
    Id_EventoDesconto INT,
    Id_EventoProvento INT,
    PRIMARY KEY (Id_EventoDesconto, Id_EventoProvento),
    FOREIGN KEY (Id_EventoDesconto) REFERENCES Evento(Id_Eventos),
    FOREIGN KEY (Id_EventoProvento) REFERENCES Evento(Id_Eventos)
);


CREATE TABLE irrf (
    Id_IRRF INT AUTO_INCREMENT PRIMARY KEY,
    Vl_Renda_De DECIMAL(10,2) NOT NULL,
    Vl_Renda_Ate DECIMAL(10,2) NOT NULL,
    Aliquota DECIMAL(5,2) NOT NULL,
    Parcela_Deduzir DECIMAL(10,2) NOT NULL
);

CREATE TABLE irrf_dependente (
    Id INT PRIMARY KEY,
    Vl_Deduzir_Por_Dependentes DECIMAL(10,2) NOT NULL
);

INSERT INTO irrf_dependente (Id, Vl_Deduzir_Por_Dependentes)
VALUES (1, 189.59);

CREATE TABLE EventoIncidenciaIRRF (
    Id_EventoDesconto INT,
    Id_EventoProvento INT,
    PRIMARY KEY (Id_EventoDesconto, Id_EventoProvento),
    FOREIGN KEY (Id_EventoDesconto) REFERENCES Evento(Id_Eventos),
    FOREIGN KEY (Id_EventoProvento) REFERENCES Evento(Id_Eventos)
);

CREATE TABLE eventoincidenciahora (
	Id_EventoHora INT,
	Id_EventoBase INT,
	PRIMARY KEY (Id_EventoHora, Id_EventoBase),
	FOREIGN KEY (Id_EventoBase) REFERENCES evento (Id_Eventos),
	FOREIGN KEY (Id_EventoHora) REFERENCES evento (Id_Eventos)
	);
    
    CREATE TABLE Folha_Mensal (
    id_FolhaMensal INT AUTO_INCREMENT,
    Id_Mes TINYINT NOT NULL,
    Id_Ano SMALLINT NOT NULL,
    PRIMARY KEY (id_FolhaMensal, Id_Mes, Id_Ano)
);

ALTER TABLE `sistema_fp`.`folha_mensal` 
CHANGE COLUMN `Id_Mes` `Id_Mes` TINYINT NOT NULL ;

CREATE TABLE Evento_Funcionario (
    Id_Funcionario INTEGER,
    Id_Evento INTEGER,
	Vl_Evento REAL NULL	
);

CREATE TABLE Evento_Funcionario_Variavel (
    id_FolhaMensal INT,
    Id_Funcionario INT,
    Id_Evento INT,
    Vl_Evento REAL,
    PRIMARY KEY (id_FolhaMensal, Id_Funcionario, Id_Evento),
    FOREIGN KEY (id_FolhaMensal) REFERENCES Folha_Mensal(id_FolhaMensal),
    FOREIGN KEY (Id_Funcionario) REFERENCES funcionario(Id_Funcionario),
    FOREIGN KEY (Id_Evento) REFERENCES evento(Id_Eventos)
);

CREATE TABLE FichaFinanceira (
    id_FichaFinanceira INT AUTO_INCREMENT PRIMARY KEY,
    Id_Mes INTEGER,
    Id_Ano INTEGER,
    Id_Funcionario integer,
    Id_Evento INTEGER,
    Vl_Evento REAL,
    Total_Evento_Soma REAL,
    Total_Evento_Diminui REAL,
    Total_Liquido REAL
);

ALTER TABLE FichaFinanceira ADD CONSTRAINT FK_FichaFinanceira_id_Funcionario
    FOREIGN KEY (Id_Funcionario)
    REFERENCES Funcionario (Id_Funcionario);
    
    
CREATE TABLE fichafinanceiramensal (
    id_FichaFinanceiramensal INT AUTO_INCREMENT PRIMARY KEY,
    Id_Mes INT NOT NULL,
    Id_Ano INT NOT NULL,
    Id_Funcionario INT NOT NULL,
    Id_Evento INT NOT NULL,
    Vl_Evento DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (Id_Funcionario) REFERENCES funcionario(Id_Funcionario),
    FOREIGN KEY (Id_Evento) REFERENCES evento(Id_Eventos)
);


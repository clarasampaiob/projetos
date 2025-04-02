-- Para registros que não constavam na tabela de cadastro de operadoras, eles foram inseridos com os valores como null e a data de registro como 01/01/2000 devido a ausência dessa informação

CREATE DATABASE IF NOT EXISTS `intuitive` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `intuitive`;

CREATE TABLE operadoras (
    registro_ans VARCHAR(1000),
    cnpj VARCHAR(255),
    razao_social VARCHAR(255),
    nome_fantasia VARCHAR(255),
    modalidade VARCHAR(255),
    logradouro VARCHAR(255),
    numero VARCHAR(255),
    complemento VARCHAR(255),
    bairro VARCHAR(255),
    cidade VARCHAR(255),
    uf VARCHAR(255),
    cep VARCHAR(255),
    ddd VARCHAR(255),
    telefone VARCHAR(255),
    fax VARCHAR(255),
    email VARCHAR(255),
    representante VARCHAR(255),
    cargo_representante VARCHAR(255),
    regiao_comercializacao VARCHAR(50),
    data_registro_ans DATE DEFAULT '2000-01-01'
);

CREATE TABLE demonstrativos_contabeis (
   	id_demonstrativo BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    data_demonstrativo DATE,
    registro_ans VARCHAR(1000) NULL, 
    codigo_conta_contabil VARCHAR(255),
    descricao_conta_contabil VARCHAR(255),
    saldo_inicial NUMERIC(30, 2),
    saldo_final NUMERIC(30, 2)
);


LOAD DATA INFILE 'C:/xampp/mysql/data/csv/RELATORIO.csv'
INTO TABLE operadoras
FIELDS TERMINATED BY ';'
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(registro_ans, cnpj, razao_social, nome_fantasia, modalidade, logradouro, numero, complemento, bairro, cidade, uf, cep, ddd, telefone, fax, email, representante, cargo_representante, regiao_comercializacao, data_registro_ans);


LOAD DATA INFILE 'C:/xampp/mysql/data/csv/1T2023.csv'
IGNORE
INTO TABLE demonstrativos_contabeis
FIELDS TERMINATED BY ';'
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(data_demonstrativo, registro_ans, codigo_conta_contabil, descricao_conta_contabil, @saldo_inicial, @saldo_final)
SET saldo_inicial = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_inicial), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0), saldo_final = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_final), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0);


LOAD DATA INFILE 'C:/xampp/mysql/data/csv/2t2023.csv'
IGNORE
INTO TABLE demonstrativos_contabeis
FIELDS TERMINATED BY ';'
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(data_demonstrativo, registro_ans, codigo_conta_contabil, descricao_conta_contabil, @saldo_inicial, @saldo_final)
SET saldo_inicial = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_inicial), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0), saldo_final = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_final), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0);


LOAD DATA INFILE 'C:/xampp/mysql/data/csv/3T2023.csv'
IGNORE
INTO TABLE demonstrativos_contabeis
FIELDS TERMINATED BY ';'
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(data_demonstrativo, registro_ans, codigo_conta_contabil, descricao_conta_contabil, @saldo_inicial, @saldo_final)
SET saldo_inicial = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_inicial), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0), saldo_final = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_final), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0);


LOAD DATA INFILE 'C:/xampp/mysql/data/csv/4T2023.csv'
IGNORE
INTO TABLE demonstrativos_contabeis
FIELDS TERMINATED BY ';'
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(@data_demonstrativo, registro_ans, codigo_conta_contabil, descricao_conta_contabil, @saldo_inicial, @saldo_final)
SET saldo_inicial = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_inicial), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0), saldo_final = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_final), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0), data_demonstrativo = STR_TO_DATE(@data_demonstrativo, '%d/%m/%Y');


LOAD DATA INFILE 'C:/xampp/mysql/data/csv/1T2024.csv'
IGNORE
INTO TABLE demonstrativos_contabeis
FIELDS TERMINATED BY ';'
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(data_demonstrativo, registro_ans, codigo_conta_contabil, descricao_conta_contabil, @saldo_inicial, @saldo_final)
SET saldo_inicial = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_inicial), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0), saldo_final = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_final), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0);


LOAD DATA INFILE 'C:/xampp/mysql/data/csv/2T2024.csv'
IGNORE
INTO TABLE demonstrativos_contabeis
FIELDS TERMINATED BY ';'
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(data_demonstrativo, registro_ans, codigo_conta_contabil, descricao_conta_contabil, @saldo_inicial, @saldo_final)
SET saldo_inicial = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_inicial), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0), saldo_final = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_final), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0);


LOAD DATA INFILE 'C:/xampp/mysql/data/csv/3T2024.csv'
IGNORE
INTO TABLE demonstrativos_contabeis
FIELDS TERMINATED BY ';'
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(data_demonstrativo, registro_ans, codigo_conta_contabil, descricao_conta_contabil, @saldo_inicial, @saldo_final)
SET saldo_inicial = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_inicial), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0), saldo_final = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_final), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0);


LOAD DATA INFILE 'C:/xampp/mysql/data/csv/4T2024.csv'
IGNORE
INTO TABLE demonstrativos_contabeis
FIELDS TERMINATED BY ';'
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(data_demonstrativo, registro_ans, codigo_conta_contabil, descricao_conta_contabil, @saldo_inicial, @saldo_final)
SET saldo_inicial = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_inicial), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0), saldo_final = COALESCE(CAST(NULLIF(REPLACE(REGEXP_REPLACE(TRIM(@saldo_final), '[^0-9,-]', ''), ',', '.'), '') AS DECIMAL(30, 2)), 0);


-- Verifica os registros_ans que não estão incluídos na tabela de operadoras
SELECT registro_ans
FROM demonstrativos_contabeis dc
WHERE NOT EXISTS (SELECT 1 FROM operadoras o WHERE o.registro_ans = dc.registro_ans)
GROUP BY registro_ans;


-- Insere os valores de registro_ans que estão na tabela de demonstrativos porém não estão na tabela de operadoras
INSERT INTO operadoras (registro_ans)
SELECT DISTINCT dc.registro_ans
FROM demonstrativos_contabeis dc
WHERE NOT EXISTS (SELECT 1 FROM operadoras o WHERE o.registro_ans = dc.registro_ans);


-- Adição de chave primária e chave estrangeira para evitar inconsistencia
ALTER TABLE operadoras ADD PRIMARY KEY (registro_ans);
ALTER TABLE demonstrativos_contabeis ADD CONSTRAINT fk_demonstrativos_operadoras FOREIGN KEY (registro_ans) REFERENCES operadoras (registro_ans);


-- 10 operadoras com maiores despesas no ultimo trismestre
SELECT registro_ans, SUM(saldo_final - saldo_inicial) AS total_gastos FROM demonstrativos_contabeis 
WHERE descricao_conta_contabil LIKE '%ASSISTÊNCIA A SAÚDE MEDICO HOSPITALAR%' 
AND data_demonstrativo BETWEEN '2024-10-01' AND '2024-12-31' 
GROUP BY registro_ans ORDER BY total_gastos ASC LIMIT 10;


-- 10 operadoras com maiores despesas no ultimo ano
SELECT registro_ans, SUM(saldo_final - saldo_inicial) AS total_gastos FROM demonstrativos_contabeis 
WHERE descricao_conta_contabil LIKE '%ASSISTÊNCIA A SAÚDE MEDICO HOSPITALAR%' 
AND data_demonstrativo BETWEEN '2024-01-01' AND '2024-12-31' 
GROUP BY registro_ans ORDER BY total_gastos ASC LIMIT 10;
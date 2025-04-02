from flask import Flask, jsonify
import mysql.connector
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# Configurações do banco de dados MYSQL
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'intuitive'
}

def buscar_operadoras():
    resultados = []
    try:
        conexao = mysql.connector.connect(**db_config)
        cursor = conexao.cursor(dictionary=True)

        consulta = """
            SELECT registro_ans, SUM(saldo_final - saldo_inicial) AS total_lucro 
            FROM demonstrativos_contabeis 
            WHERE descricao_conta_contabil LIKE '%ASSISTÊNCIA A SAÚDE MEDICO HOSPITALAR%' 
            AND data_demonstrativo BETWEEN '2024-01-01' AND '2024-12-31' 
            GROUP BY registro_ans ORDER BY total_lucro DESC LIMIT 20;
        """
        print(consulta)  # Adicionado para depuração
        cursor.execute(consulta)
        resultados = cursor.fetchall()
        print(resultados) # Adicionado para depuração

    except mysql.connector.Error as erro:
        print(f"Erro ao acessar o MySQL: {erro}")
    except Exception as erro:
        print(f"Erro ao executar a consulta: {erro}")
    finally:
        if conexao and conexao.is_connected():
            cursor.close()
            conexao.close()
    return resultados

@app.route('/buscar', methods=['GET'])
def buscar():
    resultados = buscar_operadoras()
    return jsonify(resultados)

if __name__ == '__main__':
    app.run(debug=True, port=5000)
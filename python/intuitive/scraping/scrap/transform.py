import os
import zipfile
import tabula
import pandas as pd

def extrair_e_compactar_tabela(nome_arquivo_pdf, nome_arquivo_zip):
    try:
        # Verificar se o arquivo PDF existe
        if not os.path.exists(nome_arquivo_pdf):
            raise FileNotFoundError(f"Arquivo {nome_arquivo_pdf} não encontrado.")

        # Extrair dados da tabela do PDF
        tables = tabula.read_pdf(nome_arquivo_pdf, pages='all', lattice=True)
        if not tables:
            raise ValueError("Nenhuma tabela encontrada no PDF.")

        # Concatenar todas as tabelas em um único DataFrame
        df = pd.concat(tables, ignore_index=True)

        # Limpar e formatar os dados
        df.columns = df.columns.str.strip()  # Remover espaços extras dos nomes das colunas
        df = df.apply(lambda x: x.str.strip() if x.dtype == "object" else x)  # Remover espaços extras dos dados
        df.replace({r'\r': ' '}, regex=True, inplace=True)  # Substituir quebras de linha por espaços

        # Substituir abreviações e limpar dados
        df.rename(columns={'OD': 'Odontológico', 'AMB': 'Ambulatorial'}, inplace=True)

        # Legenda das colunas
        legendas = {
            'OD': 'Seguimento Odontológica',
            'AMB': 'Seguimento Ambulatorial'
        }

        df.replace(legendas, inplace=True)

        # Salvar dados em CSV na pasta "csv" 
        pasta_csv = "csv"
        os.makedirs(pasta_csv, exist_ok=True) 
        csv_filename = os.path.join(pasta_csv, 'tabela_anexo_i.csv')
        df.to_csv(csv_filename, index=False, sep=';') 

        # Compactar CSV em ZIP na pasta "compactados"
        pasta_compactados = "compactados"
        os.makedirs(pasta_compactados, exist_ok=True)  
        zip_filename = os.path.join(pasta_compactados, nome_arquivo_zip)
        with zipfile.ZipFile(zip_filename, 'w') as zipf:
            zipf.write(csv_filename, os.path.basename(csv_filename))

        print(f"Tabela extraída, salva em CSV e compactada em {zip_filename} com sucesso!")

    except FileNotFoundError as e:
        print(f"Erro: {e}")
    except ValueError as e:
        print(f"Erro: {e}")
    except Exception as e:
        print(f"Ocorreu um erro inesperado: {e}")

# Nome do arquivo PDF
nome_arquivo_pdf = "downloads/Anexo_I_Rol_2021RN_465.2021_RN627L.2024.pdf"

# Nome do arquivo ZIP
nome_arquivo_zip = "Teste_clarasb.zip"

# Executar a função
extrair_e_compactar_tabela(nome_arquivo_pdf, nome_arquivo_zip)
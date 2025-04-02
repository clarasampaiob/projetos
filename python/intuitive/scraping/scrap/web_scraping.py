import requests
from bs4 import BeautifulSoup
import os
import zipfile

# Definir os nomes das pastas como variáveis
PASTA1 = "downloads"
PASTA2 = "compactados"

def baixar_e_compactar_anexos(url):
    try:
        # 1. Acessar o site
        response = requests.get(url)
        response.raise_for_status()  # Lança uma exceção para erros HTTP

        # 2. Encontrar os links dos PDFs
        soup = BeautifulSoup(response.content, 'html.parser')
        pdf_links = []
        for link in soup.find_all('a', href=True):
            href = link['href']
            if href.endswith('.pdf'):
                if 'Anexo I' in link.text or 'Anexo II' in link.text:
                    pdf_links.append(href)

        # 3. Criar a pasta de destino se ela não existir
        if not os.path.exists(PASTA1):
            os.makedirs(PASTA1)
        if not os.path.exists(PASTA2):
            os.makedirs(PASTA2)

        # 4. Baixar os PDFs e salvar na pasta de destino
        pdf_files = []
        for link in pdf_links:
            pdf_url = link if link.startswith('http') else f"https://www.gov.br{link}"
            pdf_response = requests.get(pdf_url)
            pdf_response.raise_for_status()

            filename = os.path.basename(pdf_url)
            caminho_completo = os.path.join(PASTA1, filename)
            with open(caminho_completo, 'wb') as f:
                f.write(pdf_response.content)
            pdf_files.append(caminho_completo)

        # 5. Compactar os PDFs em um arquivo ZIP
        caminho_zip = os.path.join(PASTA2, 'anexos.zip')
        with zipfile.ZipFile(caminho_zip, 'w') as zipf:
            for pdf_file in pdf_files:
                zipf.write(pdf_file, os.path.basename(pdf_file))  # Usar apenas o nome do arquivo no ZIP

        print("Anexos baixados e compactados com sucesso!")

    except requests.exceptions.RequestException as e:
        print(f"Erro ao acessar o site ou baixar os arquivos: {e}")
    except Exception as e:
        print(f"Ocorreu um erro inesperado: {e}")

# URL do site
url = "https://www.gov.br/ans/pt-br/acesso-a-informacao/participacao-da-sociedade/atualizacao-do-rol-de-procedimentos"

# Executar a função
baixar_e_compactar_anexos(url)
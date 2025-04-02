-- SOLICITAÇÕES DO INVESTIGADOR RESPONSÁVEL

-- Maiores compradores nos últimos 6 meses com +1 compra
SELECT pessoa_id, nome_pessoa, COUNT(*) AS maiores_compradores FROM public.investigacao_compra WHERE data_compra >= (CURRENT_DATE - INTERVAL '6 months') GROUP BY pessoa_id, nome_pessoa HAVING COUNT(*) > 1 ORDER BY maiores_compradores DESC

-- Lista de pessoas envolvidas na entrega
SELECT p.nome, vitimas.* FROM public.investigacao_pessoa_transporte as vitimas inner join pessoa as p on vitimas.pessoa_id = p.id 

-- Listagem de veículos com características suspeitas / Lista de Caminhões Azuis
SELECT v.id, v.ano, v.placa FROM public.veiculo AS v INNER JOIN public.modelo_veiculo AS mv ON v.modelo_id = mv.id WHERE v.cor = 'azul' AND mv.tipo = 'caminhao'

-- Listagem de pedágio dos veículos com características do suspeito / Caminhões azuis que passaram proximo ao horário no pedágio - Nenhum
SELECT v.id, v.ano, v.placa FROM public.veiculo AS v INNER JOIN public.modelo_veiculo AS mv ON v.modelo_id = mv.id INNER JOIN public.investigacao_pedagio AS ip ON v.placa = ip.placa WHERE v.cor = 'azul' AND mv.tipo = 'caminhao' AND ip.data_hora BETWEEN '2024-11-18 08:00:00' AND '2024-11-18 11:00:00';

-- Listagem de ligações telefônicas de algumas pessoas investigadas
SELECT * FROM public.investigacao_telefone ORDER BY id ASC 



-- Ligações realizadas no dia anterior e no dia do crime pelas vítimas
SELECT p.nome, p.profissao, vitimas.local_trabalho, suspeitos.origem_telefone_id, suspeitos.destino_telefone_id, suspeitos.data_hora FROM pessoa p
INNER JOIN investigacao_pessoa_transporte vitimas ON vitimas.pessoa_id = p.id
INNER JOIN proprietario_pessoa_fisica ppf ON ppf.pessoa_id = p.id
INNER JOIN proprietario_telefone pt ON pt.proprietario_id = ppf.proprietario_id
INNER JOIN investigacao_telefone suspeitos ON suspeitos.origem_telefone_id = pt.telefone_id OR suspeitos.destino_telefone_id = pt.telefone_id 
where suspeitos.data_hora between '2024-11-17 00:00:00' and '2024-11-18 23:59:00'

-- Como resultado, foi possível notar uma ligação pouco antes do crime, e no dia anterior realizada por Pomponio Gustavo ao telefone de id 21161 cujo proprietário possui id "b9dd46d7-3d7f-402d-9864-f8b975c1bdbf"
SELECT proprietario_id FROM public.proprietario_telefone where telefone_id = '21161' 

-- A descrição física do suspeito de id "b9dd46d7-3d7f-402d-9864-f8b975c1bdbf" bate com a da descrição da cena do crime
SELECT p.id, p.nome, carac.cor_cabelo, carac.formato_cabelo, carac.altura, carac.cor_pele, carac.peso, carac.raca, carac.barba, carac.bigode
FROM public.proprietario_telefone AS tel
INNER JOIN public.proprietario_pessoa_fisica AS pf ON tel.proprietario_id = pf.proprietario_id
INNER JOIN public.pessoa_caracteristica AS carac ON pf.pessoa_id = carac.pessoa_id
INNER JOIN public.pessoa AS p ON p.id = pf.pessoa_id
WHERE tel.telefone_id = '21161';

-- Outras ligações realizadas pelo suspeito
SELECT * FROM public.investigacao_telefone where origem_telefone_id = '21161' 

-- Ligações realizadas no dia anterior e no dia do crime pelo suspeito a uma pessoa específica de telefone de id 21919
SELECT p.id, p.nome, p.profissao, pf.proprietario_id FROM public.proprietario_telefone as tel 
inner join public.proprietario_pessoa_fisica as pf on pf.proprietario_id = tel.proprietario_id
inner join public.pessoa as p on p.id = pf.pessoa_id
where tel.telefone_id = '21919'

-- Dados da empresa do suspeito de id telefone 21919 - Empreendedor Comerciante
SELECT emp.nome, emp.ramo_atuacao, emp.situacao FROM public.proprietario_empresa as empresario inner join public.empresa as emp on empresario.empresa_id = emp.id where empresario.proprietario_id = '511401c0-2b9e-4001-b872-415061357495'

-- Suspeito com a caracteristica física - Marcos Vinicius Lucas
SELECT p.nome FROM public.pessoa_caracteristica as pc inner join public.pessoa as p ON pc.pessoa_id = p.id where pc.cor_cabelo = 'vermelho' and pc.formato_cabelo = 'longo' and pc.barba = 'Sim' and pc.raca = 'urban' and pc.bigode = '1' and pc.oculos = '1' and pc.cor_pele = 'laranja' and pc.altura = 'alto'


-- Análise do caso: O suspeito Heinz-Walter Juan será colocado na lista por possuir as características físicas semelhantes as descritas pelas vítimas, e além disso é possível perceber uma parceria com Pomponio Gustavo (vítima ajudande que estava no local do crime) devido às 2 ligações feitas para Heinz no dia anterior e no dia do crime. Como dito pelo proprietário Gianpaolo Peano Beyer, geralmente é avisado com um dia de antecedência a chegada da carga no porto, o que poderia explicar a primeira ligação feita por Heinz e Pomponio por volta das 19h, além da ligação pouco antes do crime por volta das 7h, talvez para combinar algo. Além disso, houveram também telefonemas para Traute Clara que possui uma empresa chamada Costela Comércio, que poderia estar auxiliando no roubo interessada nos vinhos (já que era uma compradora ativa de vinhos), já que essas ligações também foram no dia anterior e dia do crime. O último suspeito Marcos Vinicius Lucas apresenta as caracteristicas fisicas descritas, então é importante considerar.

-- LISTA FINAL DE SUSPEITOS E POSSÍVEIS ENVOLVIDOS NO CRIME
-- Heinz-Walter Juan (066ba2eb-d189-4536-9e6a-69d3702a7622)
-- Pomponio Gustavo (7c681882-9217-4ffd-946b-b1bff920e7e8)
-- Traute Clara (3c7ccbbc-a628-46a6-a00f-40f6e702e37c)
-- Marcos Vinicius Lucas (9ca63ed0-cad4-41ba-b519-1e75347a0015)











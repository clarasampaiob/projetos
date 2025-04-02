<?php

// O INDEX é o primeiro arquivo a ser carregado pelos navegadores, por isso neste arquivo é feito o 
// CONTROLE DE ROTAS, ou seja, os CAMINHOS URLS, onde ficma definidas as rotas para cada página e suas funções.
// Esse controle é feito através da utilização do Framework SLIM.
// Exemplo de Rota (URL): localhost/cadastrarCliente 
// OBS: Instalar o COMPOSER para baixar as dependências p/ usar o SLIM




// ------------------------------ CARREGAMENTO E INSTANCIAÇÃO DO SLIM ------------------------------ //
 
    // Inclusão do Autoloader do Composer que chama o Slim
        require 'vendor/autoload.php';

    // Inclusão do arquivo de Inicialização que possui as configurações do Banco de Dados 
        require 'init.php';

    // Instanciação do Slim, habilitando os erros (ÚTIL P/ DEBUG EM DESENVOLVIMENTO) 
        $app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

// ------------------------------------------------------------------------------------------------ //
        
        
 
        
        
// ------------------------------------ ROTAS LOGIN COM SENHA ------------------------------------ //
        
    // Para utilizar o sistema, precisa logar com Senha, iniciando uma sessão
        session_start();
        
        
    
    // URL que chama a Função de Login no Controller Login    
        $app->get('/login', function () {
            $osC = new \App\Controller\Login; 
            $osC->login(); 
        });
     
        
    
    // URL que após checar a Senha, carrega a Página Incial do Sistema    
        $app->post('/checkpassword', function () {
            $osC = new \App\Controller\Login; 
            $osC->testeLogin();             
        });
        
    
        
    // URL de Fim de Seção    
        $app->get('/logout', function () {
           $osC = new \App\Controller\Login;
           $osC->logout();
           $osC->login();
        });
        
// ------------------------------------------------------------------------------------------------ //    
        
        
        
    
// -------------------------------------- MENUS PRINCIPAIS --------------------------------------- //

    // A ROTA '/' é chamada automaticamente ao iniciar o Sistema
    // Essa Rota carrega a Página GerenciarOsV que está na Função index em OsC
    // Essa página forma a tabela que gerencia as Os cadastradas no Sistema
        $app->get('/', function () {
            // Se existir a variável Login na Seção, o usuário acessa a Página Inicial
            if(isset($_SESSION['login'])){ 
                $osC = new \App\Controller\OsC; 
                $osC->index();
            // Se não existir, a Página de Login é chamada
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });
        
        
        
    // URL responsável por trazer todas as Os cadastradas no sistema para a View GerenciaOsV 
    // A url foi criada na View GerenciarOsV e chama a função listarOs no Controller da Os
        $app->get('/listarOs', function () {
            if(isset($_SESSION['login'])){
                $oslist = new \App\Controller\OsC; 
                $oslist->listarOs(); 
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });    
    

        
    // URL que carrega a View GerenciarAutomovelV que lista todos os Automóveis Cadastrados
    // A View é chamada pela Função index() que está no Controller de Automóvel
    // Instanciação do Controler de Automóvel p/ poder chamar a Função index()       
        $app->get('/auto', function () {
            if(isset($_SESSION['login'])){
                $autoC = new \App\Controller\AutomovelC; 
                $autoC->index(); 
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });


        
    // URL que carrega a View GerenciarClienteV que lista todos os Clientes Cadastrados
    // O Controller de Cliente tb possui uma Função index() responsável pelo mesmo
    // Instanciação do Controler de Cliente p/ poder chamar a Função index()         
        $app->get('/cliente', function () { 
            if(isset($_SESSION['login'])){
                $cliC = new \App\Controller\ClienteC; 
                $cliC->index();
             }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });

      
        
    // URL que carrega a View GerenciarFuncionarioV que lista todos os Funcionários Cadastrados
    // O Processo é o mesmo dos anteriores, porém para o Controller de Funcionário        
        $app->get('/funcionario', function () { 
            if(isset($_SESSION['login'])){
                $pdalist = new \App\Controller\FuncionarioC; 
                $pdalist->index(); 
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });        
        
      
        
    // URL carregada ao clicar no botão NOVO ou Gerenciar da View GerenciarOsV
    // A Função formOs é responsável por carregar a View OsV e as instâncias nela necessárias
    // A View Osv é onde o Usuário faz o Cadastro de Ordem de Serviço        
        $app->get('/formOs', function () {
            if(isset($_SESSION['login'])){
                $pdalist = new \App\Controller\OsC; 
                $pdalist->formOs();
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });        
    
        
        
    // Função(url) que lista os automóveis do Cliente ao seleciona-lo 
    // Criada na View OsV com Jquery referenciada por getCarrosCliente
    // Os dados vão para o Controller do Automóvel na função listarCarrosCliente
        $app->get('/getCarrosCliente', function () {
            if(isset($_SESSION['login'])){
                $autoC = new \App\Controller\AutomovelC; 
                $autoC->listarCarrosCliente();
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });
        
        
        
    // URL carregada ao clicar no botão SALVAR da Página de Cadastro de OS
    // Essa URL foi criada na View OsV através do Jquery, sendo acionada ao clicar no botão SALVAR
    // Ao clicar em SALVAR, os dados são enviados p/ Função salvarOs() no Controller da OS        
        $app->get('/salvarOs', function () {
            if(isset($_SESSION['login'])){
                $saveosC = new \App\Controller\OsC; 
                $saveosC->salvarOs();
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });
        

        
    // FUNÇÃO(url) carregada ao clicar no botão '+' da Página de Cadastro de OS 
    // Após clicar no botão, o problema é salvo na tabela lista_pedido junto com o id da OS
    // A URL foi criada na View da OsV com Jquery que ao clicar envia os dados pra Função salvarProblemas()
    // A Função está no Controller de Pedido Atividade que realiza as operações da tabela lista_pedido
        $app->get('/salvarProblemas', function () {
            if(isset($_SESSION['login'])){
                $saveosC = new \App\Controller\PedidoAtividadeC; 
                $saveosC->salvarProblemas(); 
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });
        
        
        
    // FUNÇÃO(url) carregada após salvarProblemas()
    // Essa função é responsável por pegar os dados que foram salvos em salvarProblemas e lista-los em uma tabela
    // A tabela é estruturada pelo Jquery na View OsV referenciada pela função(url) listarProblemas()
    // A Função listarProblemas está no Controller de PedidoAtividade
        $app->get('/listarProblemas', function () {
            if(isset($_SESSION['login'])){
                $savelstC = new \App\Controller\PedidoAtividadeC; 
                $savelstC->listarProblemas();
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });
        
        
        
    // Função(url) carregada ao clicar no ìcone REMOVER da tabela de Problemas
    // A URL foi criada na View da OsV com Jquery referenciada por removerProblema
    // Pra chamar a Função, foi feito um Modal do Bootstrap chamado removerproblema 
    // Para isso foi necessário criar a função removeformat e a showModalRemoverProblema
        $app->get('/removerProblema', function () {
            if(isset($_SESSION['login'])){
                $rmvprob = new \App\Controller\PedidoAtividadeC; 
                $rmvprob->removerProblema();
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });
        
        
        
    // Função(url) carregada ao clicar no botão FINALIZAR da View de OS
    // A URL foi criada na View da OsV com Jquery referenciada por finalizarOs
    // Ao clicar, os dados serão enviados p/ a função finalizarOs no Controller da OS
        $app->get('/finalizarOs', function () {
            if(isset($_SESSION['login'])){
                $pdalist = new \App\Controller\OsC; 
                $pdalist->finalizarOs(); 
             }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });

        
                
    // URL carregada ao clicar no ícone REMOVER na tela de listagem de todas as OS (GerenciarOsV)
    // A função é chamada através do Jquery na View GerenciarOsV referenciada por removeros
    // Os dados são enviados para o Controller da OS na função removeros
        $app->get('/removeros', function () {
            if(isset($_SESSION['login'])){
                $pdalist = new \App\Controller\OsC; 
                $pdalist->removeros(); 
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });



    // URL carregada ao clicar na lupa(Pedido) da View GerenciarOsV
    // É responsável por carregar a View GerenciarAtvV que lista todas as atividades referentes a uma Os
    // A URL foi criada na View GerenciarOsV que chama a função gerenciaratv através da url gerenciaratv
    // A função gerenciaratv está no Controller de PedidoAtividade
        $app->get('/gerenciaratv', function () {
            if(isset($_SESSION['login'])){
                $pdalist = new \App\Controller\PedidoAtividadeC; 
                $pdalist->gerenciaratv(); 
            }else{
                $osC = new \App\Controller\Login; 
                $osC->login(); 
            }
        });







$app->get('/listarfuncpedido', function () {
    if(isset($_SESSION['login'])){
        $savefunC = new \App\Controller\PedidoAtividadeC; 
        $savefunC->listarfuncpedido(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/salvarFunc', function () {
    if(isset($_SESSION['login'])){
        $savefunclst = new \App\Controller\FuncionarioC; 
        $savefunclst->salvarFunc(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});





$app->get('/listarpedatv', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\PedidoAtividadeC; 
        $pdalist->listarpdatv(); 
     }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});









$app->get('/removerpedatv', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\PedidoAtividadeC; 
        $pdalist->removerpedatv(); 
     }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/formatv', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\PedidoAtividadeC; 
        $pdalist->formatv(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/formcli', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\ClienteC; 
        $pdalist->formcli();
     }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});

$app->get('/removercli', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\ClienteC; 
        $pdalist->removercli(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/listarcli', function () {
    if(isset($_SESSION['login'])){
        $oslist = new \App\Controller\ClienteC; 
        $oslist->listarcli(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/formauto', function () {
    if(isset($_SESSION['login'])){
        $oslist = new \App\Controller\AutomovelC; 
        $oslist->formauto(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/listarautos', function () {
    if(isset($_SESSION['login'])){
        $oslist = new \App\Controller\AutomovelC; 
        $oslist->listarautos(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/cadastrarcli', function () {
    if(isset($_SESSION['login'])){
        $oslist = new \App\Controller\ClienteC; 
        $oslist->cadastrarcli(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/removerauto', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\AutomovelC; 
        $pdalist->removerauto(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});




$app->get('/listarfuncionarios', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\FuncionarioC; 
        $pdalist->listarfuncionarios(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/removerfunc', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\FuncionarioC; 
        $pdalist->removerfunc(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/formfuncionario', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\FuncionarioC; 
        $pdalist->formfuncionario(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/salvarpedatv', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\PedidoAtividadeC; 
        $pdalist->salvarpedatv(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/removerfunclst', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\PedidoAtividadeC; 
        $pdalist->removerfunclst(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/salvarfunc', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\FuncionarioC; 
        $pdalist->salvarFunc(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/salvarcliente', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\ClienteC; 
        $pdalist->salvarcliente(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});



$app->get('/salvarautomovel', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\AutomovelC; 
        $pdalist->salvarautomovel(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/cadastrarfunc', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\FuncionarioC; 
        $pdalist->cadastrarfunc(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/salvarpecalista', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\PecaAtividadeC; 
        $pdalist->salvarpecalista();
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/listarpecapedido', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\PedidoAtividadeC; 
        $pdalist->listarpecapedido();
     }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});


$app->get('/removerpecalst', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\PedidoAtividadeC; 
        $pdalist->removerpecalst(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});




$app->get('/concluirOs', function () {
    if(isset($_SESSION['login'])){
        $pdalist = new \App\Controller\PedidoAtividadeC; 
        $pdalist->concluirOs(); 
    }else{
        $osC = new \App\Controller\Login; 
        $osC->login(); 
    }
});

$app->run();

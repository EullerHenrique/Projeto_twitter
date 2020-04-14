<?php
    /*<!--

    O que é framework?

    Um framework pode ser vislumbrado como o esqueleto – template – de uma aplicação que pode ser customizado pelo
    programador e aplicado a um conjunto de aplicações de um mesmo domínio.

    Um framework, de modo geral, é um modelo de códigos já existentes para uma função específica necessária
    ao desenvolvimento de outros softwares.

    Em outras palavras, trata-se de uma ferramenta que une códigos comuns a diversos projetos para que o
    desenvolvedor não precise programar um código novo para funções que já existem.

    Também chamado de arcabouço, trata-se de um modelo de códigos, e não de um software a ser executado.

    Seu principal objetivo é oferecer determinadas funcionalidades prontas aos programadores,
    as quais servem de base para o desenvolvimento de novos projetos, gerando, assim, mais
    produtividades e lucratividade ao economizar tempo e cortar custos.

    A utilidade de um framework está nas necessidades em comum que certos projetos possuem,
    desde que essas semelhanças em demandas sejam razoavelmente grandes, pois, como os códigos são
    abstratos e genéricos, devem atender ao maior número possível de aplicações.

    Nesse sentido, uma de suas características muito importante é a integração entre funções diferentes.
    Ou seja, as funções são programadas da forma mais abrangente possível para se adequar às mais variadas circunstâncias.

    É uma abstração que une códigos comuns entre vários projetos de software provendo uma funcionalidade genérica.

    Um framework captura a funcionalidade comum a várias aplicações.


    BIBLIOTECA VS FRAMEWORK

    Bibliotecas: As bibliotecas usam seu código como base a uma implementação de regras. As bibliotecas
    são um conjunto de funções que visa facilitar a utilização de uma determinada linguagem, como citamos
    acima o caso do Jquery que é uma biblioteca feita com a base em JavaScript.

    Biblioteca: é uma coleção de implementações de comportamentos escritos em uma linguagem e importadas no seu código.
    Nesse caso, há uma interface bem definida para cada comportamento invocado. Um bom exemplo é a biblioteca jQuery
    que implementa certos comportamentos, como por exemplo, a manipulação do HTML.

    Frameworks: Diferente das bibliotecas o framework é um conjunto de componentes contendo uma base pronta de um projeto.
    Podemos citar como exemplo alguns Frameworks famosos no momento como o Bootstrap citado acima e o Angular
    famework para aplicações em JavaScript mantido pela Google.

    Framework: estrutura real, ou conceitual, que visa servir como suporte (ou guia) para a construção de algo.

    OBS: O bootstrap é um framework porque ele define todos os passos para implementar algo, como por
    exemplo uma navbar, um botão, um dashboard etc, ou seja, existe um padrão que deve ser seguido.



    MVC = Model Controller View

    É um padrão de arquitetura de aplicação cujo objetivo é separar o projeto em três camadas
    independentes, que são o modelo, a visão e o controlador. Essa separação de camadas
    ajuda na redução de acoplamento e promove o aumento de coesão nas classes do projeto.
    Assim, quando o modelo MVC é utilizado, pode facilitar em muito a manutenção do código e sua
    reutilização em outros projetos.

    A arquitetura de software de um sistema computacional pode ser definida como a suas estruturas,
    que são compostas de elementos de software, de propriedades externamente visíveis desses componentes,
    e do relacionamento entre eles. Ou seja, a arquitetura define os elementos de software e como eles
    interagem entre si.

    Acoplamento: é o grau em que uma classe conhece a outra. Se o conhecimento da classe A sobre
    a classe B for através de sua interface, temos um baixo acoplamento, e isso é bom. Por outro lado,
    se a classe A depende de membros da classe B que não fazem parte da interface de B, então temos
    um alto acoplamento, o que é ruim.

    Coesão: quando temos uma classe elaborada de forma que tenha um único e bem focado propósito,
    dizemos que ela tem uma alta coesão, e isso é bom. Quando temos uma classe com propósitos
    que não pertencem apenas a ela, temos uma baixa coesão, o que é ruim.

    Desenvolver uma aplicação utilizando algum padrão de projeto pode trazer alguns dos seguintes benefícios:

        Aumento de produtividade;
        Uniformidade na estrutura do software;
        Redução de complexidade no código;
        As aplicações ficam mais fácies de manter;
        Facilita a documentação;
        Estabelece um vocabulário comum de projeto entre desenvolvedores;
        Permite a reutilização de módulos do sistema em outros sistemas;
        É considerada uma boa prática utilizar um conjunto de padrões para resolver
        problemas maiores que, sozinhos, não conseguiriam;
        Ajuda a construir softwares confiáveis com arquiteturas testadas;

    O MVC é utilizado em muitos projetos devido à arquitetura que possui, o que possibilita a divisão
    do projeto em camadas muito bem definidas. Cada uma delas, o Model, o Controller e a View, executa
    o que lhe é definido e nada mais do que isso.

    A utilização do padrão MVC trás como benefício isolar as regras de negócios da lógica de apresentação,
    a interface com o usuário. Isto possibilita a existência de várias interfaces com o usuário que podem
    ser modificadas sem que haja a necessidade da alteração das regras de negócios, proporcionando assim
    muito mais flexibilidade e oportunidades de reuso das classes.

    Uma das características de um padrão de projeto é poder aplicá-lo em sistemas distintos. O padrão MVC
    pode ser utilizado em vários tipos de projetos como, por exemplo, desktop, web e mobile.

    A comunicação entre interfaces e regras de negócios é definida através de um controlador,
    e é a existência deste controlador que torna possível a separação entre as camadas. Quando
    um evento é executado na interface gráfica(view), como um clique em um botão, a interface irá se
    comunicar com o controlador que por sua vez se comunica com as regras de negócios (model).

    Imagine uma aplicação financeira que realiza cálculos de diversos tipos, entre eles os de juros.
    Você pode inserir valores para os cálculos e também escolher que tipo de cálculo será realizado.
    Isto tudo você faz pela interface gráfica, que para o modelo MVC é conhecida como View. No entanto,
    o sistema precisa saber que você está requisitando um cálculo, e para isso, você terá um botão no
    sistema que quando clicado gera um evento.

    Este evento pode ser uma requisição para um tipo de cálculo específico como o de juros simples
    ou juros compostos. Fazem parte da requisição neste caso os valores digitados no formulário,
    como também a seleção do tipo de cálculo que o usuário quer executar sobre o valor informado.
    O evento do botão é como um pedido a um intermediador que prepara as informações para então
    enviá-las para o cálculo. Este intermediador nós chamamos de Controller. O controlador é
    o único no sistema que conhece o responsável pela execução do cálculo, neste caso a camada
    que contém as regras de negócios. Esta operação matemática será realizada pelo Model assim
    que ele receber um pedido do Controller.

    O Model realiza a operação matemática e retorna o valor calculado para o Controller, que também
    é o único que possui conhecimento da existência da camada de visualização. Tendo o valor em “mãos”,
    o intermediador o repassa para a interface gráfica que exibirá para o usuário. Caso esta operação
    deva ser registrada em uma base de dados, o Model se encarrega também desta tarefa.

    Explicando cada um dos objetos do padrão MVC tem-se primeiramente o controlador (Controller)
    que interpreta as entradas do mouse ou do teclado enviado pelo usuário e mapeia essas ações
    do usuário em comandos que são enviados para o modelo (Model) e/ou para a janela de visualização
    (View) para efetuar a alteração apropriada. Por sua vez o modelo (Model) gerencia um ou mais elementos
    de dados, responde a perguntas sobre o seu estado e responde a instruções para mudar de estado.
    O modelo sabe o que o aplicativo quer fazer e é a principal estrutura computacional da arquitetura,
    pois é ele quem modela o problema que está se tentando resolver. Por fim, a visão (View) gerencia a
    área retangular do display e é responsável por apresentar as informações para o usuário através de
    uma combinação de gráficos e textos. A visão não sabe nada sobre o que a aplicação está atualmente
    fazendo, tudo que ela realmente faz é receber instruções do controle e informações do modelo e então
    exibir elas. A visão também se comunica de volta com o modelo e com o controlador para reportar o seu estado.

    Tão importante quanto explicar cada um dos objetos do padrão arquitetural MVC é explicar como é o seu
    fluxo tipicamente. Primeiramente o usuário interage com a interface (por exemplo, pressionando um botão)
    e o controlador gerenciar esse evento de entrada da interface do usuário. A interface do usuário é exibida
    pela visão (view), mas controlada pelo controlador. O controlador não tem nenhum conhecimento direto da View,
    ele apenas envia mensagens quando ela precisa de algo na tela atualizado. O controlador acessa o modelo,
    possivelmente atualizando ela de forma apropriada para as ações do usuário (por exemplo, o controlador
    solicita ao modelo que o carrinho de compras seja atualizado pelo modelo, pois o usuário incluiu um novo item).
    Isto normalmente causa uma alteração no estado do modelo tanto quanto nas informações. Por fim, a visão usa o
    modelo para gerar uma interface com o usuário apropriada. A visão recebe as informações do modelo. O modelo não
    tem conhecimento direto da visão. Ele apenas responde a requisições por informações de quem quer que seja e
    requisita por transformações nas informações feitas pelo controlador. Após isso, o controlador, como um
    gerenciador da interface do usuário, aguarda por mais interações do usuário, onde inicia novamente todo o ciclo.


    Model = Camada de banco de dados e regras de negócio.

    Controller = Recebe todas as requisições e controla o que deve acontecer e quando.

    View = Exibição dos dados (html, xml, json).

    SERVIDOR EMBUTIDO PHP
        Inclua o php no $PATH.

    No terminal:

    php -S localhost: 8080

    Obs: S de server

    Obs: qualquer porta pode ser utilizada

    No navegador:
        localhost:8080

    O servidor embutido facilita o desenvolvimento local.

    A principal vantagem de um servido embutido é que diferentemente de um xamp, wamp, lamp ou mamp é que você não
    precisa necessariamente dispor todos os projetos no mesmo local. Isto é útil para quando você deseja realizar
    algo pontual como uma simples correção ou rodar um projeto recém clonado do github, mesmo estando na pasta de
    Downloads.

    COMPOSER

    Composer é uma ferramenta para gerenciamento de dependências em PHP. Ele permite que você declare as

    bibliotecas dependentes  !!!1

    que seu projeto precisa e as instala para você.

    Para quem não está acostumado ou nunca ouviu falar em Gerenciamento de Dependências, pode não ter ficado claro
    (ou difícil de entender por ser bom demais para ser verdade),
    mas, na prática, o que acontece é que, usando Composer, você simplesmente especifica quais pacotes
    (códigos reutilizáveis, um pacote nada mais é do que um conjunto de classes localizadas na mesma estrutura hierárquica de diretórios.)
    seu projeto precisa – podendo estes pacotes também ter pacotes – e ele vai,
    automaticamente, baixar isso e incluir nos locais apropriados de seu projeto (autoload)!

    Caso seja preciso acrescentar, remover ou atualizar algum pacote, sem problemas: o gerenciador também
    faz o trabalho todo!

    O Composer funciona, basicamente, através de duas vertentes: um repositório para os pacotes (Packagist)
    e instruções via linha de comando para gerenciamento dos pacotes (para procurar, instalar, atualizar, remover, etc).

    A instalação dos pacotes é feita por projeto e, por default, nada é instalado globalmente. Por isso o Composer
    é considerado mais um Gerenciador de Dependências do que um Gerenciador de Pacotes (mas usar o termo “pacotes”,
    no caso, também não é errado).

    Depois de configurar corretamente o arquivo composer.json para instalar as dependências informadas – através
    do comando php composer.phar install, no Terminal – é feita uma verificação para ver se há algum erro de sintaxe,
    acontece a busca no repositório pelo pacote informado, o download é realizado e a “instalação”
    feita no diretório apropriado – por padrão, é o diretório vendor, na raiz do projeto, mas isso também é configurável.


    PR4

    PSR-4 é uma especificação de Autoload baseada em namespaces para o PHP.
    OBS: Os namespaces correspomdem ao local em que o arquivo está localizado.

    A PSR-4 não força que você tenha a estrutura de Namespace correspondente a estrutura de sistema de arquivos.
    Por exemplo, caso queira configurar o prefixo de Namespace Foo\Bar no Autoload:

    {
        "autoload": {
            "psr-4": {
                    "Foo\\Bar\\": "src/"
            }
        }
    }
    Ao tentar carregar uma classe desse Prefixo, por exemplo Foo\Bar\Hello, o arquivo a ser carregado será no caminho
    src/Hello.php e não em src/Foo/Bar/Hello.php como aconteceria caso estivesse usando o Autoload baseado na PSR-0.

    PR0 VS PR4

    A PSR-0 também é uma especificação de Autoload e foi criado primeiro que a PSR-4. Além de se basear também
    no namespace, é compatível com o modelo de classes do PEAR (Vendor_Lib_Class). O PHP-FIG (grupo responsável
    por manter a PSR) recomenda a PSR-4 para Autoload para novos projetos e aconselha se possível migrar os projetos
    que usam a PSR-0 para PSR-4. Além do mais a PSR-0 esta marcada como deprecated



    Para ilustrar um pouco as diferenças entre as duas PSR, veja abaixo um exemplo de configuração usando PSR-0 e
    qual seria a mudança necessária para migrar para a PSR-4:


    {
        "autoload": {
            "psr-0": {
                    "Foo\\Bar\\": "src/"
            }
        }
    }

    No caso, as classes com o Namespace Foo\Bar, serão carregadas em src/Foo/Bar/<Classe>.php. Se você simplesmente
    trocar de psr-0 para psr-4, os arquivos agora serão carregados em src/<Classe>.php. Ou seja, para fazer a migração,
    você teria que copiar todos arquivos de src/Foo/Bar/* para src/. Outra opção é configurar a PSR-4 de uma forma
    compatível com a PSR-0, sem precisar mover os arquivos de lugar, ficaria da seguinte forma:


    {
        "autoload": {
            "psr-4": {
                    "Foo\\Bar\\": "src/Foo/Bar/"
            }
        }
    }


    OBS: O diretório MF (MiniFramework) será utilizado para armazenar toda a lógica de configuração do framework

-->
     *
     */










    //Realiza o carregamento automático de todos os arquivos necessários presentes nos diretórios determinados, tal
    //carregamento é realizado seguindo uma ordem de precedência.
    //Por exemplo, IndexController.php usa um namespace de Action.php, portanto, na index.php o requerimento
    //de Action.php é feito antes de IndexController.php para o namespace presente em Action.php poder
    //ser acessível em IndexController.php.

    require_once "../vendor/autoload.php";

    //require_once "../vendor/autoload.php"; é equivalente à

    //require_once "../vendor/MF/Controller/Action.php";
    // |
    // v
    //require_once "../App/Connection.php";
    // |
    // v
    //require_once "../App/Models/Produto.php";
    // |
    // v
    //require_once "../App/Models/Info.php";
    // |
    // v
    //require_once "../vendor/MF/Model/Container.php";
    // |
    // v
    //require_once  "../App/Controllers/IndexController.php";
    // |
    // v
    //require_once "../vendor/MF/Init/Bootstrap.php";
    // |
    // v
    //require_once "../App/Route.php";
    //...etc

    //use App\Route;
    //$route = new Route();

    //ou

    $route = "App\Route";
    $route = new $route();


    //Obs: $route = new namespace(); em algumas situações não irá funcionar,
    //para funcionar coloque o namespace entre " " em uma variável primeiro e depois instancie essa variável;

?>
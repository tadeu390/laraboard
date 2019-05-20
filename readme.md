# Laraboard
<p>Laraboard é um dashboard opensource, desenvolvido com o framework Laravel e a interface do AdminLte.</p>
<br />

## Sobre
<p>O objetivo do projeto é fornecer um start para projetos de médio e grande porte. A plataforma fornece um rígido controle de acesso a todos os módulos presentes no sistema. Isto é, o usuário administrador pode controlar de forma rápida e intuitiva o acesso de cada usuário ao sistema. A medida que outros módulos são adicionados ao sistema, o controle de acesso a estes pode ser configurado no código fonte adicionando poquissímas linhas de código.</p>
<br />

## Módulos
<p>Inicialmente, o sistema vem com os seguintes módulos que permitem com que o usuário administrador tenha total controle do sistema:</p>
<ul>
    <li>Módulos</li>
    <li>Permissões</li>
    <li>Funções</li>
    <li>Usuários</li>
    <li>Grupos</li>
</ul>

### Módulos
<p>
    Este módulo é fábrica de módulos, ou seja, você pode adicionar quantos módulos o seu projeto precisará. Ao adiciona-lo, o mesmo ficará disponível para acesso através do menu. A lista especificada acima é criada a partir deste módulo.
    Os módulos podem ser editados e apagados, ou seja, tudo gerenciado pelo próprio dashboard. Tome muito cuidado ao apagar um módulo, pois este além de remover tal registro da base de dados, também irá remover todo o código fonte criado para o mesmo.
</p>

### Permissões
<p>
Este módulo é a raiz do controle de acesso, sem ele devidamente configurado, não é possível configurar os demais módulos para trabalharem juntos. A configuração e a comunicação entre esses eles é muito simples.
    O Laraboard, por padrão vem com as permissões básicas definidas, como: permissão para criar registros, permissão para ler registros, permissão para atualizar registros e permissão para apagar registros. É possível adicionar mais permissões conforme a necessidade de cada projeto, basta apenas cadastra-las.
</p>

<p>
    Com as permissões e os módulos cadastrados, agora é possível criar as funções, ou seja, os papeis que posteriormente iremos atribuir a cada usuário ou a um grupo de usuários.
</p>

### Funções
<p>
    As funções são basicamente os papeis que cada usuário pode desempenhar no sistema. Um usuário que não possui uma função atribuída a si ou uma função atribúida a um grupo do qual ele faz parte, não lhe permite acesso nenhum ao sistema. Portanto, é necessário configurar corretamente cada função e cada atribuição para que o usuário tenha acesso somente ao esperado.
    Ao criar uma nova função, nos deparamos com a lista de módulos e permissões que foram cadastrados. Aqui é possível dizermos ao Laraboard qual o nível de permissão iremos especificar para cada módulo nesta função.</p>
    <p>Os níveis disponíveis são:</p>
    <ul>
        <li>Desativado</li>
    </ul>
<p>
    Se em qualquer função, algum módulo estiver essa permissão selecionada em alguma permissão, isso faz com que o usuário que possui a função, não tenha acesso a absolutamente nada referente a este módulo.
</p>
    <ul>
        <li>Não definido</li>
    </ul>
<p>
    Se em qualquer função, algum módulo estiver com essa permissão selecionada, o usuário recebe acesso total a este módulo para esta permissão. Portanto é necessário tomar cuidado com permissões não definidas, pois esta vem como default.
</p>

    <ul>
        <li>Todos</li>
    </ul>
<p>
    Se em qualquer função, algum módulo estiver com esta permissão selecionada, o usuário recebe acesso total ao módulo em questão para esta permissão.
</p>

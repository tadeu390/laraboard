# Laraboard
<p>Laraboard é um dashboard opensource, desenvolvido com o framework Laravel e a interface do AdminLte. O sistema possui uma completa divisão de camadas, o que nos permite determinar com precisão as responsabilidades de cada componente do sistema. Como sabemos, o Laravel é um framework MVC e para facilitar o desenvolvimento de aplicações, foi adicionado uma camada de serviços onde a mesma fica encarregada das regras de negócios e também uma camada de repositório (Design Patterns) responsável pela manipulação de dados no banco.</p>

## Objetivo
<p>O objetivo do projeto é fornecer um start para projetos de médio e grande porte. A plataforma fornece um rígido controle de acesso a todos os módulos presentes no sistema. Isto é, o usuário administrador pode controlar de forma rápida e intuitiva o acesso de cada usuário ao sistema. A medida que outros módulos são adicionados, o controle de acesso a estes pode ser configurado no código fonte adicionando poquissímas linhas de código.</p>
<br />

## Módulos do sistema
<p>O sistema vem com os seguintes módulos que permitem com que o usuário administrador tenha total controle do sistema:</p>
<ul>
    <li>Módulos</li>
    <li>Permissões</li>
    <li>Funções</li>
    <li>Grupos</li>
    <li>Usuários</li>
</ul>

<p>
    Sendo assim, vamos ver um pouco mais sobre os ítens mencionados acima.
    </p>

### Módulos
<p>
    Este módulo é a fábrica de módulos, ou seja, você pode adicionar quantos módulos forem necessários. Ao adicionar um novo módulo, o mesmo ficará disponível para acesso através do menu. A lista especificada acima é criada a partir deste módulo.
    Os módulos podem ser editados e apagados, ou seja, tudo gerenciado pela interface do Laraboard. Tome muito cuidado ao apagar um módulo, pois este além de remover tal registro da base de dados, também irá remover todo o código fonte criado para o mesmo.
</p>

### Permissões
<p>
Este módulo é a raiz do controle de acesso, sem ele devidamente configurado, não é possível configurar os demais módulos para trabalharem juntos. A configuração e a comunicação entre eles é muito simples.
    O Laraboard, por padrão vem com as permissões básicas definidas, como: permissão para criar, ler, atualizar e permissão para apagar registros. É possível adicionar mais permissões conforme a necessidade de cada projeto, basta apenas cadastra-las.
</p>

<p>
    Com as permissões e os módulos cadastrados, agora é possível criar as funções, ou seja, os papeis que posteriormente iremos atribuir a cada usuário ou a um grupo de usuários.
</p>

### Funções
<p>
    As funções são basicamente os papeis que cada usuário pode desempenhar no sistema. Um usuário que não possui uma função atribuída a si ou uma função atribúida a um grupo do qual ele faz parte, não lhe permite acesso nenhum ao sistema. Portanto, é necessário configurar corretamente cada função e cada atribuição para que o usuário tenha acesso somente ao esperado.
    Primeiro devemos criar a função e em seguida podemos alterar as permissões. Ao editarmos as permissões da função, nos deparamos com a lista de módulos e permissões que foram cadastrados. Aqui é possível dizermos ao Laraboard qual o nível de permissão iremos especificar para cada permissão em cada módulo.</p>
    <p>Os níveis disponíveis são:</p>
    <ul>
        <li>Desativado</li>
    </ul>
<p>
    Se em qualquer função, algum módulo estiver com esse nível de permissão selecionado para alguma permissão, isso faz com que o usuário que possui a função, não tenha acesso a absolutamente nada referente ao módulo.
</p>
    <ul>
        <li>Não definido</li>
    </ul>
<p>
    Se em qualquer função, algum módulo estiver com esse nível de permissão selecionado para alguma permissão, o usuário recebe acesso total a este módulo para esta permissão. Portanto é necessário tomar cuidado com permissões não definidas, pois esta vem como default.
</p>
    <ul>
        <li>Todos</li>
    </ul>
<p>
    Se em qualquer função, algum módulo estiver com esse nível de permissão selecionado para alguma permissão, o usuário recebe acesso total ao módulo em questão para esse tipo de permissão.
</p>
    <ul>
        <li>Grupo</li>
    </ul>
<p>
    Se em qualquer função, algum módulo estiver com esse nível de permissão selecionado para alguma permissão, o usuário terá a permissão para apenas registros de usuários que pertencem ao mesmo grupo que ele.
</p>
    <ul>
        <li>Proprietário</li>
    </ul>
<p>
    Se em qualquer função, algum módulo estiver com esse nível de permissão selecionado para alguma permissão, o usuário terá a permissão para apenas registros que pertence a ele mesmo.
</p>

### Grupos
<p>
    Dentro do laraboard é possível criar grupos de usuários e a cada grupo é possível atribuir várias funções diferentes. Estas funções definem o nível de acesso de todos os usuários associados ao grupo. 
    </p>
    
### Usuários
<p>
    Este módulo permite com que cadastremos todos os usuários. Aqui também podemos associar o usuário a um ou mais grupos, conforme a necessidade. Por fim, podemos associar uma ou mais funções a usuário.
    </p>
    
#### Nota
<p>
   <b> Todas as funções associadas ao usuário precedem as funções associadas a qualquer grupo que um usuário possa fazer parte.</b>
    </p>
    
    

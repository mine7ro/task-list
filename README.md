Fiz esse programa de Lista de tarefas, que tem como objetivo Criar tarefas, editar, excluir, e poder ser consultadas no banco de dados.
Utilizei o Bootstrap para deixar uma interface bonita, simples e objetiva. 
Usei o banco de dados Mysql no XAMPP.

Criei o banco de dados chamado tasks_db, com a tabela task usando o seguinte script:

CREATE DATABASE tasks_db;
USE tasks_db;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL
);

Que era um dos requistos do teste. 

Para acessar a aplicação é preciso iniciar o servidor Apache e o MySQL pelo XAMPP.
Colocar a pasta task-list e seus arquivos PHP na pasta htdocs do XAMPP.
E acessar http://localhost/task-list/index.php no navegador de sua preferência. 

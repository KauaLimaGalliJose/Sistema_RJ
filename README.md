# Sistema Web em Desenvolvimento

⚠️ **Atenção:** Este sistema é uma **versão Beta**, desenvolvida para apresentar um bom funcionamento porem ,**Pode apresentar erros**.  
> 📬 Fique à vontade para me chamar no GitHub para dúvidas, sugestões ou contribuições!**

📖**Tutorial – Requisitos e Configuração do Ambiente**
 
 **Requisitos** ----------------------------------------
 
  ➡️ Um servidor web (pode ser local ou dedicado).Alternativamente, você pode usar o XAMPP.
  
  ➡️ Esse Diretorio "Sitema_RJ".
  
  ➡️ É necessário subir os serviços Apache2 e MySQL.

🛠️ **Passos para Configuração** ------------------------

  **1º Passo** – Obter o Banco de Dados Atual
  
  **2º Passo** – Acesse a pasta: `Sistema_RJ/imagem/`
  
  **3º Passo** – localize o arquivo do banco de dados "Atual".

  **4º Passo** - ⬇️⬇️⬇️

  caso escolha o **XAMPP** -– Abra o XAMPP start o Apache e o MySQL , click em admin no Mysql e crie um Banco de dados com nome 'teste'

  caso escolha o **Servidor** -–   baixe o phpmyadmin (caso tenha preferencia de usar outra forma de controlar o banco de dado pode usar) , crie um Banco de dados com nome 'teste'

  Comando para criar Banco de dados 'teste'  🢃🢃
        
        CREATE DATABASE teste;      
    
  **5º Passo** – Importar as tabelas
  Importe o banco de dados localizado no passo anterior para o seu MySQL local (utilizando phpMyAdmin ou linha de comando).

  **6º Passo** - Caso tenha duvida de como utilizar o **XAMPP** acesse o link - [Acesse o Youtube](https://youtu.be/i_ypCik4VX0?si=f6u8JcSR6tSgAN0m)


## 📦 Finalidade do Sistema

 Este sistema é utilizado para a **criação e controle de pedidos**, organizados em três categorias:
 
 - **PF (Pedidos para Fabricação)**  
   Pedidos que ainda serão produzidos.
 
 - **PG (Pedidos para Fabricação e Estoque)**  
   Parte do pedido será produzida, e a outra parte será separada do estoque.
 
 - **PE (Pedidos em Estoque)**  
   Pedidos que já estão prontos e disponíveis no estoque.

 ---

## 💡 Observações

- Certifique-se de que os serviços do servidor estão ativos antes de acessar o sistema.
- O sistema pode ser acessado via navegador após configurar o ambiente corretamente.


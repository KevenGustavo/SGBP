# ** SGBP \- Sistema de Gestão de Bens Patrimoniais**

**Nota:** Este projeto foi desenvolvido para a coordenação do curso de Engenharia da Computação da Universidade Federal do Maranhão

## **Sobre o Projeto**

O **SGBP** é uma aplicação web robusta desenvolvida para controlar o ciclo de vida de ativos corporativos (computadores, periféricos, mobiliário). O sistema substitui controles manuais (planilhas) por uma solução centralizada que garante a integridade dos dados e rastreabilidade total.  
O diferencial técnico deste projeto é o foco na **auditabilidade**: cada movimentação de um bem (criação, troca de responsável, mudança de localização ou exclusão) é registrada automaticamente em um histórico imutável através de **Observers do Eloquent**, garantindo segurança e confiabilidade na gestão.

## **Funcionalidades Principais**

### **Dashboard Interativo**

Uma visão geral em tempo real da operação:

* Total de bens ativos e excluídos.  
* Contagem de movimentações nos últimos 30 dias.  
* Ranking dinâmico dos usuários com mais responsabilidades.  
* Filtros temporais e gráficos de status.

### **🔄 Controle de Ciclo de Vida (CRUD & History)**

* Cadastro completo de bens com validações rigorosas.  
* **Histórico Automático:** O sistema utiliza o padrão **Observer** para monitorar mudanças no modelo Bem. Se um responsável é alterado, o sistema cria um registro na tabela historicos automaticamente, sem sujar o controller.  
* Suporte a exclusão lógica (Soft Deletes) ou registro de baixa.

### **Relatórios em PDF (DomPDF)**

Geração de documentos oficiais para assinatura e conferência:

* **Relatório Geral:** Listagem completa filtrável.  
* **Termo de Responsabilidade:** Relatório agrupado por usuário com todos os seus bens.  
* **Ficha do Bem:** Histórico individual detalhado de um ativo específico.

### **Autenticação e Segurança**

* Sistema de login robusto utilizando **Laravel Breeze**.  
* Recuperação de senha via e-mail com tokens seguros.  
* Verificação de e-mail para ativação de contas.  
* Controle de acesso (Middleware) para proteger rotas administrativas.

## **🛠️ Tecnologias e Arquitetura**

O projeto foi construído seguindo os princípios da arquitetura **MVC (Model-View-Controller)** e as melhores práticas do ecossistema Laravel.

* **Backend:** Laravel 12 (PHP 8.2+).  
* **Banco de Dados:** PostgreSQL (com chaves estrangeiras e integridade referencial).  
* **Frontend:** Blade Templates \+ Tailwind CSS (Responsivo).  
* **Ambiente de Desenv:** Laravel Sail (Docker & Docker Compose).  
* **Infraestrutura:** WSL2 (Windows Subsystem for Linux).

### **Destaques de Código**

* **Observers:** Desacoplamento da lógica de log de histórico.  
* **Service Layer:** Lógica de geração de relatórios isolada dos Controllers.  
* **Query Scopes:** Reutilização de consultas complexas no Eloquent.

## **Como Rodar o Projeto**

Este projeto utiliza **Laravel Sail**, o que torna a configuração do ambiente extremamente simples, pois roda inteiramente em containers Docker.

### **Pré-requisitos**

* Docker Desktop instalado.  
* WSL2 (se estiver no Windows).

### **Passo a Passo**

1. **Clone o repositório:**  
   ```Bash  
   git clone https://github.com/KevenGustavo/SGBP 
   cd sgbp
   ```

2. **Instale as dependências (via container temporário):**  
   ```Bash   
   docker run --rm \  
       -u "$(id \-u):$(id \-g)" \
       -v "$(pwd):/var/www/html" \
       -w /var/www/html \
       laravelsail/php83-composer:latest \ 
       composer install --ignore-platform-reqs
   ```  
3. **Configure o ambiente:**  
   ```Bash    
   cp .env.example .env
   ```

   *Ajuste as variáveis no arquivo .env conforme necessário.*  
4. **Suba os containers:**  
   ```Bash    
   ./vendor/bin/sail up -d
   ```

5. **Gere a chave e execute as migrações:**  
   ```Bash    
   ./vendor/bin/sail artisan key:generate  
   ./vendor/bin/sail artisan migrate --seed
   ```

6. **Compile os assets (Frontend):**  
   ```Bash    
   ./vendor/bin/sail npm install  
   ./vendor/bin/sail npm run dev
   ```

7. **Acesse:**  
   O sistema estará disponível em: http://localhost
